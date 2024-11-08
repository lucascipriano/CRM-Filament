<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrabalhosResource\Pages;
use App\Filament\Resources\TrabalhosResource\RelationManagers;
use App\Models\Trabalhos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrabalhosResource extends Resource
{
    protected static ?string $model = Trabalhos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Serviços';

    public static function query(): Builder
    {
        return parent::query()->where('user_id', auth()->id());
    }
    public static function getNavigationBadge(): ?string{
        return static::getModel()::where('concluido', false)->count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')->default(fn () => auth()->id()),
                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'name') // Campo que será exibido e relacionado
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name) // Exibe o campo 'name' do cliente
                    ->required()
                    ->label('Cliente'),

                Forms\Components\TextInput::make('tipo_de_trabalho')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('data_realizacao')
                    ->required()
                    ->native(false)
                    ->locale('pt_BR'),
                Forms\Components\TextInput::make('valor')
                    ->numeric()
                    ->prefix('R$')
                    ->default(null),
                Forms\Components\Toggle::make('concluido'),

                Forms\Components\RichEditor::make('descricao')
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente.name')
                    ->sortable()
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('tipo_de_trabalho')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_realizacao')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('concluido')
                    ->boolean(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTrabalhos::route('/'),
            'create' => Pages\CreateTrabalhos::route('/create'),
            'edit' => Pages\EditTrabalhos::route('/{record}/edit'),
        ];
    }
}
