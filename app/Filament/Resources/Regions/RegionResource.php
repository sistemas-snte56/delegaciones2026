<?php

namespace App\Filament\Resources\Regions;

// use App\Filament\Resources\Regions\Pages\CreateRegion;
// use App\Filament\Resources\Regions\Pages\EditRegion;
use App\Filament\Resources\Regions\Pages\ListRegions;
use App\Filament\Resources\Regions\Schemas\RegionForm;
use App\Filament\Resources\Regions\Tables\RegionsTable;
use App\Models\Region;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'region';

    protected static ?string $modelLabel = 'Región';

    protected static ?string $pluralModelLabel = 'Regiones';   
    
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return RegionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegionsTable::configure($table);
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
            'index' => ListRegions::route('/'),
            // 'create' => CreateRegion::route('/create'),
            // 'edit' => EditRegion::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Estructura Sindical';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-globe-alt';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }    
}
