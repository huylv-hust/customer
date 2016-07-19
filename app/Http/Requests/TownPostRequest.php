<?php

namespace App\Http\Requests;

class TownPostRequest extends Request
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

    public function messages()
    {
        return [
            'name.required' => 'Town name is required',
            'city_id.required' => 'City is required',
            'district_id.required' => 'District is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id' => 'required',
            'district_id' => 'required',
            'name' => 'required|max:100',
        ];
    }

}
