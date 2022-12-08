<h1>Recomendações</h1>
Depois de clonar o repositório, você precisa:

<p>1: Executar o comando composer update ou composer install para instalar as dependências.</P
<p>2:Criar um arquivo .env a partir do .env.example e substituir as credenciais de acordo com o seu banco de dados.</P>

<p>3:Gerar uma chave pro projeto através do comando php artisan key:generate.</P>

<p>4:Depois de criar o banco de dados no phpmyadmin (ou qualquer gerenciador) executar o comando php artisan migrate na raiz do projeto para gerar as tabelas no seu bando de dados (configurar as credenciais antes no passo de criação do arquivo .env).</P>
