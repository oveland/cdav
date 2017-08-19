<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventory extends FormRequest
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
            "number" => "required|string|max:100|unique:inventories",
            "admission_reason_id" => "required|integer",
            "plate" => "required|string|size:7",
            "engine_number" => "required|string|max:45",
            "chassis_number" => "required|string|max:45",
            "model" => "required|integer|min:1990|max:2030",
            "color" => "required|string|max:20",
            "registration_city" => "required|string|max:45",
            "cars_state_id" => "required|integer",
            "identity" => "required|string|max:20",
            "name" => "required|string|max:45",
            "address" => "required|string|max:100",
            "phone" => "string|max:45",
            "email" => "nullable|string|max:45"
        ];
    }
}
