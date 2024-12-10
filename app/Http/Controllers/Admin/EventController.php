<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventRating;
use App\Models\EventComment;
use App\Rules\CheckTimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(){

        //Route to go on the specific page
        return view('Admin.Event.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'monthly_highlight' => 'required',
            // 'file' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'file' => 'required|image|mimes:jpeg,png,jpg',
            'start_time' => [
                'required',
                'date_format:H:i:s', // Updated format
                new CheckTimeSlot(null, $request->date, $request->start_time, $request->end_time)
            ],
            'end_time' => [
                'required',
                'date_format:H:i:s', // Updated format
                new CheckTimeSlot(null, $request->date, $request->start_time, $request->end_time)
            ],
            'venue' => 'required',
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
            // Handle file upload for 'file' field
            $filename = null; // Default value if no file uploaded

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension(); // Get file extension
                $filename = time() . '.' . $extension; // Generate unique filename
                $file->storeAs('public/event/images', $filename); // Store file
            }

            // Create Event Record
            Event::create([
                'title' => $request->title,
                'date' => $request->date,
                'description' => $request->description,
                'monthly_highlight' => $request->monthly_highlight,
                'picture' => $filename,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'venue' => $request->venue,
                'status' => 'Approved',
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json([
                'status' => 200,
                'msg' => 'Event Created Successfully',
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'msg' => 'Failed to create event. ' . $e->getMessage(),
            ]);
        }
    }

    public function allrecord() {

        $datas = Event::where('status', 'Approved')
                      ->get();
        $i=1;
        if ($datas->count() > 0) {
            $output = '<table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="all_record_table">
                <thead>
                    <tr class="fw-bold text-dark-600 border-bottom-0">
                        <th class="pb-3 min-w-100px">#</th>
                        <th class="pb-3 min-w-100px">Image</th>
                        <th class="pb-3 min-w-100px">Title</th>
                        <th class="pb-3 min-w-100px">Description</th>
                        <th class="pb-3 min-w-100px">Date</th>
                        <th class="pb-3 min-w-100px">Time</th>
                        <th class="pb-3 min-w-100px">Venue</th>
                        <th class="pb-3 min-w-100px">Monthly Highlight</th>
                        <th class="pb-3 min-w-100px">Action</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($datas as $data) {
                $description = ucfirst($data->description);
                $description = strlen($description) > 50 ? substr($description, 0, 47) . '...' : $description;
                $formattedDate = Carbon::parse($data->date)->format('F j, Y');

                $output .= '<tr>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $i++ . '</span>
                    </td>
                    <td class="text-center">';
                        if ($data->picture != null) {
                            $output .= '<img src="storage/event/images/' . $data->picture . '" style="width:100px; height:100px;">';
                        } else {
                            $output .= 'No image available';
                        }
                $output .= '</td>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $data->title . '</span>
                    </td>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $description . '</span>
                    </td>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $formattedDate . '</span>
                    </td>
                    <td>
                        <span class="text-gray-500 fw-bold fs-6">' .Carbon::parse( $data->start_time)->format('h:i A') .' - '. Carbon::parse( $data->end_time)->format('h:i A') . '</span>
                    </td>
                     <td>
                        <span class="text-gray-500 fw-bold fs-6">' . $data->venue . '</span>
                    </td>
                    <td>';
                        if($data->monthly_highlight === 1){
                            $output .='<span class="badge py-3 px-4  badge-light-success fw-bold fs-6"> Selected</span>';

                        }else{
                            $output .='<span class="badge py-3 px-4  badge-light-danger fw-bold fs-6"> Not Selected</span>';
                        }

         $output .='</td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton' . $data->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $data->id . '">
                                <li><a class="dropdown-item text-primary view_event" href="#" id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#view_event_modal">View</a></li>
                                <li><a class="dropdown-item text-success edit_event" href="#" id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#edit_event_modal">Edit</a></li>
                                <li><a class="dropdown-item text-danger delete_event" href="#" id="' . $data->id . '">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>';
            }

            $output .= '</tbody></table>';
            echo $output;

        }
    }

    public function view(Request $request){

        $data = Event::findOrFail($request->id);
        return response()->json($data);
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
            'start_time' => 'required',
            'end_time' => 'required',
            'monthly_highlight' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg',
            // 'file' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'venue' => 'required',
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

    // public function delete(Request $request){

    //     DB::beginTransaction();

    //     try {
    //         // Ensure the request has an ID
    //         if (!empty($request->id)) {
    //             // Find the event record by its ID
    //             $data = Event::find($request->id);

    //             // If the studevent record exists
    //             if ($data) {

    //                 // If the student has a picture, attempt to delete it
    //                 if ($data->picture && Storage::exists('public/event/images/' . $data->picture)) {
    //                     Storage::delete('public/event/images/' . $data->picture);
    //                 }

    //                 // Delete the event record
    //                 $data->delete();

    //                 // Commit the transaction
    //                 DB::commit();

    //                 return response()->json([
    //                     'status' => 200,
    //                     'msg' => 'Event Deleted Successfully.',
    //                 ]);

    //             } else {
    //                 // If the data record does not exist, rollback and return an error
    //                 DB::rollback();
    //                 return response()->json([
    //                     'status' => 0,
    //                     'msg' => 'Event data not found.',
    //                 ]);
    //             }
    //         } else {
    //             // If no ID is provided in the request, rollback and return an error
    //             DB::rollback();
    //             return response()->json([
    //                 'status' => 0,
    //                 'msg' => 'Invalid request. No ID provided.',
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         // On exception, rollback the transaction and return an error message
    //         DB::rollback();
    //         return response()->json([
    //             'status' => 0,
    //             'msg' => 'Something went wrong. ' . $e->getMessage(),
    //         ]);
    //     }
    // }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        try {
            // Ensure the request has an ID
            if (!empty($request->id)) {
                // Find the event record by its ID
                $data = Event::find($request->id);

                // If the event record exists
                if ($data) {
                    // Delete associated ratings
                    EventRating::where('event_id', $data->id)->delete();

                    // Delete associated comments
                    EventComment::where('event_id', $data->id)->delete();

                    // If the event has a picture, attempt to delete it
                    if ($data->picture && Storage::exists('public/event/images/' . $data->picture)) {
                        Storage::delete('public/event/images/' . $data->picture);
                    }

                    // Delete the event record
                    $data->delete();

                    // Commit the transaction
                    DB::commit();

                    return response()->json([
                        'status' => 200,
                        'msg' => 'Event and its related ratings/comments deleted successfully.',
                    ]);
                } else {
                    // If the event does not exist, rollback and return an error
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
