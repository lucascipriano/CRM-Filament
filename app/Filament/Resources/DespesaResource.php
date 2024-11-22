<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DespesaResource\Pages;
use App\Filament\Resources\DespesaResource\RelationManagers;
use App\Models\Despesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DespesaResource extends Resource
{
    protected static ?string $model = Despesa::class;
    protected static ?string $navigationGroup = 'Interno';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id',auth()->id());
    }
    public static function query(): Builder
    {
        return parent::query()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')->default(fn () => auth()->id()),
                Forms\Components\TextInput::make('descricao')
                    ->maxLength(255)
                    ->label("Descrição")
                    ->required()
                    ->default(null),
                Forms\Components\TextInput::make('valor')
                    ->label('Valor')
                    ->numeric()
                    ->prefix('R$ ')
                    ->required(),
                Forms\Components\DatePicker::make('data_despesa')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descricao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->label('Valor')
                    ->prefix('R$ ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_despesa')
                    ->date()
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDespesas::route('/'),
        ];
    }
}
