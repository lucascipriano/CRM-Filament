Para fazer com que cada usuário no Filament visualize apenas seus próprios clientes e trabalhos, você pode usar um sistema de scoping (ou escopos) no Eloquent para filtrar os registros com base no user_id do usuário logado. Veja como fazer isso:
1. Adicione uma Coluna user_id em clientes e trabalhos
   Primeiro, garanta que as tabelas clientes e trabalhos tenham uma coluna user_id que referencie o usuário que criou esses registros.

```php
// Migration para adicionar user_id nas tabelas

// Para clientes
Schema::table('clientes', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
});

// Para trabalhos
Schema::table('trabalhos', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
});
```
2. Configure os Modelos para Relacionamento com o Usuário
   No modelo Cliente e Trabalho, adicione o relacionamento com o modelo User:

```php
// Em Cliente.php
public function user()
{
    return $this->belongsTo(User::class);
}

// Em Trabalho.php
public function user()
{
    return $this->belongsTo(User::class);
}

```

3. Defina um Escopo Global para Filtrar Registros por Usuário
   Para garantir que cada usuário veja apenas seus próprios registros, você pode definir um escopo global no modelo. Adicione o escopo nos modelos Cliente e Trabalho:

```php
// Em Cliente.php e Trabalho.php
protected static function booted()
{
    static::addGlobalScope('user', function (Builder $builder) {
        $builder->where('user_id', auth()->id());
    });
}

```
Esse escopo global limita os registros visíveis ao user_id do usuário logado.

4. Configure os Recursos no Filament para Filtragem Automática
   No recurso do Filament (ClienteResource e TrabalhoResource), use o método query para aplicar o escopo quando necessário:

```php
// Em ClienteResource e TrabalhoResource
public static function query(): Builder
{
    return parent::query()->where('user_id', auth()->id());
}

```

5. Garanta o user_id ao Criar Novos Registros
   Ao criar um novo Cliente ou Trabalho, preencha automaticamente o user_id com o ID do usuário logado:

// Em ClienteResource e TrabalhoResource
public static function form(Form $form): Form
{
return $form
->schema([
Forms\Components\TextInput::make('name')->required(),
// outros campos...
])
->saving(function ($form, $model) {
$model->user_id = auth()->id(); // Define o user_id do usuário logado
});
}

Esses passos permitem que cada usuário veja apenas os registros que eles próprios criaram, proporcionando um sistema de dados segregado dentro do Filament.
