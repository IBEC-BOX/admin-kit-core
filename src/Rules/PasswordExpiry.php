<?php

namespace AdminKit\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class PasswordExpiry implements DataAwareRule, ValidationRule
{
    private ?string $email = null;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // email is required for this rule
        $validator = Validator::make([
            'email' => $this->email,
        ], [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $fail($validator->messages()->first());
        }

        // find user is required
        $model = config('admin-kit.user.model');
        $user = $model::where('email', $this->email)->first();

        if (! $user) {
            return;
        }

        $days = config('admin-kit.user.password.expiry.days');

        if (now() > $user->password_expires_at->addDays($days)) {
            $fail('Срок действия пароля истек, обновите пароль');
        }
    }

    public function setData(array $data): void
    {
        $this->email = $data['email'] ?? $data['data']['email'] ?? null;
    }
}
