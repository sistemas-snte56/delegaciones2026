<?php

namespace App\Filament\Resources\Maestros\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaestroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('CARGO SINDICAL')
                    ->description('Delegación y cartera asignada')
                    ->icon('heroicon-o-briefcase')
                    ->columns(3)
                    ->components([
                        TextEntry::make('delegacion.nombre_completo')
                            ->label('DELEGACIÓN')
                            ->weight('bold')
                            ->columnSpan(2),

                        TextEntry::make('secretaria.cartera_secretaria')
                            ->label('CARTERA')
                            ->weight('bold'),

                        TextEntry::make('user.name')
                            ->label('USUARIO DEL SISTEMA')
                            ->placeholder('Sin usuario asignado')
                            ->columnSpan(3),
                    ]),

                Section::make('DATOS PERSONALES')
                    ->description('Información del maestro/dirigente')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('titulo')
                                    ->label('TÍTULO')
                                    ->badge()
                                    ->placeholder('-'),

                                TextEntry::make('genero')
                                    ->label('GÉNERO')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'MASCULINO' => 'info',
                                        'FEMENINO'  => 'pink',
                                        default     => 'gray',
                                    }),

                                TextEntry::make('email')
                                    ->label('CORREO ELECTRÓNICO')
                                    ->placeholder('-'),

                                TextEntry::make('nombre_completo')
                                    ->label('NOMBRE COMPLETO')
                                    ->weight('bold')
                                    ->copyable()
                                    ->columnSpan(2),

                                TextEntry::make('telefono')
                                    ->label('TELÉFONO')
                                    ->placeholder('-'),
                            ]),
                    ]),

                Section::make('DOMICILIO')
                    ->icon('heroicon-o-map-pin')
                    ->columns(4)
                    ->components([
                        TextEntry::make('direccion')
                            ->label('DIRECCIÓN')
                            ->placeholder('-')
                            ->columnSpan(2),

                        TextEntry::make('cp')
                            ->label('CÓDIGO POSTAL')
                            ->placeholder('-'),

                        TextEntry::make('ciudad')
                            ->label('CIUDAD')
                            ->placeholder('-'),

                        TextEntry::make('estado')
                            ->label('ESTADO')
                            ->placeholder('-'),
                    ]),
            ]);
    }
}