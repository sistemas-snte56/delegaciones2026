<?php

namespace App\Filament\Resources\Delegacions;

use App\Filament\Resources\Delegacions\Pages\CreateDelegacion;
use App\Filament\Resources\Delegacions\Pages\EditDelegacion;
use App\Filament\Resources\Delegacions\Pages\ListDelegacions;
use App\Filament\Resources\Delegacions\Pages\ViewDelegacion;
use App\Filament\Resources\Delegacions\Schemas\DelegacionForm;
use App\Filament\Resources\Delegacions\Schemas\DelegacionInfolist;
use App\Filament\Resources\Delegacions\Tables\DelegacionsTable;
use App\Models\Delegacion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use App\Filament\Resources\Delegacions\RelationManagers\MaestrosRelationManager; // <-- No olvides el import arriba

class DelegacionResource extends Resource
{
    protected static ?string $model = Delegacion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'clave_delegacion';

    protected static ?string $modelLabel = 'Delegación';

    protected static ?string $pluralModelLabel = 'Delegaciones';

    // protected static ?string $navigationGroup = 'Gestión Sindical';

    protected static ?int $navigationSort = 1;


    public static function form(Schema $schema): Schema
    {
        return DelegacionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DelegacionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DelegacionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MaestrosRelationManager::class, // <-- Agrega esta línea
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDelegacions::route('/'),
            'create' => CreateDelegacion::route('/create'),
            'view' => ViewDelegacion::route('/{record}'),
            'edit' => EditDelegacion::route('/{record}/edit'),
        ];
    }
}
