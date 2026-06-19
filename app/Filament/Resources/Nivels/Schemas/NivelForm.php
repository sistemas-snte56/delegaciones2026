<?php

namespace App\Filament\Resources\Nivels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NivelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la nombre')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        TextInput::make('nombre')
                            ->required()
                            ->extraInputAttributes([
                                'style' => 'text-transform: uppercase; color: #ec660c; font-weight: bold;'
                            ]),
                    ]),
            ]);
    }
}
