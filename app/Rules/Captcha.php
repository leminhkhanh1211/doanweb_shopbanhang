<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use ReCaptcha\ReCaptcha;

class Captcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Kiểm tra reCAPTCHA
        $recaptcha = new ReCaptcha(env('CAPTCHA_SECRET'));

        // Thực hiện xác thực reCAPTCHA
        $response = $recaptcha->verify($value, request()->ip());

        // Nếu không thành công, thêm lỗi vào
        if (!$response->isSuccess()) {
            $fail('Làm ơn check mã captcha.');
        }
    }
}

