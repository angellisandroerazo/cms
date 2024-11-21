<?php

namespace App\Filament\Resources\ExtraPageResource\Pages;

use App\Filament\Resources\ExtraPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExtraPages extends ListRecords
{
    protected static string $resource = ExtraPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
