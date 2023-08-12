<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreBranchAccounRequest;
use App\Models\BranchAccount;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BranchAccountController extends Controller
{
    public function create($id)
    {
        $roles = Role::where('guard_name', 'branch')->paginate(10);
        $shifts = Shift::all();

        $users  =  BranchAccount::where('branch_id', $id)->paginate(10);
        return view('dashboard.branch.accounts', compact('users', 'id', 'roles', 'shifts'));
    }
    public function index()
    {
        $roles = Role::where('guard_name', 'branch')->paginate(10);
        $users  =  BranchAccount::paginate(10);
        return view('dashboard.branch.branchAccounts', compact('users', 'roles'));
    }
    public function store(StoreBranchAccounRequest $request, $id)
    {

        $branch = new BranchAccount();
        $branch->phone = $request->get('phone');
        $branch->name = $request->get('name');
        $branch->password = Hash::make($request->get('password'));
        $branch->branch_id = $id;
        $isSaved = $branch->save();
        $shiftId = $request->input('shift_id');
        $branch->assignRole($role);
        $branch->shifts()->attach($shiftId);
        $role = Role::find($request->role_id);
        $branch->assignRole($role);
        return redirect()->back()->with('success', 'User created successfully');
    }
    public function update(Request $request, $id)
    {
        $branch =  BranchAccount::find($id);
        $branch->phone = $request->get('phone');
        $branch->name = $request->get('name');
        $isSaved = $branch->save();
        $shiftId = $request->input('shift_id');
        $branch->shifts()->detach();
        $branch->shifts()->attach($shiftId);
        $role = Role::find($request->role_id);
        $branch->assignRole($role);
        return redirect()->back()->with('success', 'User created successfully');
    }
    public function destroy($id)
    {
        $isDeleted = BranchAccount::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'permission deleted successfully'], $isDeleted ? 200 : 400);
    }
}
