<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreBranchRequest;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount('lounges', 'tables')->with(['reservations' => function ($q) {
            $q->where('date', Carbon::today());
        }])->get();

        return view('dashboard.branch.branches', compact('branches'));
    }
    public function create()
    {
        $roles = Role::where('guard_name', 'branch')->paginate(10);

        return view('dashboard.branch.create', compact('roles'));
    }

    public function store(StoreBranchRequest $request)
    {
        $branch = new Branch();
        $branch->name = $request->get('name');
        $branch->name_en = $request->get('name_en');
        $branch->phone = $request->get('phone');
        $branch->manger = $request->get('manger');
        $isSaved = $branch->save();
        $role = Role::where('id', $request->role_id)->first();
        $branch->assignRole($role);
        if ($isSaved) {

            toastr()->success('Branch store successfully.');
        } else {
            toastr()->error('Branch store unsuccessfully.');
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $roles = Role::where('guard_name', 'branch')->paginate(10);
        $branch =   Branch::find($id);
        return view('dashboard.branch.edit', compact('branch'));
    }
    public function update(StoreBranchRequest $request, $id)
    {
        $branch =   Branch::find($id);
        $branch->name = $request->get('name');
        $branch->name_en = $request->get('name_en');
        $branch->phone = $request->get('phone');
        $branch->manger = $request->get('manger');
        $isSaved = $branch->save();
        $branch->removeRole($branch->roles);
        $role = Role::find($request->get('role_id'));
        $branch->assignRole($role);
        if ($isSaved) {

            toastr()->success('Branch update successfully.');
        } else {
            toastr()->error('Branch update unsuccessfully.');
        }
        return redirect()->back();
    }
}
