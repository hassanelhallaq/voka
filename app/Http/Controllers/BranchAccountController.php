<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreBranchAccounRequest;
use App\Models\BranchAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BranchAccountController extends Controller
{
    public function create($id)
    {
        $roles = Role::where('guard_name', 'branch')->paginate(10);

        $users  =  BranchAccount::where('branch_id', $id)->paginate(10);
        return view('dashboard.branch.accounts', compact('users', 'id', 'roles'));
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
        if ($isSaved) {
            $role = Role::find($request->role_id);
            $branch->assignRole($role);
            toastr()->success('Account store successfully.');
        } else {
            toastr()->error('Account store unsuccessfully.');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $isDeleted = BranchAccount::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'permission deleted successfully'], $isDeleted ? 200 : 400);
    }
}
