<?php

namespace App\Filament\Resources\Maestros\Schemas;

use App\Models\Delegacion;
use App\Models\Secretaria;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaestroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cargo Sindical')
                    ->description('Delegación y cartera asignada')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Select::make('delegacion_id')
                            ->label('Delegación')
                            ->relationship(
                                name: 'delegacion',
                                titleAttribute: 'sede_delegacional',
                                modifyQueryUsing: fn ($query) => $query->with(['nomenclatura'])
                            )
                            ->getOptionLabelFromRecordUsing(fn (Delegacion $record) => $record->nombre_completo)
                            ->searchable(['clave_delegacion', 'sede_delegacional'])
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (callable $set) => $set('secretaria_id', null)),

                        Select::make('secretaria_id')
                            ->label('Cartera')
                            ->options(function (callable $get) {
                                $delegacionId = $get('delegacion_id');
                                if (! $delegacionId) return [];

                                $delegacion = Delegacion::find($delegacionId);
                                if (! $delegacion) return [];

                                return Secretaria::where('tipo_delegacion_id', $delegacion->tipo_delegacion_id)
                                    ->pluck('cartera_secretaria', 'id');
                            })
                            ->required()
                            ->live(),

                        Select::make('user_id')
                            ->label('Usuario del Sistema')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Datos Personales')
                    ->description('Información del maestro/dirigente')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Select::make('titulo')
                            ->label('Título')
                            ->options([
                                'PROF.'  => 'PROF.',
                                'PROFR.' => 'PROFA.',
                                'C.'     => 'C.',
                            ])
                            ->placeholder('Selecciona...'),

                        Select::make('genero')
                            ->label('Género')
                            ->options([
                                'MASCULINO' => 'MASCULINO',
                                'FEMENINO'  => 'FEMENINO',
                                'OTRO'      => 'OTRO',
                            ])
                            ->default('MASCULINO')
                            ->required(),

                        TextInput::make('nombre')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(150),

                        TextInput::make('apaterno')
                            ->label('Apellido Paterno')
                            ->required()
                            ->maxLength(150),

                        TextInput::make('amaterno')
                            ->label('Apellido Materno')
                            ->maxLength(150),

                    ])->columns(2),

                Section::make('Contacto y Domicilio')
                    ->description('Datos opcionales de contacto')
                    ->icon('heroicon-o-map-pin')
                    ->collapsed()
                    ->schema([
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->maxLength(150),

                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('direccion')
                            ->label('Domicilio')
                            ->maxLength(250)
                            ->columnSpanFull(),

                        TextInput::make('cp')
                            ->label('Código Postal')
                            ->maxLength(10),

                        TextInput::make('ciudad')
                            ->label('Ciudad')
                            ->maxLength(150),

                        TextInput::make('estado')
                            ->label('Estado')
                            ->default('VERACRUZ')
                            ->maxLength(150),
                    ])->columns(2),
            ]);
    }
}