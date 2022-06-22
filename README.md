# T6-BancoDeDados2

Este é o repositório do Trabalho 6 da matéria de Banco de Dados 2,
no curso de Ciências da Computação na Universidade do Vale de Itajaí.

# Introdução

### Escopo

### Formulação do problema

### Solução proposta

Com a nossa API, as requisições poderão ser feitas de uma maneira simples e objetiva, utilizando apenas o formato JSON
nas respostas, é facilitado a compreensão e leitura. Com uma alta escalabilidade, é muito rápido e prático implementar
novas entidades na mesma, pois todo o processo complexo de conexão com o banco de dados já está resolvido,
bastando que o programador apenas configure as novas rotas desejadas e caso necessário, criar um Serviço para a mesma.

Atualmente possibilitamos o cadastro de Produtos e Fornecedores na nossa API, utilizando o banco de dados não relacional
MongoDB. É permitido salvar campos extras dessas entidades, mas alguns campos são obrigatórios definidos por quem for
usar a API.
A escalabilidade é o foco principal aqui, com poucos passos facilmente se cria novas coleções no banco e rotas para se
usar.

# Ferramentas necessárias

*PHP* => 8.1.*  
*Composer* => v2.3.5  
*Postman*  => 9.22.2  
*Mongo DB* => 5.0.9  
*Wampserver* => 3.2.6

# Como instalar

Primeiramente deve-se instalar as seguintes ferramentas/softwares em seu sistema:

    - PHP
    - Composer
    - Mongo DB
    - Wampserver

Com isso, partiremos para as devidas configurações.

1. Baixar o projeto do GitHub e rodar localmente o Composer Install para instalar as dependências do projeto.


2. Criar um banco de dados no MongoDB na porta **mongodb://localhost:27017** com o seguinte nome **T6-BancoDeDados2**


3. Baixar o Driver do MongoDB para o PHP no link: https://pecl.php.net/package/mongodb de acordo com a sua versão do PHP
   e do MongoDB

**(ATENÇÃO: garantir que as versões do driver estão corretas, no caso de utilizar as mesmas versões das ferramentas
utilizadas desse projeto, usar a versão 1.13.0 do driver**

4. Extrair o arquivo php_mongodb.dll para a pasta ***/ext*** do PHP a utilizar e habilitar no ***php.ini*** a extensão


5. Configurar no arquivo Vhost do Apache a seguinte configuração:

   <VirtualHost *:80>
   ServerName api.trabalho6.bancodedados.io

   DocumentRoot "c:/dev/php/t6-bancodedados2/public"
   <Directory  "c:/dev/php/t6-bancodedados2/public/">
   Options +Indexes +Includes +FollowSymLinks +MultiViews
   AllowOverride All
   Require local
   </Directory>
   </VirtualHost>

6. Importar para o seu Postman o arquivo ***t6-bd2.json***, nele você terá todas as chamadas de requisições já prontas
   para executar.

# Como usar a API?

A API atualmente consite em 2 CRUD´s completos a disposição do usuário, bastando chamar o método desejado, seguido do
nome da entidade em questão em que se deseja manipular.
Atualmente temos as seguintes rotas:

> #### */products* ou */vendors*
>- GET
>- POST

> #### */products/{id}* ou */vendors/{id}*
>- GET
>- PUT
>- DELETE