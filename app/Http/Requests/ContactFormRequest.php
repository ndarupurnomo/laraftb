<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactFormRequest extends Request
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
            'name' => 'required',
            'email' => 'required|email',
            'user_message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email Address',
            'user_message' => 'User Message',
            'g-recaptcha-response' => 'Recaptcha',
        ];
    }

}
