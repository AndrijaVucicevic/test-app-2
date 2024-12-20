<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CustomerEmailRule implements ValidationRule
{
    private bool $isUpdate;

    public function __construct(
        private bool $update = false
    ) {
        $this->isUpdate = $update;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = User::where(DB::raw('LOWER(email)'), '=', strtolower($value));

        if ($this->isUpdate) {
            $query->where('id', '<>', request()->route('user')->id);
        }
        $user = $query
            ->first();

            if ($user) {
            $fail(__('messages.validation_customer_user_exists'));
        }
    }
}
