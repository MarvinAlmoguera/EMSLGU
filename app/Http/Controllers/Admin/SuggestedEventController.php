<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Rules\CheckTimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuggestedEventController extends Controller
{

    public function index(){

        return view('Admin.EventSuggestion.index');

    }

    public function record(){
        $datas = Event::where('status', 'Pending')->get(['id', 'title', 'status', 'description']);
        $i = 1;

        if ($datas->count() > 0) {
            $output = '<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="suggestion_record_table">
            <thead>
                <tr class="fw-bold text-dark-600 border-bottom-0">
                    <th class="pb-3 min-w-100px">#</th>
                    <th class="pb-3 min-w-100px">Title</th>
                    <th class="pb-3 min-w-100px">Description</th>
                    <th class="pb-3 min-w-100px">Status</th>
                    <th class="pb-3 min-w-100px">Action</th>
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
                <td>
                    <span class="badge py-3 px-4  badge-light-danger fw-bold fs-6">' . $data->status . '</span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton' . $data->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $data->id . '">
                            <li><a class="dropdown-item text-success edit_event_suggestion" href="#" id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#edit_event_suggestion_modal">Edit</a></li>
                            <li><a class="dropdown-item text-danger delete_event_suggestion" href="#" id="' . $data->id . '">Delete</a></li>
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

        $data = Event::findOrFail($request->id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        // Retrieve the event being updated
        $event = Event::findOrFail($request->edit_events_id);

        // Determine if start time or end time has changed
        $startTimeChanged = $request->has('start_time') && $request->input('start_time') !== $event->start_time;
        $endTimeChanged = $request->has('end_time') && $request->input('end_time') !== $event->end_time;

        // Initialize validation rules
        $validatorRules = [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'status' => 'required',
            'monthly_highlight' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg',
            'venue' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];

        // Apply time slot validation if times have changed
        if ($request->has('date')) {
            $exists = DB::table('events')
                ->whereDate('date', $request->date) // Assuming 'date' is stored as a DATE type in the database
                ->where('id', '!=', $request->edit_events_id) // Exclude the current event if updating
                ->exists();

            // Apply time slot validation if there are existing events on the same date
            if ($exists) {
                if ($startTimeChanged || $endTimeChanged) {
                    $validatorRules['start_time'] = [
                        'required',
                        'date_format:H:i:s', // Ensure format is correct
                        new CheckTimeSlot($request->edit_events_id, $request->date, $request->start_time, $request->end_time)
                    ];

                    $validatorRules['end_time'] = [
                        'required',
                        'date_format:H:i:s', // Ensure format is correct
                        new CheckTimeSlot($request->edit_events_id, $request->date, $request->start_time, $request->end_time)
                    ];
                }
            } else {
                // Validate time slots even if no conflicting events exist
                if ($startTimeChanged || $endTimeChanged) {
                    $validatorRules['start_time'] = [
                        'required',
                        'date_format:H:i:s', // Ensure format is correct
                        new CheckTimeSlot($request->edit_events_id, $request->date, $request->start_time, $request->end_time)
                    ];

                    $validatorRules['end_time'] = [
                        'required',
                        'date_format:H:i:s', // Ensure format is correct
                        new CheckTimeSlot($request->edit_events_id, $request->date, $request->start_time, $request->end_time)
                    ];
                }
            }
        }

        // Validate incoming request
        $validator = \Validator::make($request->all(), $validatorRules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        DB::beginTransaction();
        try {
            // Update event details
            $event->title = $request->title;
            $event->date = $request->date;
            $event->description = $request->description;
            $event->monthly_highlight = $request->monthly_highlight;
            $event->status = $request->status;

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->storeAs('public/event/images', $filename);

                if ($event->picture && Storage::exists('public/event/images/' . $event->picture)) {
                    Storage::delete('public/event/images/' . $event->picture);
                }

                $event->picture = $filename;
            }

            // Update time and venue if they have changed
            if ($startTimeChanged) {
                $event->start_time = $request->start_time;
            }
            if ($endTimeChanged) {
                $event->end_time = $request->end_time;
            }
            $event->venue = $request->venue;

            $event->save(); // Save the updated event

            DB::commit();

            return response()->json([
                'status' => 200,
                'msg' => 'Event updated successfully',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'msg' => 'Failed to update event. ' . $e->getMessage(),
            ]);
        }
    }

    public function delete(Request $request){

        DB::beginTransaction();

        try {
            // Ensure the request has an ID
            if (!empty($request->id)) {
                // Find the event record by its ID
                $data = Event::find($request->id);

                // If the studevent record exists
                if ($data) {

                    // If the student has a picture, attempt to delete it
                    if ($data->picture && Storage::exists('public/event/images/' . $data->picture)) {
                        Storage::delete('public/event/images/' . $data->picture);
                    }

                    // Delete the event record
                    $data->delete();

                    // Commit the transaction
                    DB::commit();

                    return response()->json([
                        'status' => 200,
                        'msg' => 'Event Deleted Successfully.',
                    ]);

                } else {
                    // If the data record does not exist, rollback and return an error
                    DB::rollback();
                    return response()->json([
                        'status' => 0,
                        'msg' => 'Event data not found.',
                    ]);
                }
            } else {
                // If no ID is provided in the request, rollback and return an error
                DB::rollback();
                return response()->json([
                    'status' => 0,
                    'msg' => 'Invalid request. No ID provided.',
                ]);
            }
        } catch (\Exception $e) {
            // On exception, rollback the transaction and return an error message
            DB::rollback();
            return response()->json([
                'status' => 0,
                'msg' => 'Something went wrong. ' . $e->getMessage(),
            ]);
        }
    }


}
