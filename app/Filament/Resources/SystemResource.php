<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemResource\Pages;
use App\Filament\Resources\SystemResource\RelationManagers;
use App\Models\System;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Schema;
use Log;

class SystemResource extends Resource
{
    protected static ?string $model = System::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Admin Panel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Tabs::make('Tabs')
                        ->tabs([
                            Tabs\Tab::make('Configuración del sistema')
                                ->schema([
                                    Section::make('')
                                        ->description('Define como se llamara tu sistema y que logo utilizarás.')
                                        ->schema([
                                            Forms\Components\TextInput::make('name_site')
                                                ->required()
                                                ->maxLength(190),
                                            Forms\Components\FileUpload::make('logo')
                                                ->hint('Max height 400')
                                                ->maxSize(1024 * 1024 * 2)
                                                ->rules('dimensions:max_height=400')
                                                ->nullable()
                                                ->columnSpanFull(),
                                            Forms\Components\FileUpload::make('favicon')
                                                ->maxSize(50)
                                                ->nullable()
                                                ->columnSpanFull(),
                                        ]),
                                ]),
                            Tabs\Tab::make('Landing Page')
                                ->schema([
                                    Section::make('')
                                        ->description('Ingresa la información que tendras en la página principal.')
                                        ->schema([
                                            Forms\Components\FileUpload::make('landing_image')
                                                ->image()
                                                ->imageEditor()
                                                ->required()
                                                ->maxSize(2048)
                                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                                ->rules(['mimetypes:image/jpeg,image/png,image/webp'])
                                                ->optimize('webp')
                                                ->hint('Se recomienda usar imagenes de 1920 x 1080 píxeles')
                                                ->columnSpanFull(),
                                            Forms\Components\TextInput::make('landing_title')
                                                ->required()
                                                ->maxLength(190),
                                            Forms\Components\Textarea::make('landing_body')
                                                ->required()
                                                ->columnSpanFull(),
                                        ]),
                                ]),
                            Tabs\Tab::make('Acerca de')
                                ->schema([
                                    Section::make('')
                                        ->description('Activalo si quieres tener una página de información y define lo que desas mostrar.')
                                        ->schema([
                                            Forms\Components\Toggle::make('about')
                                                ->reactive(),
                                            Forms\Components\TextInput::make('about_title')
                                                ->maxLength(190)
                                                ->visible(fn(callable $get) => $get('about'))
                                                ->required(fn(callable $get) => $get('about')),
                                            TinyEditor::make('about_body')
                                                ->visible(fn(callable $get) => $get('about'))
                                                ->required(fn(callable $get) => $get('about'))
                                                ->columnSpanFull(),
                                        ]),
                                ]),
                            Tabs\Tab::make('Contacto')
                                ->schema([
                                    Section::make('')
                                        ->description('Activalo si quieres tener una página de contacto y define lo que desas mostrar como las redes sociales.')
                                        ->schema([
                                            Forms\Components\Toggle::make('contact')
                                                ->reactive(),
                                            Forms\Components\TextInput::make('contact_title')
                                                ->maxLength(190)
                                                ->visible(fn(callable $get) => $get('contact'))
                                                ->required(fn(callable $get) => $get('contact')),
                                            Forms\Components\Textarea::make('contact_body')
                                                ->visible(fn(callable $get) => $get('contact'))
                                                ->required(fn(callable $get) => $get('contact'))
                                                ->columnSpanFull(),
                                            //linkedin
                                            Forms\Components\Toggle::make('linkedin')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('linkedin_link')
                                                ->maxLength(190)
                                                ->url()
                                                ->visible(fn(callable $get) => $get('linkedin'))
                                                ->required(fn(callable $get) => $get('linkedin')),
                                            //facebook
                                            Forms\Components\Toggle::make('facebook')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('facebook_link')
                                                ->maxLength(190)
                                                ->url()
                                                ->visible(fn(callable $get) => $get('facebook'))
                                                ->required(fn(callable $get) => $get('facebook')),
                                            //x
                                            Forms\Components\Toggle::make('x')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('x_link')
                                                ->maxLength(190)
                                                ->url()
                                                ->visible(fn(callable $get) => $get('x'))
                                                ->required(fn(callable $get) => $get('x')),
                                            //youtube
                                            Forms\Components\Toggle::make('youtube')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('youtube_link')
                                                ->maxLength(190)
                                                ->url()
                                                ->visible(fn(callable $get) => $get('youtube'))
                                                ->required(fn(callable $get) => $get('youtube')),
                                            //instagram
                                            Forms\Components\Toggle::make('instagram')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('instagram_link')
                                                ->maxLength(190)
                                                ->url()
                                                ->visible(fn(callable $get) => $get('instagram'))
                                                ->required(fn(callable $get) => $get('instagram')),
                                            //email
                                            Forms\Components\Toggle::make('has_email')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('e_mail')
                                                ->maxLength(190)
                                                ->email()
                                                ->visible(fn(callable $get) => $get('has_email'))
                                                ->required(fn(callable $get) => $get('has_email')),
                                            //phone
                                            Forms\Components\Toggle::make('has_phone')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('phone')
                                                ->tel()
                                                ->maxLength(190)
                                                ->visible(fn(callable $get) => $get('has_phone'))
                                                ->required(fn(callable $get) => $get('has_phone')),
                                            //direction
                                            Forms\Components\Toggle::make('has_direction')
                                                ->reactive()
                                                ->visible(fn(callable $get) => $get('contact')),
                                            Forms\Components\TextInput::make('direction')
                                                ->maxLength(190)
                                                ->visible(fn(callable $get) => $get('has_direction'))
                                                ->required(fn(callable $get) => $get('has_direction')),
                                        ]),
                                ]),
                        ])
                        ->columnSpanFull(),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_site')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo'),
                Tables\Columns\ImageColumn::make('landing_image'),
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
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
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
        if (Schema::hasTable('system')) {
            $info_site = System::first();

            if ($info_site) {
                return [
                    'index' => Pages\ListSystems::route('/'),
                    'edit' => Pages\EditSystem::route('/{record}/edit'),
                ];
            }
        } else {
            Log::warning('La tabla "system" no existe. Ejecute las migraciones.');
        }

        return [
            'index' => Pages\ListSystems::route('/'),
            'create' => Pages\CreateSystem::route('/create'),
            'edit' => Pages\EditSystem::route('/{record}/edit'),
        ];
    }
}
