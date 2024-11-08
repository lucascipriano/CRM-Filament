<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultaResource\Pages;
use App\Filament\Resources\ConsultaResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Consulta;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Serviços';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id',auth()->id());
    }
    public static function query(): Builder
    {
        return parent::query()->where('user_id', auth()->id());
    }
//    public static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::where('user_id', auth()->id())->count();
//    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')->default(fn() => auth()->id()),

                Forms\Components\Grid::make(2) // Define uma grade com 2 colunas
                ->schema([
                    Forms\Components\Select::make('cliente_id')
                        ->label('Cliente')
                        ->relationship('cliente', 'name')
                        ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                        ->options(Cliente::all()->pluck('name', 'id'))
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            if ($state) {
                                // Carrega os dados do cliente selecionado
                                $cliente = Cliente::find($state);

                                // Verifica se o cliente foi encontrado e se a data de nascimento está presente
                                if ($cliente && $cliente->birth_date) {
                                    // Preenche o campo de data de nascimento
                                    $set('birth_date', $cliente->birth_date);

                                    // Formata a data como d/m/Y e armazena para exibição
                                    $set('cliente_birth_date', \Carbon\Carbon::parse($cliente->birth_date)->format('d/m/Y'));
                                }
                            }
                        })->columnSpan(1), // Ocupa uma coluna da grade

// Exibição do campo de data de nascimento (como Text)
                    Forms\Components\TextInput::make('cliente_birth_date')
                        ->label('Data de Nascimento')
                        ->reactive() // Faz com que a data de nascimento seja exibida reativamente após o cliente ser selecionado
                        ->default('')  // Defina um valor padrão
                        ->disabled()  // Desabilita o campo, pois é apenas informativo
                        ->columnSpan(1), // Ocupa uma coluna da grade

                ]),

                Forms\Components\Grid::make(1) // Define uma nova linha na grade para campos de texto completos
                ->schema([
                    Forms\Components\RichEditor::make('description')
                        ->label('Descrição')
                        ->nullable()
                        ->default(null)
                        ->columnSpanFull(), // Ocupa a largura total

                    Forms\Components\Textarea::make('guidance')
                        ->label('Orientações')
                        ->rows(5)
                        ->nullable()
                        ->columnSpanFull(), // Ocupa a largura total
                ]),

                Forms\Components\Grid::make(2) // Nova linha com 2 colunas para os próximos campos
                ->schema([
                    Forms\Components\DatePicker::make('return_date')
                        ->label('Data de Retorno')
                        ->nullable()
                        ->minDate(Carbon::tomorrow())
                        ->displayFormat('d/m/Y')
                        ->native(false)
                        ->locale('pt_BR')
                        ->columnSpan(1), // Ocupa uma coluna da grade

                    Forms\Components\TextInput::make('consultation_fee')
                        ->label('Valor da Consulta')
                        ->numeric()
                        ->prefix('R$')
                        ->nullable()
                        ->columnSpan(1), // Ocupa uma coluna da grade
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('user_id')
//                    ->numeric()
//                    ->sortable(),

                // Exibir o nome do cliente em vez de apenas o ID
                Tables\Columns\TextColumn::make('cliente.name')
                    ->label('Cliente')  // Exibe o nome do cliente
                    ->sortable(),

                // Exibe a data de retorno no formato d/m/Y
                Tables\Columns\TextColumn::make('return_date')
                    ->label('Data de Retorno')
                    ->date('d/m/Y')  // Formata a data para d/m/Y
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(fn(Consulta $record) => $record->description)

                    ->html()
                    ->searchable(),

                Tables\Columns\TextColumn::make('guidance')
                    ->label('Orientações')
                    ->sortable()
                    ->tooltip(fn(Consulta $record) => $record->guidance)

                    ->limit(50) // Limita a quantidade de texto exibido
                    ->searchable(), // Torna o campo pesquisável na tabela
                // Exibe a data de criação no formato datetime
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')  // Formato de data e hora
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Exibe a data de atualização no formato datetime
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')  // Formato de data e hora
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Defina os filtros aqui, se necessário
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
            'index' => Pages\ListConsultas::route('/'),
            'create' => Pages\CreateConsulta::route('/create'),
            'edit' => Pages\EditConsulta::route('/{record}/edit'),
        ];
    }
}
