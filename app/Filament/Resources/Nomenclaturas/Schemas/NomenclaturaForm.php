<?php

namespace App\Filament\Resources\Nomenclaturas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NomenclaturaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la nomenclatura')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        TextInput::make('nomenclatura')
                            ->required()
                            ->extraInputAttributes(['style' => 'text-transform: uppercase']),
                        Select::make('tipo_delegacion_id')
                            ->relationship('tipoDelegacion', 'tipo')
                            ->required(),
                    ]),
            ]);
    }
}
