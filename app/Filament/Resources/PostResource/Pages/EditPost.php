<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make('Ver')
                ->label('Ir a la publicación')
                ->url(fn(Post $post) => url("/post/{$post->slug}"))
                ->openUrlInNewTab()
                ->icon('heroicon-o-link')
                ->color('primary'),
            Actions\DeleteAction::make(),
        ];
    }
}
