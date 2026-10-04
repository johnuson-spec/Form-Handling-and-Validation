<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsbnChecksum implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{13}$/', $value)) {
            $fail('The :attribute must contain exactly 13 digits.');
            return;
        }

        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $digit = (int) $value[$i];
            $sum += ($i % 2 === 0) ? $digit : $digit * 3;
        }

        $remainder = $sum % 10;
        $calculatedCheckDigit = (10 - $remainder) % 10;
        $actualCheckDigit = (int) $value[12];

        if ($calculatedCheckDigit !== $actualCheckDigit) {
            $fail('The :attribute possesses an invalid ISBN-13 checksum digit.');
        }
    }
}