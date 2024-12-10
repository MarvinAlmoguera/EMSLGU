<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserAccountController extends Controller
{
    public function index(){
        return view('Admin.User-Account.index');
    }
    public  function UserRecord()
    {
        $users = User::where('role','user')->get();
        $i=1;
        if ($users->count() > 0) {
            $output = '<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="all_user_record_table">
                <thead>
                    <tr class="fw-bold text-dark-600 border-bottom-0">
                        <th class="pb-3 min-w-100px">#</th>
                        <th class="pb-3 min-w-100px">Profile Picture</th>
                        <th class="pb-3 min-w-100px">FirstName</th>
                        <th class="pb-3 min-w-100px">LastName</th>
                        <th class="pb-3 min-w-100px">Age</th>
                        <th class="pb-3 min-w-100px">Gender</th>
                        <th class="pb-3 min-w-100px">Address</th>
                        <th class="pb-3 min-w-100px">Action</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($users as $data) {

                $output .= '<tr>
                                <td>
                                    <span class="text-gray-500 fw-bold fs-6">' .$i++. '</span>
                                </td>
                                <td>
                                    <img src="storage/profile-picture/images/' . $data->profile_picture . '" style="width:100px; height:100px;">
                                </td>

                                <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $data->firstname . '</span>
                                </td>
                                <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $data->lastname . '</span>
                                </td>
                                 <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $data->age . '</span>
                                </td>
                                 <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $data->gender . '</span>
                                </td>
                                 <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $data->address . '</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton' . $data->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $data->id . '">
                                            <li><a class="dropdown-item text-success edit_user" href="#" id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#edit_user_account_modal">Edit</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>';
            }

            $output .= '</tbody></table>';
            echo $output;

        }

    }

    public function edit(Request $request){
        $data = User::findOrFail($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $user = User::FindOrFail($request->id);

        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
            'address' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // Exclude current user's email
            ],
        ];

        // Conditionally add password validation rules if password is present
        if ($request->filled('password')) {
            $rules['password'] = [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
            ];
        }

        $messages = [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min'   => 'The password must be at least 8 characters long.',
            'password.max'   => 'The password may not be greater than 20 characters.',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        DB::beginTransaction();

        try {

            // Update event details
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->age = $request->age;
            $user->address = $request->address;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            // Handle file upload
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->storeAs('public/profile-picture/images', $filename);

                if ($user->profile_picture && Storage::exists('public/profile-picture/images/' . $user->profile_picture)) {
                    Storage::delete('public/profile-picture/images/' . $user->profile_picture);
                }

                $user->profile_picture = $filename;
            }


            $user->save();

            DB::commit();

            return response()->json([
                'status' => 200,
                'msg' => 'user Account Updated Successfully',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'msg' => 'Failed to Update User. ' . $e->getMessage(),
            ]);
        }


    }
}
