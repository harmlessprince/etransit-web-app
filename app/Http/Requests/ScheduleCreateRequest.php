<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\RequiredIf;

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
        $isEticketUser = Auth::guard('e-ticket')->user();

        return [
//            'terminal_id' => 'required',
            'bus_id' => 'required',
            'pickup_id' => 'required',
            'pick_up_address' => 'required',
            'destination_id' => 'required',
            'fare_adult' => 'required',
//            'service_id' => 'required',
            'fare_children' => 'required',
            'departure_date' => 'required',
            'departure_time' => 'required',
            'tenant_id' => [new RequiredIf(!!$isEticketUser == false)],
            'seats_available' => 'required',
        ];
    }
}
