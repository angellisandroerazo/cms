<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtraPageResource\Pages;
use App\Filament\Resources\ExtraPageResource\RelationManagers;
use App\Models\ExtraPage;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class ExtraPageResource extends Resource
{
    protected static ?string $model = ExtraPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Admin Panel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(190),
                Forms\Components\TextInput::make('slug')
                    ->readonly()
                    ->hiddenOn('create')
                    ->hint('Solo puedes copiar este texto'),
                TinyEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                Section::make('Mostrar')
                    ->description('Si está marcado, la pagina estará disponible para los usuarios.')
                    ->schema([
                        Forms\Components\Toggle::make('show')
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->default(false),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('show')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('show'),
                DateRangeFilter::make('created_at'),
                DateRangeFilter::make('updated_at'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Ver')
                        ->label('Ir a la pagina')
                        ->url(fn(ExtraPage $page) => url("/{$page->slug}"))
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-link'),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()->color('primary'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListExtraPages::route('/'),
            'create' => Pages\CreateExtraPage::route('/create'),
            'edit' => Pages\EditExtraPage::route('/{record}/edit'),
        ];
    }
}
