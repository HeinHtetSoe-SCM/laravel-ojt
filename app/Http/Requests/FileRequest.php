<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,txt,xlsx|max:2048'
        ];
    }

        /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'file.required' => 'File ထည့်ပေးပါခင်ဗျာ။',
            'file.mimes' => 'File type မှားနေပါသည်။',
            'file.max' => 'File size ကြီးလွန်းနေပါသည်။'
        ];
    }
}
