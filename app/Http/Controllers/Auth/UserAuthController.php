<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use App\Models\BranchAccount;
use App\Models\Lounge;
use App\Models\Package;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;



class UserAuthController extends Controller

{
    public function showLogin()
    {
        return response()->view('pages.auth.login_branch', ['guard' => 'branch']);
    }


    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'phone.required' => 'phone is required',
            'email.email' => 'Please enter the correct e-mail',
            'password.required' => 'Password is required',
            'guard.in' => 'Enter the correct user'
        ]);
        $credentials = [
            'phone' => $request->get('phone'),
            'password' => $request->get('password'),
        ];
        $user = BranchAccount::where('phone', $request->get('phone'))->first();
        $shifts = $user->shifts;

        $now = Carbon::now();
        foreach ($shifts as $shift) {
            $startTime = Carbon::createFromFormat('H:i:s', $shift->start_time);
            $endTime = Carbon::createFromFormat('H:i:s', $shift->end_time);

            if ($shift->day === $now->format('l') && $now->between($startTime->startOfDay(), $endTime->endOfDay())) {
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Login Faild'], 400);
            }
        }
        if (!$validator->fails()) {
            if (Auth::guard('branch')->attempt($credentials)) {
                return response()->json(['icon' => 'success', 'title' => 'Login Successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Login Faild'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }



    public function logout(Request $request)

    {
        // Auth::guard()->logout();
        // $request->session()->invalidate();
        // return redirect()->route('dashboard.login', 'admin');

        $guard = auth('admin')->check() ? 'admin' : 'employee';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login', $guard);
    }



    public function editPassword()
    {
        return response()->view('dashboard.auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
            'new_password_confirmation' => 'required|string'
        ]);
        if (!$validator->fails()) {
            $admin = Admin::findOrFail(Auth()->guard('admin')->user()->id);
            $admin->password = Hash::make($request->get('new_password'));
            $isSaved = $admin->save();
            return response()->json(['icon' => 'success', 'title' => 'Password update successfully'], $isSaved ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'Password update faild'], 400);
        }
    }







    public function editProfile()
    {
        $edit = Admin::findOrFail(Auth::guard('admin')->id());
        return view('dashboard.auth.edit-profile', compact('edit'));
    }



    public function updateProfile(Request $request)
    {
        $validator = Validator($request->all(), [

            // 'first_name' => 'string|min:3|max:35',

            // 'last_name' => 'string|min:3|max:35',

            // 'mobile' => 'numeric',

            // 'email' => 'email|unique:admins,email,',

            // 'birth_date' => 'date',

            // 'gender' => 'string|max:1|in:M,F',

            // 'image' => 'image|max:2048|mimes:png,jpg,jpeg',

        ]);

        if (!$validator->fails()) {

            $admin = Admin::findOrFail(Auth::guard('admin')->id());

            $admin->email = $request->email;


            if ($request->file('image')) {
                $image = $request->file('image');
                $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();
                $image->storeAs('images/admin', $imageName, ['disk' => 'public']);
                $admin->image = $imageName;
            }


            // $image = $request->file('image');

            // $imageName = time() . '_Admin.' . $image->getClientOriginalExtension();

            // $image->storeAs('images/admin', $imageName, ['disk' => 'public']);

            // $admin->image = $imageName;



            $isSaved = $admin->save();

            if ($isSaved) {

                $user = $admin->user;

                $user->first_name = $request->first_name;

                $user->last_name = $request->last_name;

                $user->mobile = $request->mobile;

                $user->birth_date = $request->birth_date;

                $user->gender = $request->gender;

                $isSaved = $user->save();

                return ['redirect' => route('admin.dashboard')];

                return response()->json(

                    ['status' => true, 'message' => "Updated Successfully"],
                    200
                );
            }
        } else {

            return response()->json(
                ['status' => false, 'message' => $validator->getMessageBag()->first()],
                400

            );
        }
    }
}
