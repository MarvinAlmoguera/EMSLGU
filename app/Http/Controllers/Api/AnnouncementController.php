<?php
namespace App\Http\Controllers\Api;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    public function Announcements()
    {
        $data = Announcement::all();
    
        return response()->json([
            'status' => 200,
            'msg' => $data->isEmpty() ? 'No Announcement Record Found.' : 'Announcements retrieved successfully.',
            'data' => $data
        ], 200);
    }

    public function Store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'announcement_title' => 'required',
            'announcement_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->errors()->toArray()
            ]);
        }

        try {
            DB::beginTransaction();

            $announcement = Announcement::create([
                'announcement_title' => $request->announcement_title,
                'announcement_description' => $request->announcement_description,
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'msg'    => 'New Announcement Created Successfully',
                'data'   => $announcement
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'msg'    => 'Failed To Create Announcement. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function Update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'announcement_title' => 'required',
            'announcement_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->errors()->toArray()
            ]);
        }

        try {
            DB::beginTransaction();

            $announcement = Announcement::find($id);
            if (!$announcement) {
                return response()->json([
                    'status' => 404,
                    'msg'    => 'Announcement Not Found'
                ], 404);
            }

            $announcement->update([
                'announcement_title' => $request->announcement_title,
                'announcement_description' => $request->announcement_description,
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'msg'    => 'Announcement Updated Successfully',
                'data'   => $announcement
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'msg'    => 'Failed To Update Announcement. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function Delete($id)
    {
        try {
            DB::beginTransaction();

            $announcement = Announcement::find($id);
            if (!$announcement) {
                return response()->json([
                    'status' => 404,
                    'msg'    => 'Announcement Not Found'
                ], 404);
            }

            $announcement->delete();

            DB::commit();
            return response()->json([
                'status' => 200,
                'msg'    => 'Announcement Deleted Successfully'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'msg'    => 'Failed To Delete Announcement. ' . $e->getMessage(),
            ], 500);
        }
    }
}
