<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $day = $this->input('day');
            $periods = [
                'M' => '08:30 - 13:30',
                'M1' => '08:30 - 11:00',
                'M2' => '11:00 - 13:30',
                'A' => '13:30 - 18:30',
                'A1' => '13:30 - 16:00',
                'A2' => '16:00 - 18:30'
            ];
            $period = $this->input('period');
            $timeRange = $periods[$period] ?? 'an unknown time'; // Provide a default message in case the period code is not found
            if ($this->isUnavailable('teacher', $this->input('teacher'), $day, $period)) {
                $validator->errors()->add('teacher', "Teacher is not available on {$day} at {$timeRange}.");
            }

            if ($this->isUnavailable('room', $this->input('room'), $day, $period)) {
                $validator->errors()->add('room', "Room is not available on {$day} at {$timeRange}.");
            }

            if ($this->isUnavailable('group', $this->input('group'), $day, $period)) {
                $validator->errors()->add('group', "Group is not available on {$day} at {$timeRange}.");
            }
        });
    }
    private function isUnavailable($type, $value, $day, $periodCode)
    {
        // Define your period time slots
        $periodTimes = [
            'M' => ['start' => '08:30', 'end' => '13:30'],
            'M1' => ['start' => '08:30', 'end' => '11:00'],
            'M2' => ['start' => '11:00', 'end' => '13:30'],
            'A' => ['start' => '13:30', 'end' => '18:30'],
            'A1' => ['start' => '13:30', 'end' => '16:00'],
            'A2' => ['start' => '16:00', 'end' => '18:30'],
        ];

        // Convert the period code to the actual times
        $requestedPeriod = $periodTimes[$periodCode];

        // Check the existing schedules for overlaps
        $schedules = \DB::table('time_schedules')
                        ->where($type, $value)  // 'type' will be the column name ('teacher', 'room', or 'group').
                        ->where('day', $day)
                        ->get();

        foreach ($schedules as $schedule) {
            // Get the start and end times for the existing schedule
            $existingPeriod = $periodTimes[$schedule->period];

            // Check for overlap
            $overlap = $this->timesOverlap($requestedPeriod['start'], $requestedPeriod['end'], $existingPeriod['start'], $existingPeriod['end']);

            if ($overlap) {
                return true; // There is an overlap, hence unavailable
            }
        }

        return false; // No overlap found, it's available
    }

    private function timesOverlap($start1, $end1, $start2, $end2)
    {
        return !($end1 <= $start2 || $start1 >= $end2);
    }


}
