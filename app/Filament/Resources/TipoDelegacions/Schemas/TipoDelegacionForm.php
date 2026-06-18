<?php

namespace App\Filament\Resources\TipoDelegacions\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TipoDelegacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Tipo de Delegación')
                    ->icon('heroicon-o-map-pin')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        TextInput::make('tipo')
                            ->label('Tipo de Delegación')
                            ->placeholder('Ingrese el tipo de delegación')
                            ->required(),
                    ]),
            ]);
    }
}
