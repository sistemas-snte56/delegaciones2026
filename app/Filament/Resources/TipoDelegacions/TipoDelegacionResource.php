<?php

namespace App\Filament\Resources\TipoDelegacions;

use App\Filament\Resources\TipoDelegacions\Pages\CreateTipoDelegacion;
use App\Filament\Resources\TipoDelegacions\Pages\EditTipoDelegacion;
use App\Filament\Resources\TipoDelegacions\Pages\ListTipoDelegacions;
use App\Filament\Resources\TipoDelegacions\Schemas\TipoDelegacionForm;
use App\Filament\Resources\TipoDelegacions\Tables\TipoDelegacionsTable;
use App\Models\TipoDelegacion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TipoDelegacionResource extends Resource
{
    protected static ?string $model = TipoDelegacion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'tipo';

    public static function form(Schema $schema): Schema
    {
        return TipoDelegacionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipoDelegacionsTable::configure($table);
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
            'index' => ListTipoDelegacions::route('/'),
            // 'create' => CreateTipoDelegacion::route('/create'),
            // 'edit' => EditTipoDelegacion::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Catálogos';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-adjustments-horizontal';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }    
}
