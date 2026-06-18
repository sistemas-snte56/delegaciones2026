<?php

namespace App\Filament\Resources\Secretarias\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SecretariaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Secretaría')
                    ->icon('heroicon-o-map-pin')
                    ->columnSpanFull() // 1. Fuerza a la sección a estirarse horizontalmente al 100%
                    ->columns(1)       // 2. Establece que dentro de la sección el flujo sea de una columna completa                
                    ->schema([  
                        TextInput::make('cartera_secretaria')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(), // 3. Estira el input de región                            
                        Select::make('tipo_delegacion_id')
                            ->relationship('tipoDelegacion', 'tipo')
                            ->required()
                            ->columnSpanFull(), // 3. Estira el input de región                            
                    ]),
            ]);
    }
}
