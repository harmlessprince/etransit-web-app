<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'terminal_id' => 'required',
            'bus_id' => 'required',
            'pickup_id' => 'required',
            'destination_id' => 'required',
            'fare_adult' => 'required',
            'service_id' => 'required',
            'fare_children' => 'required',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'tenant_id' => 'required',
            'seats_available' => 'required',
        ];
    }
}
