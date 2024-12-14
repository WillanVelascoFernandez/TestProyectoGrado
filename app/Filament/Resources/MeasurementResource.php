<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeasurementResource\Pages;
use App\Filament\Resources\MeasurementResource\RelationManagers;
use App\Models\Measurement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeasurementResource extends Resource
{
    protected static ?string $model = Measurement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parameter_id')
                ->label('Parameter')
                ->relationship('parameter', 'name', fn (Builder $query) => 
                $query->selectRaw("parameters.id, CONCAT(parameters.name, ' (', modules.id, '.- ', modules.name, ' -> ', devices.id, '.- ', devices.name, '(',devices.location, '))' ) as name")
                 ->join('modules', 'modules.id', '=', 'parameters.module_id') // Join para acceder al módulo relacionado
                 ->join('devices', 'devices.id', '=', 'modules.device_id') // Join para acceder al dispositivo relacionado
                 ->whereNotNull('parameters.name')) // Asegura que 'name' no sea nulo
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('measured_at')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('parameter')
                    ->label('Parameter')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        // Accede a la relación y formatea como desees
                        if ($state) {
                            // Suponiendo que 'parameter' tiene una relación con 'module' y 'module' con 'device'
                            return "{$state->name}";  // Solo muestra el nombre del parámetro de forma compacta en la columna
                        }
                        return '-'; // Si no hay estado, mostramos un guion
                    })
                    ->tooltip(function ($state) {
                        // Aquí se define lo que se mostrará en el tooltip
                        if ($state) {
                            return "{$state->id}.- {$state->name} ({$state->module->id}.- {$state->module->name} -> {$state->module->device->id}.- {$state->module->device->name} ({$state->module->device->location}))";
                        }
                        return '-';  // Si no hay estado, mostramos un guion en el tooltip
                    }),
                Tables\Columns\TextColumn::make('value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('measured_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListMeasurements::route('/'),
            'create' => Pages\CreateMeasurement::route('/create'),
            'edit' => Pages\EditMeasurement::route('/{record}/edit'),
        ];
    }
}
