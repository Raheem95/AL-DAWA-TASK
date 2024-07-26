<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Applicants;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function APISubmition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'dob' => 'required|string',
            'gender' => 'required|string',
            'nationality' => 'required|string',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
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

        if ($FormRequest->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully',
                'applicant' => $FormRequest,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error submitting the form',
        ], 500);
    }
}
