<?php

namespace App\Filament\Clusters\Products\Resources\ProductResource\Widgets;

use App\Filament\Clusters\Products\Resources\ProductResource\Pages\ListProducts;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListProducts::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', $this->getPageTableQuery()->count()),
            Stat::make('Product Inventory', $this->getPageTableQuery()->sum('qty')),
            Stat::make('Average small size price', number_format($this->getPageTableQuery()->avg('small_price'), 2)),
            Stat::make('Average medium size price', number_format($this->getPageTableQuery()->avg('medium_price'), 2)),
            Stat::make('Average large size price', number_format($this->getPageTableQuery()->avg('large_price'), 2)),
        ];
    }
}
