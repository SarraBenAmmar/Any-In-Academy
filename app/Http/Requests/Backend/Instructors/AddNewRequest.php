<?php

namespace App\Http\Requests\Backend\Instructors;

use Illuminate\Foundation\Http\FormRequest;

class AddNewRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/', // Adjust regex for your region
        ];
    }

    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }
}

