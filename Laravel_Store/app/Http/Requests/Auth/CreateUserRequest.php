<?php

namespace App\Http\Requests\Auth;

use App\Rules\Phone;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name:min'=> 'User name should be more than 4 symbols',
            'surname:min'=> 'Surname name should be more than 4 symbols',
            'phone' => 'Incorrent phone format',
            'password'=> 'Incorrent password'
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'min:4', 'max:35'],
            'surname' => ['required', 'min:4', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users', new Phone],
            'birthdate' => ['required', 'date', 'before_or_equal:-18 years'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];
    }
}
