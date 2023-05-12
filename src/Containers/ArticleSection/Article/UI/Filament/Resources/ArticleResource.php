<?php

namespace AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources;

use AdminKit\Core\Containers\ArticleSection\Article\Models\Article;
use AdminKit\Core\Containers\ArticleSection\Article\UI\Filament\Resources\ArticleResource\Pages;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->lazy()
                        ->afterStateUpdated(
                            function (string $context, $state, callable $set) {
                                if ($context === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->required()
                        ->unique(Article::class, 'slug', ignoreRecord: true),

                    Forms\Components\RichEditor::make('content')->required()->columnSpan(2),
                ])->columns(),

                Forms\Components\Section::make('Properties')
                    ->schema([
                        Forms\Components\RichEditor::make('short_content')->columnSpan(16),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('Published Date'),

                        Forms\Components\Toggle::make('pinned'),
                    ])
                    ->collapsible(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['ru', 'en', 'kk', 'de'];
    }
}
