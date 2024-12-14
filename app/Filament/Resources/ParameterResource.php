<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParameterResource\Pages;
use App\Filament\Resources\ParameterResource\RelationManagers;
use App\Models\Parameter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParameterResource extends Resource
{
    protected static ?string $model = Parameter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('module_id')
                ->relationship('module', 'name', fn (Builder $query) => 
                $query->selectRaw("modules.id, CONCAT(modules.id, '.- ', modules.name, ' (', devices.id, '.- ', devices.name, ' (', devices.location, '))') as name")
                    ->join('devices', 'devices.id', '=', 'modules.device_id') // Join para acceder a la ubicación del dispositivo
                    ->whereNotNull('modules.name')) // Asegura que 'name' no sea nulo 
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('module')
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
                        return "{$state->id}.- {$state->name} ({$state->device->id}.- {$state->device->name}({$state->device->location}))"; // Muestra id, name y location del dispositivo
                    }
                    return '-';  // Si no hay estado, mostramos un guion en el tooltip
                })
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
                    ->searchable(),
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
            'index' => Pages\ListParameters::route('/'),
            'create' => Pages\CreateParameter::route('/create'),
            'edit' => Pages\EditParameter::route('/{record}/edit'),
        ];
    }
}
