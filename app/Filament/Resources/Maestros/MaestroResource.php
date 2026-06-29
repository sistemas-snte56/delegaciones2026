<?php

namespace App\Filament\Resources\Maestros;

use App\Filament\Resources\Maestros\Pages\CreateMaestro;
use App\Filament\Resources\Maestros\Pages\EditMaestro;
use App\Filament\Resources\Maestros\Pages\ListMaestros;
use App\Filament\Resources\Maestros\Pages\ViewMaestro;
use App\Filament\Resources\Maestros\Schemas\MaestroForm;
use App\Filament\Resources\Maestros\Schemas\MaestroInfolist;
use App\Filament\Resources\Maestros\Tables\MaestrosTable;
use App\Models\Maestro;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MaestroResource extends Resource
{
    protected static ?string $model = Maestro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return MaestroForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MaestroInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaestrosTable::configure($table);
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
            'index' => ListMaestros::route('/'),
            'create' => CreateMaestro::route('/create'),
            'view' => ViewMaestro::route('/{record}'),
            'edit' => EditMaestro::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Docentes';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }    
}
