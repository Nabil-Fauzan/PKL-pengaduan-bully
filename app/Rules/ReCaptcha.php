<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Verifikasi reCAPTCHA wajib diselesaikan.');
            return;
        }

        $secret = config('services.recaptcha.secret');

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            if (!$response->successful() || !$response->json('success')) {
                $fail('reCAPTCHA tidak valid. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            $fail('Gagal menghubungi server reCAPTCHA: ' . $e->getMessage());
        }
    }
}
