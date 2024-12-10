<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserProfileAccountController extends Controller
{
    public function index(){

        return view('User.Profile.index');
    }

    public function update(Request $request)
    {
        $user_update = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg',
            'gender' => 'required',
            'age' => 'required',
            'address' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'password' => $request->filled('password') ? [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
                'confirmed',
            ] : [
                'nullable',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
            ],
        ], [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.max' => 'The password may not be greater than 20 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'email.unique' => 'The email address is already taken.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Update event details
            $user_update->firstname = $request->firstname;
            $user_update->lastname = $request->lastname;
            $user_update->address = $request->address;
            $user_update->age = $request->age;
            $user_update->email = $request->email;

            // Handle file upload
            if($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->storeAs('public/profile-picture/images', $filename);

                if ($user_update->profile_picture && Storage::exists('public/profile-picture/images/' . $user_update->profile_picture)) {
                    Storage::delete('public/profile-picture/images/' . $user_update->profile_picture);
                }

                $user_update->profile_picture = $filename;
            }

            if ($request->filled('password')) {
                $user_update->password = Hash::make($request->input('password'));
            }

            $user_update->save();
            DB::commit();

            $notification = array(
                'message' => 'Your account is updated successfully.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'msg' => 'Failed to update user account. ' . $e->getMessage(),
            ]);
        }
    }
}
