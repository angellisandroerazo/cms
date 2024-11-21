<?php

namespace App\Filament\Resources\SystemResource\Pages;

use App\Filament\Resources\SystemResource;
use App\Models\System;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Log;
use Schema;

class ListSystems extends ListRecords
{
    protected static string $resource = SystemResource::class;

    protected function getHeaderActions(): array
    {

        if (Schema::hasTable('system')) {
            $info_site = System::first();

            if ($info_site) {
                return [
                ];
            }
        } else {
            Log::warning('La tabla "system" no existe. Ejecute las migraciones.');
        }

        return [
            Actions\CreateAction::make()
        ];
    }
}
