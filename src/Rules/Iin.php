<?php

namespace AdminKit\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Заимствовано отсюда
 * https://github.com/talgat065/php-iin-validator/blob/master/src/IinValidator.php
 */
class Iin implements ValidationRule
{
    private const FIRST_SEQ = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

    private const SECOND_SEQ = [3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 2];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[0-9]{12}$/', $value)) {
            $fail('admin-kit::validation.iin.count')->translate(['attribute' => $attribute]);

            return;
        }

        $calculatedCheckSum = $this->calculateCheckSum($value);
        $realCheckSum = (int) substr($value, -1);

        if ($calculatedCheckSum !== $realCheckSum) {
            $fail('admin-kit::validation.iin.checksum')->translate(['attribute' => $attribute]);
        }
    }

    private function calculateCheckSum(string $iin): int
    {
        $nums = str_split($iin);

        $sum = 0;
        foreach (self::FIRST_SEQ as $i => $j) {
            $sum += (int)$nums[$i] * $j;
        }

        if ($sum % 11 === 10) {
            $sum = 0;

            foreach (self::SECOND_SEQ as $i => $j) {
                $sum += (int)$nums[$i] * $j;
            }

        }

        return $sum % 11;
    }
}
