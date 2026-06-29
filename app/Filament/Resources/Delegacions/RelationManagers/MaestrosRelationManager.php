<?php

namespace App\Filament\Resources\Delegacions\RelationManagers;

use App\Filament\Resources\Maestros\MaestroResource;
use App\Filament\Resources\Maestros\Schemas\MaestroForm; // Reemplaza por el nombre exacto de tu archivo en Schemas
use App\Filament\Resources\Maestros\Schemas\MaestroInfolist;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


use Illuminate\Database\Eloquent\Model;





class MaestrosRelationManager extends RelationManager
{
    protected static string $relationship = 'maestros';

    protected static ?string $relatedResource = MaestroResource::class;

    protected static ?string $title = 'Maestros / Dirigentes';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre_completo')
            ->columns([
                TextColumn::make('secretaria.cartera_secretaria')
                    ->label('CARTERA')
                    ->weight('medium')
                    ->size('sm')
                    ->color('gray')
                    ->searchable()
                    ->wrap(), // Por si el nombre de la secretaría es muy largo

                // --- NOMBRE COMPLETO (El protagonista de la fila) ---
                TextColumn::make('nombre_completo')
                    ->label('NOMBRE COMPLETO')
                    ->weight('medium')
                    ->size('sm')
                    ->color('gray')
                    ->searchable(),

                // --- CORREO (Interactivo) ---
                TextColumn::make('email')
                    ->label('CORREO ELECTRÓNICO')
                    ->icon('heroicon-m-envelope')
                    ->weight('medium')
                    ->size('sm')
                    ->color('gray')
                    ->copyable() // Permite copiar al portapapeles con un clic
                    ->copyMessage('Correo copiado')
                    ->searchable(),

                // --- TELÉFONO (Con formato e ícono) ---
                TextColumn::make('telefono')
                    ->label('TELÉFONO')
                    ->icon('heroicon-m-phone')
                    ->iconColor('success')
                    ->copyable()
                    ->weight('medium')
                    ->size('sm')
                    ->color('gray'),                    
                    //->fontFamily('mono'), // Look numérico limpio

            ])

            ->headerActions([
                // NUEVO MAESTRO (MODAL)
                Action::make('crearMaestro')
                    ->label('Nuevo Maestro')
                    ->icon('heroicon-o-plus')
                    ->form(fn ($form) => MaestroForm::configure($form))
                    ->fillForm(fn (): array => [
                        'delegacion_id' => $this->getOwnerRecord()->getKey(),
                    ])
                    ->action(function (array $data): void {
                        // Eloquent guarda e inyecta el ID de la delegación automáticamente
                        $this->getOwnerRecord()->maestros()->create($data);
                    })
                    ->successNotificationTitle('Maestro creado correctamente'),
            ])

            ->recordActions([
                // MOSTRAR MAESTRO
                Action::make('verMaestro')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->fillForm(fn (Model $record): array => $record->toArray())
                    ->form(fn ($form) => MaestroForm::configure($form))
                    ->disabledForm(),                

                // EDITAR MAESTRO
                Action::make('editarMaestro')
                    ->label('Editar')
                    ->icon('heroicon-o-pencil')
                    ->color('warning')
                    ->fillForm(fn (Model $record): array => $record->toArray())
                    // Usamos el mismo MaestroForm aquí también
                    ->form(fn ($form) => MaestroForm::configure($form))
                    ->action(function (Model $record, array $data): void {
                        $record->update($data);
                    })
                    ->successNotificationTitle('Maestro actualizado'),
            ])



            ->defaultSort('secretaria_id', 'asc');
    }

    // --- AGREGA ESTE MÉTODO FUERA DE TABLE() ---
    // Esto le dice a Filament que este manager nunca sea de solo lectura
    public function isReadOnly(): bool
    {
        return false;
    }
}