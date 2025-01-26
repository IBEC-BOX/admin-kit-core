<?php

namespace AdminKit\Core\Rules;

use Closure;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordHistory implements ValidationRule, DataAwareRule
{
    private ?string $email = null;

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
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
        $user  = $model::where('email', $this->email)->first();

        if (!$user) {
            return;
        }

        $passwordHistory = $user->password_history ?? [];
        foreach ($passwordHistory as $passwordHash) {
            if (Hash::check($value, $passwordHash)) {
                $fail('Пароль уже был использован ранее');
            }
        }
    }

    public function setData(array $data): void
    {
        $this->email = $data['email'] ?? $data['data']['email'] ?? null;
    }
}
