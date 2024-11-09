<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FiliadoResource\Pages;
use App\Filament\Resources\FiliadoResource\RelationManagers;
use App\Models\Filiado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FiliadoResource extends Resource
{
    protected static ?string $model = Filiado::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Interno';

    public static function query(): Builder
    {
        return parent::query()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')->default(fn () => auth()->id()),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Data de Nascimento')
                    ->required()
                    ->nullable()
                    ->displayFormat('d/m/Y')  // Exibe a data no formato d/m/Y
                    ->native(false)
                    ->locale('pt_BR')
                    ->default(now()),    // Formata a data internamente antes de salvar
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefone')
                    ->maxLength(255)
                    ->default(null)
                    ->mask('+99 (99)99999-9999')  // Máscara para entrada
                    ->telRegex('/^(?:\+?(55|351))?(?:[ -]?\(?\d{2,3}\)?[ -]?)?\d{4,5}[ -]?\d{4}$/'),

                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('medium'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Telefone'),
                Tables\Columns\IconColumn::make('medium')
                    ->boolean(),
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
            'index' => Pages\ListFiliados::route('/'),
            'create' => Pages\CreateFiliado::route('/create'),
            'edit' => Pages\EditFiliado::route('/{record}/edit'),
        ];
    }
}
