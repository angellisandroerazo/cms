<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Forms;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;



class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Posts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(190)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('slug')
                    ->readonly()
                    ->hiddenOn('create')
                    ->hint('Este texto solo se puede copiar.')
                    ->columnSpanFull(),
                /*  Forms\Components\RichEditor::make('body')
                     ->required()
                     ->columnSpanFull(), */
                TinyEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->rules(['mimetypes:image/jpeg,image/png,image/webp'])
                    ->optimize('webp')
                    ->hint('Se recomienda usar imagenes de 1280 x 720 píxeles')
                    ->columnSpanFull(),
                Forms\Components\Hidden::make('author_id')
                    ->default(auth()->user()->id),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('tag_id')
                    ->relationship('tag', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(190),
                    ]),
                Section::make('Publicar')
                    ->description('Si está marcado, el post estará disponible para los usuarios (OJO: La fecha reflejada en el post es la fecha de creación)')
                    ->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->default(false),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function () {
                if (auth()->user()->hasRole('super_admin')) {
                    return Post::query();
                } else {
                    return Post::query()->where('author_id', auth()->id());
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(15)
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->limit(15)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('author_id')
                    ->relationship('user', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                DateRangeFilter::make('created_at'),
                DateRangeFilter::make('updated_at'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Ver')
                        ->label('Ir a la publicación')
                        ->url(fn(Post $post) => url("/post/{$post->slug}"))
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-link'),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()->color('primary'),
                ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
