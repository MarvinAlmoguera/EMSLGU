<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function index(){

        return view('auth.registration');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'age'       => ['required', 'integer'],
            'gender'    => ['required', 'string'],
            'address'   => ['required', 'string'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            'password'  => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
            ],
        ], [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min'   => 'The password must be at least 8 characters long.',
            'password.max'   => 'The password may not be greater than 20 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        try {
            // Begin transaction
            DB::beginTransaction();

            $filename = null; // Default value if no file uploaded

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension(); // Get file extension
                $filename = time() . '.' . $extension; // Generate unique filename
                $file->storeAs('public/profile-picture/images', $filename); // Store file
                \Log::info('File uploaded: ' . $filename);
            } else {
                \Log::warning('No file uploaded');
            }

            // Register Account
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'age'  => $request->age,
                'gender' => $request->gender,
                'address' => $request->address,
                'profile_picture' => $filename,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            // Commit the transaction
            DB::commit();

            // Dispatch registered event
            event(new Registered($user));
            Auth::login($user);

            return response()->json([
                'status' => 200,
                'msg' => 'Your account has been created successfully! You will be redirected to the dashboard shortly',
                'redirect' => route('user.dashboard.index') // Include redirect URL in response
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            \Log::error('Error: ' . $e->getMessage()); // Log the error

            return response()->json([
                'status' => 0,
                'msg' => 'Failed to create user. ' . $e->getMessage(),
            ]);
        }
    }

}
