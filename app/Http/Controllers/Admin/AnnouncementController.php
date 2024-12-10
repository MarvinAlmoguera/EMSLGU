<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('Admin.Announcement.index');
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',

        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        // Begin transaction
        DB::beginTransaction();

        try {
            // Create Announcement Record
            Announcement::create([
                'announcement_title' => $request->title,
                'announcement_description' => $request->description,
            ]);

            // Commit the transaction
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => 'Announcement Created Successfully',
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'msg' => 'Failed to create announcement. ' . $e->getMessage(),
            ]);
        }
    }

    public function AllAnnouncementRecord(){

        $records = Announcement::all();
        $i=1;
        if ($records->count() > 0) {
            $output = '<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="all_announcement_table">
                <thead>
                    <tr class="fw-bold text-dark-600 border-bottom-0">
                        <th class="pb-3 min-w-100px">#</th>
                        <th class="pb-3 min-w-100px">Title</th>
                        <th class="pb-3 min-w-100px">Description</th>
                        <th class="pb-3 min-w-100px">Action</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($records as $data) {
                $description = ucfirst($data->announcement_description);
                $description = strlen($description) > 50 ? substr($description, 0, 47) . '...' : $description;

                $output .= '<tr>
                                <td>
                                     <span class="text-gray-500 fw-bold fs-6">' . $i++ . '</span>
                                </td>
                                <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $data->announcement_title . '</span>
                                </td>
                                <td>
                                    <span class="text-gray-500 fw-bold fs-6">' . $description . '</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton' . $data->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $data->id . '">
                                            <li><a class="dropdown-item text-primary view_announcement" href="#" id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#view_announcement_modal">View</a></li>
                                            <li><a class="dropdown-item text-success edit_announcement" href="#" id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#edit_announcement_modal">Edit</a></li>
                                            <li><a class="dropdown-item text-danger delete_announcement" href="#" id="' . $data->id . '">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>';
            }

            $output .= '</tbody></table>';
            echo $output;

        }


    }

    public  function  view(Request $request)
    {
        $data = Announcement::FindOrFail($request->id);
        return response()->json($data);
    }

    public  function  edit(Request $request)
    {
        $data = Announcement::FindOrFail($request->id);
        return response()->json($data);
    }

    public  function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',

        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        // Begin transaction
        DB::beginTransaction();
        try {

            // Update Announcement Record
            $data = Announcement::FindOrFail($request->edit_announcement_id);
            $data->announcement_title = $request->title;
            $data->announcement_description = $request->description;
            $data->update();

            // Commit the transaction
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => 'Announcement Updated Successfully',
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'msg' => 'Failed to update announcement. ' . $e->getMessage(),
            ]);
        }
    }

    public function delete(Request $request){

        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                $announcement_delete = Announcement::find($request->id);
                Announcement::destroy($request->id);

                DB::commit();
                return response()->json([
                    'status' => 200,
                    'msg' => 'Announcement Deleted Successfully',
                ]);
            }

        } catch(\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'msg' => 'Something went wrong. ' . $e->getMessage(), // Optionally include error message
            ]);

        }

    }



}
