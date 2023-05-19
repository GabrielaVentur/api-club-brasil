# api-club-brasil

Projeto para gestionar os recursos de clubes do brasil

# Base de dados

Foi gerado o script script.sql na pasta script, contém as sentenças sql para criar o banco de dados com nome cbc e as tabelas de clube e recurso, assim como as sentenças para inserir os dados na tabela recurso

# Api
- Na pasta inc tem a configuração de conexão do banco de dados local
- Na pasta serviços tem um conjunto de pastas que representam os serviços disponíveis
- Na pasta clube tem a criação e consulta dos clubes
- No arquivo function tem toda a lógica do negócio

# Test
- Para listar os clubes cadastrados, deve fazer uma petição ao serviço http://localhost/api-club-brasil/servicos/clube/read.php com methodo GET
- Para cadastrar um clube, deve fazer uma petição ao serviço http://localhost/api-club-brasil/servicos/clube/create.php com methodo POST
e enviar o dados no body por exemplo:
{
 "clube": "CLUBE A",
 "saldo_disponivel":"5000,55"
} 
- Para o clube consumir um recurso, deve fazer uma petição ao serviço http://localhost/api-club-brasil/servicos/consumo-recurso/create.php com methodo POST e enviar o dados no body por exemplo:

{
 "clube_id":"1",
 "recurso_id":"1",
 "valor_consumo":"200,00"
} 

