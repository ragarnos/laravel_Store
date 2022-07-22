<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{


    public function passes($attribute, $value)
    {
        preg_match('/\+[0-9]{2}\([0-9]{3}\)[0-9]{7}/', $value, $matches);

        return !empty($matches);
    }

    public function message()
    {
        return 'The validation phone error message. = +X(XXX)';
    }
}
