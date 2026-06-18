<?php

namespace App\Filament\Resources\Nomenclaturas;

use App\Filament\Resources\Nomenclaturas\Pages\CreateNomenclatura;
use App\Filament\Resources\Nomenclaturas\Pages\EditNomenclatura;
use App\Filament\Resources\Nomenclaturas\Pages\ListNomenclaturas;
use App\Filament\Resources\Nomenclaturas\Schemas\NomenclaturaForm;
use App\Filament\Resources\Nomenclaturas\Tables\NomenclaturasTable;
use App\Models\Nomenclatura;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NomenclaturaResource extends Resource
{
    protected static ?string $model = Nomenclatura::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nomenclatura';

    public static function form(Schema $schema): Schema
    {
        return NomenclaturaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NomenclaturasTable::configure($table);
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
            'index' => ListNomenclaturas::route('/'),
            // 'create' => CreateNomenclatura::route('/create'),
            // 'edit' => EditNomenclatura::route('/{record}/edit'),
        ];
    }
}
