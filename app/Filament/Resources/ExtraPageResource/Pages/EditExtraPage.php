<?php

namespace App\Filament\Resources\ExtraPageResource\Pages;

use App\Filament\Resources\ExtraPageResource;
use App\Models\ExtraPage;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExtraPage extends EditRecord
{
    protected static string $resource = ExtraPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make('Ver')
            ->label('Ir a la página')
            ->url(fn(ExtraPage $page) => url("/{$page->slug}"))
            ->openUrlInNewTab()
            ->icon('heroicon-o-link')
            ->color('primary'),
            Actions\DeleteAction::make(),
        ];
    }
}
