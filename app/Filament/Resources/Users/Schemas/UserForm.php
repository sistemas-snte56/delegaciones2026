<?php

namespace App\Filament\Resources\Users\Schemas;

// use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
// use Filament\Actions\Action;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('INFORMACIÓN DEL USUARIO')
                    ->description('Datos generales de la cuenta de acceso.')
                    ->icon(Heroicon::UserCircle)
                    ->collapsible()
                    // ->collapsed()
                    // ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre Completo')
                            ->afterStateUpdated(fn ($state) => mb_strtoupper($state, 'UTF-8'))
                            ->required(),

                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),    
                            
                        // DateTimePicker::make('email_verified_at'),
                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()                            
                            ->dehydrated(fn ($state) => filled($state)) // Solo envía si tiene datos
                            ->required(fn (string $context): bool => $context === 'create') // Obligatorio solo al crear
                            ->maxLength(255)
                            ->rule('min:8')
                            ->same('password_confirmation'),

                        TextInput::make('password_confirmation')
                            ->label('Confirmar Contraseña')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255)
                            ->dehydrated(false), // No se guarda en la BD

                        Select::make('roles')
                            ->label('Rol asignado')
                            ->relationship('roles', 'name') // Enlace directo con Spatie Laravel Permission
                            // ->multiple() // Permite asignar múltiples si fuera necesario, o quítalo para single role
                            ->preload()
                            ->required()
                            // ->colors([
                            //     'danger' => 'super_admin',
                            //     'warning' => 'coordinador',
                            //     'success' => 'gestor',
                            // ])
                            ,                            
                    ])
                    ,


            ])->columns(1);
    }
}
