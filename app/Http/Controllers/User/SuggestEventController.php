<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SuggestEventController extends Controller
{
    public function index()
    {
       return view('User.Event-Suggestion.index');
    }

    public function store(Request $request)
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

            // Create Event Record
            Event::create([

                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'Pending',
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json([
                'status' => 200,
                'msg' => 'Event Suggestion Created Successfully',
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'msg' => 'Failed to create event suggestion. ' . $e->getMessage(),
            ]);
        }
    }

    public function SuggestEventRecord(){

        $datas = Event::where('user_id', Auth::user()->id)
                        ->get();
        $i=1;
        if ($datas->count() > 0) {
            $output = '<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="suggested_event_record_table">
                <thead>
                    <tr class="fw-bold text-dark-600 border-bottom-0">
                        <th class="pb-3 min-w-100px">#</th>
                        <th class="pb-3 min-w-100px">Title</th>
                        <th class="pb-3 min-w-100px">Description</th>
                        <th class="pb-3 min-w-100px">Status</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($datas as $data) {
                $description = ucfirst($data->description);
                $description = strlen($description) > 50 ? substr($description, 0, 47) . '...' : $description;

                $output .= '<tr>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $i++ . '</span>
                    </td>

                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $data->title . '</span>
                    </td>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $description . '</span>
                    </td>
                     <td>';
                            if($data->status == 'Approved'){
                                $output .='<span class="badge py-3 px-4  badge-light-success fw-bold fs-6"> Approved</span>';

                            }else{
                                $output .='<span class="badge py-3 px-4  badge-light-danger fw-bold fs-6"> Pending</span>';
                            }

          $output .='</td>

                </tr>';
            }

            $output .= '</tbody></table>';
            echo $output;

        }
    }

}
