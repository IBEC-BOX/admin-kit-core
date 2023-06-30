<?php

namespace AdminKit\Core\UI\Filament\Resources;

use AdminKit\Core\UI\Filament\Resources\UserResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use STS\FilamentImpersonate\Impersonate;

class UserResource extends Resource
{
    public static function getModel(): string
    {
        return config('admin-kit.user.model');
    }

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function getSlug(): string
    {
        return 'users';
    }

    protected static function getNavigationLabel(): string
    {
        return trans('admin-kit::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('admin-kit::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('admin-kit::user.resource.single');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('admin-kit.user.group');
    }

    protected function getTitle(): string
    {
        return trans('admin-kit::user.resource.title.resource');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')->required()->label(trans('admin-kit::user.resource.name')),
            TextInput::make('email')->email()->required()->label(trans('admin-kit::user.resource.email')),
            TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->label(trans('admin-kit::user.resource.password'))
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
        ];

        if (config('admin-kit.user.shield')) {
            $rows[] = Forms\Components\MultiSelect::make('roles')->relationship('roles', 'name')->label(trans('admin-kit::user.resource.roles'));
        }

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                TextColumn::make('id')->sortable()->label(trans('admin-kit::user.resource.id')),
                TextColumn::make('name')->sortable()->searchable()->label(trans('admin-kit::user.resource.name')),
                TextColumn::make('email')->sortable()->searchable()->label(trans('admin-kit::user.resource.email')),
                BooleanColumn::make('email_verified_at')->sortable()->searchable()->label(trans('admin-kit::user.resource.email_verified_at')),
                TextColumn::make('created_at')->label(trans('admin-kit::user.resource.created_at'))
                    ->dateTime('M j, Y')->sortable(),
                TextColumn::make('updated_at')->label(trans('admin-kit::user.resource.updated_at'))
                    ->dateTime('M j, Y')->sortable(),

            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(trans('admin-kit::user.resource.verified'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('admin-kit::user.resource.unverified'))
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ]);

        if (config('admin-kit.user.impersonate')) {
            $table->prependActions([
                Impersonate::make('impersonate'),
            ]);
        }

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
