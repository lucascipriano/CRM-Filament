<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MensalidadeResource\Pages;
use App\Models\Mensalidade;
use App\Models\Filiado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class MensalidadeResource extends Resource
{
    protected static ?string $model = Mensalidade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Interno';

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
                // Campo para selecionar o filiado
                Forms\Components\Select::make('filiado_id')
                    ->label('Filiado')
                    ->options(Filiado::all()->pluck('name', 'id'))
                    ->required(),

                // Campo para o valor da mensalidade
                Forms\Components\TextInput::make('valor')
                    ->label('Valor')
                    ->numeric()
                    ->required(),

                // Campo para data de referência
                Forms\Components\DatePicker::make('data_referencia')
                    ->label('Data de Referência')
                    ->required()
                    ->default(now()),

                // Campo para indicar se foi pago ou não
                Forms\Components\Toggle::make('pago')
                    ->label('Pago')
                    ->default(false),

                // Campos de timestamps (opcional)
                Forms\Components\Hidden::make('created_at')->default(now()),
                Forms\Components\Hidden::make('updated_at')->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Coluna de nome do filiado
                Tables\Columns\TextColumn::make('filiado.name')
                    ->label('Filiado')
                    ->searchable(),
                // Coluna de valor
                Tables\Columns\TextColumn::make('valor')
                    ->label('Valor')
                    ->sortable(),

                // Coluna de data de referência
                Tables\Columns\TextColumn::make('data_referencia')
                    ->label('Data de Referência')
                    ->sortable()
                    ->date(),

                // Coluna de status de pagamento
                Tables\Columns\IconColumn::make('pago')
                    ->boolean()
                    ->label('Pago')
                    ->sortable(),

                // Colunas de timestamps
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                // Filtros, caso necessário (por exemplo, status de pagamento)
                Tables\Filters\SelectFilter::make('pago')
                    ->options([
                        true => 'Pago',
                        false => 'Não Pago',
                    ])
                    ->label('Status de Pagamento'),
            ])
            ->actions([
                // Ação de editar
                Tables\Actions\EditAction::make(),
                // Ação de deletar
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Ação de deletar em massa
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            // Página de gerenciamento de mensalidades
            'index' => Pages\ManageMensalidades::route('/'),
        ];
    }
}
