<?php

namespace App\Rules;

use App\Models\DynamicConfig;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImportTypeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $array = explode('_', $value);

        $config = DynamicConfig::where("key", $array[0])->firstOrFail();
        $value = json_decode($config->value, true)['files'];

        if (!in_array($array[1], array_keys($value))) {
            $fail('Error');
        }
    }
}
