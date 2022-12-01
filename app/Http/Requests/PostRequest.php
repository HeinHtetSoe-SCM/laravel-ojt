<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:20',
            'description' => 'required|max:50',
            'status' => 'required|max:15'
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
            'title.required' => 'Title ဖြည့်ပေးပါခင်ဗျာ။',
            'title.max' => 'Title တွင် စာလုံးရေ အလုံး ၂၀ သာ လက်ခံပါသည်။',
            'description.required' => 'Description ဖြည့်ပေးပါခင်ဗျာ။',
            'description.max' => 'Description တွင် စာလုံးရေ အလုံး ၅၀ သာ လက်ခံပါသည်။',
            'status.required' => 'Status ဖြည့်ပေးပါခင်ဗျာ။',
            'status.max' => 'Status တွင် စာလုံးရေ အလုံး ၁၅ လုံးသာ လက်ခံပါသည်။'
        ];
    }
}

