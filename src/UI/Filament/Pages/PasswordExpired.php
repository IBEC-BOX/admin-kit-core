<?php

namespace AdminKit\Core\UI\Filament\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class PasswordExpired extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $slug = 'password-expired';

    protected static ?string $title = 'Обновление пароля';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = null;

    protected static string $view = 'admin-kit::filament.pages.password-expired';

    public function mount()
    {
        if (! auth()->check()) {
            redirect()->route('filament.admin-kit.auth.login');
        }

        if (! config('admin-kit.user.password.expiry.enabled')) {
            return redirect()->route('filament.admin-kit.pages.dashboard');
        }

        $user = auth()->user();

        $this->data['email'] = $user->email;

        if (is_null($user?->password_expires_at)) {
            return redirect()->route('filament.admin-kit.pages.dashboard');
        }

        if (! now()->greaterThanOrEqualTo($user->password_expires_at)) {
            return redirect()->route('filament.admin-kit.pages.dashboard');
        }

        if (! now()->greaterThanOrEqualTo($user->password_expires_at)) {
            return redirect()->route('filament.admin-kit.pages.dashboard');
        }
    }

    public function submit()
    {
        $this->validate();

        $user = auth()->user();

        // Обновляем пароль и метку времени
        $user->password = Hash::make($this->data['password']);

        if (config('admin-kit.user.password.history.enabled')) {
            $count = config('admin-kit.user.password.history.count');
            $passwordHistory = $user->password_history ?? [];
            $passwordHistory[] = $user->password;
            $user->password_history = array_slice($passwordHistory, -$count);
        }

        if (config('admin-kit.user.password.expiry.enabled')) {
            $expiryDays = config('admin-kit.user.password.expiry.days');
            $user->password_expires_at = Carbon::now()->addDays($expiryDays);
        }

        // будет сброс сессии после смены пароля
        $user->save();

        return redirect()->route('filament.admin-kit.pages.dashboard');
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Forms\Components\Hidden::make('email'),

                Forms\Components\TextInput::make('current_password')
                    ->label('Текущий пароль')
                    ->password()
                    ->required()
                    ->rules(['current_password'])
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('password')
                    ->label('Новый пароль')
                    ->password()
                    ->required()
                    ->rules(config('admin-kit.user.password.validation.rules', []))
                    ->validationMessages(config('admin-kit.user.password.validation.messages', []))
                    ->confirmed('password_confirmation')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('password_confirmation')
                    ->label('Подтвердите новый пароль')
                    ->password()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    /**
     * @return Action[]
     */
    public function getFormActions(): array
    {
        return [
            Action::make('submit')
                ->label('Обновить пароль')
                ->submit('submit'),
        ];
    }
}
