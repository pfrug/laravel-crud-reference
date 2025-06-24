<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidSpanishNif implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = strtoupper((string) $value);

        if (
            ! $this->validateDni($value)
            && ! $this->validateNie($value)
            && ! $this->validateCif($value)
        ) {
            $fail('The ' . $attribute . ' must be a valid Spanish NIF (DNI, NIE or CIF).');
        }
    }

    private function validateDni(string $nif): bool
    {
        if (! preg_match('/^\d{8}[A-Z]$/', $nif)) {
            return false;
        }

        $number = (int) substr($nif, 0, 8);
        $letter = $nif[8];
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';

        return $letter === $letters[$number % 23];
    }

    private function validateNie(string $nif): bool
    {
        if (! preg_match('/^[XYZ]\d{7}[A-Z]$/', $nif)) {
            return false;
        }

        $map = ['X' => '0', 'Y' => '1', 'Z' => '2'];
        $prefix = $map[$nif[0]];
        $number = (int) ($prefix . substr($nif, 1, 7));
        $letter = $nif[8];
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';

        return $letter === $letters[$number % 23];
    }

    private function validateCif(string $cif): bool
    {
        // Generic CIF validation for demonstration purposes only.
        // Validates basic structure and control digit logic. Not all real-world exceptions included.

        if (! preg_match('/^[ABCDEFGHJPQRSUVW]\d{7}[0-9A-Z]$/', $cif)) {
            return false;
        }

        $digits = substr($cif, 1, 7);
        $control = $cif[8];

        $sumEven = 0;
        $sumOdd = 0;

        for ($i = 0; $i < 7; $i++) {
            $n = (int) $digits[$i];
            if ($i % 2 === 0) {
                $product = $n * 2;
                $sumOdd += ($product > 9) ? $product - 9 : $product;
            } else {
                $sumEven += $n;
            }
        }

        $total = $sumEven + $sumOdd;
        $controlDigit = (10 - ($total % 10)) % 10;
        $controlLetters = 'JABCDEFGHI';
        $expected = ctype_alpha($control)
            ? $controlLetters[$controlDigit]
            : (string) $controlDigit;

        return $control === $expected;
    }
}
