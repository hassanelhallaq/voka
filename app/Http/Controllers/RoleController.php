<?php



namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;





class RoleController extends Controller

{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {
        // if (ControllersService::checkPermission('index-role', 'admin')) {
        $page_title = 'Role';
        $page_description = '';
        $roles = Role::withCount('users')->paginate(100);
        $permissionGroups = PermissionGroup::with('permissions')->whereHas('permissions', function ($q) {
            $q->where('guard_name', 'admin');
        })->get();
        $permissionGroupsBranch = PermissionGroup::with('permissions')->whereHas('permissions', function ($q) {
            $q->where('guard_name', 'branch');
        })->get();
        return response()->view('dashboard.spatie.role.index', compact(
            'roles',
            'permissionGroupsBranch',
            'page_title',
            'page_description',
            'permissionGroups'
        ));
        // } else {
        //     return response()->view('error-6');
        // }

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        //

        // if (ControllersService::checkPermission('create-role', 'admin')) {
        return response()->view('dashboard.spatie.role.create');
        // } else {
        //     return response()->view('error-6');
        // }
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $validatedData = $request->validate([
            'role_name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        // Create a new role
        $role = Role::create([
            'name' => $validatedData['role_name'],
        ]);
        // Attach the selected permissions to the role
        if (isset($validatedData['permissions'])) {
            $role->permissions()->attach($validatedData['permissions']);
        }
        if ($role) {
            toastr()->success('Role created successfully.');
        } else {
            toastr()->error('Role created unsuccessfully.');
        }

        return redirect()->back();
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

        //
        // if (ControllersService::checkPermission('edit-role', 'admin')) {

        $role = Role::findById($id);

        return response()->view('dashboard.spatie.role.edit', compact('role'));
        // } else {
        //     return response()->view('error-6');
        // }

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

        //

        $validator = Validator($request->all(), [

            'name' => 'required|string|max:100',

            'guard_name' => 'required|string|in:admin',

        ]);



        if (!$validator->fails()) {

            $role = Role::findById($id);

            $role->name = $request->get('name');

            $role->guard_name = $request->get('guard_name');

            $isSaved = $role->save();

            return response()->json(['icon' => 'success', 'title' => 'role updated successfully'], $isSaved ? 200 : 400);
        } else {

            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //
        if (ControllersService::checkPermission('delete-role', 'admin')) {

            $isDeleted = Role::destroy($id);

            return response()->json(['icon' => 'success', 'title' => 'role deleted successfully'], $isDeleted ? 200 : 400);
        } else {
            return response()->view('error-6');
        }
    }
}
