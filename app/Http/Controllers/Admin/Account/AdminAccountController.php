<?php

namespace App\Http\Controllers\Admin\Account;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = Admin::query();
        if ($request["name"]) {
            $admins->where("name", "like", "%" . $request["name"] . "%");
        }
        $admins = $admins->paginate(10)->appends($request->input());
        return view("admin.account.admin.index", [
            "admins" => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::all();
        return view("admin.account.admin.create", [
            "roles" => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'role_id' => 'required',
                'password' => 'required|confirmed|min:6'
            ]
        );

        $request["password"] = Hash::make($request["password"]);

        Admin::create($request->all());
        return redirect()->route("admin.account.admin.index")->with("success", "Successfully Created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();

        return view("admin.account.admin.edit", [
            "admin" => $admin,
            "roles" => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'role_id' => 'required',
                'password' => 'required|confirmed|min:6'
            ]
        );
        $request["password"] = Hash::make($request["password"]);


        $admin->update($request->all());
        return redirect()->back()->with("success", "Admin account successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
