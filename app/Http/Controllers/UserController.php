<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby("user_type", "desc")->get();
        return view("users.index")->with("users", $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view("users.edit")->with("user", $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->email, 'email'),
            ],
            'name' => 'required',
        ], [
            'email.required' => 'Email is required',
            'email.unique' => 'This email is used',
            'name.required' => 'Name is required',
        ]);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->user_type = $request->user_type;
        if ($user->save())
            return redirect("/users")->with("success", "User Updated successfully");
        return redirect("/users")->with("error", "Error while Updating user");
    }


    public function susspend(Request $request)
    {
        $user = User::find($request->UserID);
        $user->susspend = $request->Status;
        if ($user->save())
            return response()->json(1);
        return response()->json("Error updating the status");
    }
}
