# CRM laravel + filament

Tem os **usuários** comuns do laravel, **clientes** e **trabalhos**. Cada cliente pode ser asociado a mais de um trabalho.

Widgets na página principal.

Próximos passos:

# 1. Migration adicionando relação do Usuário com trabalho e cliente
- Fazer com que cada usuário tenha seus próprios
    - Clientes ✅
    - Trabalhos ✅
    - ~~Filhos de santo~~
> Filho de santo fazer por último? Já que é a terceira taks

# 2. Criar parte de consulta (Serviços) ✅
- Utilizar vídeo que o Rodrigo mandou para
    - Modelar o banco de dados com migrations e models
    - Fazer conexão para buscar os clientes e fazer com que um cliente seja dono de uma consulta
    - Atualizar o form

## O que ele anota ✅
- Nome
- Data de nascimento
- Local para descrever odu/orixa/exu
- Orientações
- Data de retorno
- Valor da consulta 


## 2.1 Pensamentos ✅
    - Como irei marcar início da consulta e data de retorno? 
    - Como Separar as consultas já realizadas? Check de finalizado?


# 3. Criar parte interna do terreiro ✅
- Cadastro de membros (filhos de santo)
    - nome
    - idade (data de nascimento)
    - email
    - telefone
    - detalhes falando sobre

Problemas: 
    - Terá parte de filados também? ✅
    - Fazer um form com boolean se é medium? Se for false ele é um afiliado só  ✅

## Como ajustar para por contribuição? ✅
    - Recupero filiado_id, 
    - Data da contribuição - horário
    - Input com metodo da contribuição
    - Campo descrição
        

# 3.2 Filiados
    - Alterar nome mensalidade para algo que tenha mais haver com "entrada"?
    - Alterar boolean pago para mensalidade? Separando
    - Criar uma área de saída? Anotações dos valores e criar um widget de saída e total que tem em caixa.

# 4. Estrutura de equipes
- Cada usuário pode pertencer a uma equipe e as equipes possam ter múltiplos usuários.
[link](https://chatgpt.com/c/672e406b-e854-8013-82d4-bef871f2c6a9)
![img.png](img.png)

# 5. Dashboard nova
 - Criar do zero a dashboard
 - [link](https://chatgpt.com/c/67314de1-d7f8-8013-bce2-6426c89b705e)
