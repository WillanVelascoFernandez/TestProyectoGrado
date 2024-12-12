<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicionResource\Pages;
use App\Filament\Resources\MedicionResource\RelationManagers;
use App\Models\Medicion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicionResource extends Resource
{
    protected static ?string $model = Medicion::class;
    protected static ?string $navigationLabel = "Mediciones";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sensor_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tipo_medicion_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sensor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo_medicion_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
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
            'index' => Pages\ListMedicions::route('/'),
            'create' => Pages\CreateMedicion::route('/create'),
            'edit' => Pages\EditMedicion::route('/{record}/edit'),
        ];
    }
}
