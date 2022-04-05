<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class ReportPackageRequest extends FormRequest
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
            'notes' => 'max:65535',
            'recipient.name' => 'required|max:255',
            'recipient.address.country' => 'required|max:255',
            'recipient.address.city' => 'required|max:255',
            'recipient.address.street' => 'required|max:255',
            'recipient.address.house_number' => 'required',
            'recipient.address.addition' => 'max:1',
            'recipient.address.postal_code' => 'required|max:10',
            'recipient.phone' => 'required|max:16',
            'recipient.email' => 'required|email|max:255',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
