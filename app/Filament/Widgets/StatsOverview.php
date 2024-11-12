<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                "Tus publicaciones",
                Post::where("is_published", true)
                    ->where('author_id', auth()->id()) // auth()->id() obtiene el ID del usuario autenticado
                    ->count()
            )
                ->icon('heroicon-o-newspaper')
                ->color('success')

                ->chart(
                    collect(range(0, 4))->map(function ($daysAgo) {
                        $date = now()->subDays($daysAgo)->toDateString();
                        return Post::whereDate('created_at', $date)->count();
                    })->reverse()->toArray()
                ),
            Stat::make("Categorias disponibles", Category::count())
                ->icon('heroicon-o-rectangle-group'),
            Stat::make("Tags", value: Tag::count())
                ->icon('heroicon-o-tag'),

        ];
    }
}
