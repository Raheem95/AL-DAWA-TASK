<?php

namespace App\Http\Controllers;

use App\Applicants;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'dob' => 'required|string',
            'gender' => 'required|string',
            'nationality' => 'required|string',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        $CVPath = "";
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/cvs', $fileName);
            $CVPath = 'storage/cvs/' . $fileName;
        }
        $FormRequest = new Applicants;
        $FormRequest->name = $request->input('name');
        $FormRequest->dob = $request->input('dob');
        $FormRequest->gender = $request->input('gender');
        $FormRequest->nationality = $request->input('nationality');
        $FormRequest->cv = $CVPath;
        if ($FormRequest->save())
            return redirect("/home")->with("success", "Form Submited successfully");
        return redirect("/home")->with("error", "Error Submiting the form");
    }
    public function GetApplicants()
    {
        $applicants = Applicants::where("status", "1")->get();
        if (auth()->user()->user_type == 1)
            $applicants = Applicants::where("status", "0")->get();
        return view("applicants")->with("applicants", $applicants);
    }
    public function SetStatus(Request $request)
    {
        $Application = Applicants::find($request->ApplicationID);
        if (auth()->user()->user_type == 1) {
            $Application->coordinator = auth()->user()->id;
            $Application->coordinator_date = Carbon::now();
        } else {
            $Application->manager = auth()->user()->id;
            $Application->manager_date = Carbon::now();
        }
        $Application->status = $request->Status;
        if ($Application->save())
            return response()->json(1);
        return response()->json("Error updating the status");
    }
    public function Reports()
    {
        $ApplicationSummary = Applicants::selectRaw('count(*) as Total,status')
            ->groupBy('status')
            ->orderBy('status', 'asc')
            ->get();
        $ApplicationSummaryLabels = [];
        $ApplicationSummaryData = [];
        foreach ($ApplicationSummary as $Application) {
            switch ($Application->status) {
                case -2:
                    $ApplicationSummaryLabels[] = "Rejected by HR Manager";
                    break;
                case -1:
                    $ApplicationSummaryLabels[] = "Rejected by HR Cordinator";
                    break;
                case 0:
                    $ApplicationSummaryLabels[] = "Pendding on HR Cordinator";
                    break;
                case 1:
                    $ApplicationSummaryLabels[] = "Pendding on HR Cordinator";
                    break;
                case 2:
                    $ApplicationSummaryLabels[] = "Fully Accepted";
                    break;
            }

            $ApplicationSummaryData[] = $Application->Total;
        }
        $applicants = Applicants::with("HrManager", "Coordinator")->orderby("id", "asc")->get();
        // return $applicants;
        return view("reports")->with([
            "ApplicationSummaryLabels" => $ApplicationSummaryLabels,
            "ApplicationSummaryData" => $ApplicationSummaryData,
            "applicants" => $applicants,
        ]);
    }
}
