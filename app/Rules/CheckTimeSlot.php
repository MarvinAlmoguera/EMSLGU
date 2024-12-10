<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckTimeSlot implements Rule
{
    private $id;
    private $newDate;
    private $newStartTime;
    private $newEndTime;

    /**
     * Create a new rule instance.
     *
     * @param  int|null  $id
     * @param  string  $newDate
     * @param  string  $newStartTime
     * @param  string  $newEndTime
     * @return void
     */
    public function __construct($id = null, $newDate = null, $newStartTime = null, $newEndTime = null)
    {
        $this->id = $id;
        $this->newDate = $newDate;
        $this->newStartTime = $newStartTime;
        $this->newEndTime = $newEndTime;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute, $value)
    {
        // Convert times to Carbon instances using H:i:s format
        $startTime = Carbon::createFromFormat('H:i:s', $this->newStartTime);
        $endTime = Carbon::createFromFormat('H:i:s', $this->newEndTime);

        // Ensure start time is before end time
        if ($startTime->greaterThanOrEqualTo($endTime)) {
            return false;
        }

        // Check if the time slot overlaps with other events on the same date
        $query = DB::table('events')
            ->whereDate('date', Carbon::parse($this->newDate)->toDateString())
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('start_time', [$startTime->format('H:i:s'), $endTime->format('H:i:s')])
                        ->orWhereBetween('end_time', [$startTime->format('H:i:s'), $endTime->format('H:i:s')])
                        ->orWhere(function ($q) use ($startTime, $endTime) {
                            $q->where('start_time', '<=', $startTime->format('H:i:s'))
                                ->where('end_time', '>=', $endTime->format('H:i:s'));
                        });
                });
            });

        // Exclude the current record if updating
        if ($this->id) {
            $query->where('id', '!=', $this->id);
        }

        return !$query->exists();
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected time slot is already taken or the start time is not before the end time.';
    }
}
