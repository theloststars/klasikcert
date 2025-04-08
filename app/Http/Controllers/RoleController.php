<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles create')->only(['create', 'store']);
        $this->middleware('can:roles read')->only('index');
        $this->middleware('can:roles update')->only(['update', 'edit']);
        $this->middleware('can:roles delete')->only(['destroy', 'massDelete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name')->get();

        // return $roles;

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
            'permissions.*' => ['string']
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::orderBy('name')->get();

        // return $role;

        return view('admin.roles.edit', compact('role', 'permissions'));
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
        $request->validate([
            'name' => ['required', 'string', Rule::unique('roles')->ignore($id)],
            'permissions.*' => ['string']
        ]);

        $role = Role::findById($id);

        if ($role->name == 'super admin') {
            return redirect()->route('admin.roles.index')->with('status-warning', 'You cannot update this role !');
        }

        $role->update([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id);

        if ($role->name == 'super admin') {
            return redirect()->route('admin.roles.index')->with('status-warning', 'You cannot delete this role !');
        }
        Role::destroy($id);

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted !');
    }

    public function massDelete(Request $request)
    {
        $arr = explode(',', $request->ids);

        foreach ($arr as $data) {
            $role = Role::findById($data);
            if ($role->name != 'super admin') {
                $role->delete();
            }
        }

        return redirect()->route('admin.roles.index')->with('success', 'Bulk delete success');
    }
}
