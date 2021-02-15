# corridas

Antes de clonar o repositório "corridas", proceder com a instalação do laradock, conforme instruções abaixo.

Instruções para a instalação do laradock:

Requirementos:
#
    Git
    Docker [ >= 17.12 ]

<<<<<<< HEAD
Installation
#

1 - Clone this repository anywhere on your machine:
=======
Instalação:
#

1 - Proceda com a clonagem do repositório em uma pasta de sua escolha:
>>>>>>> f34f78d87031218b8660b2f3d3a4f80d341dac8b

git clone https://github.com/laradock/laradock.git

Sua estrutura de pastas deve ser semelhante a esta:

* laradock
* corridas

<<<<<<< HEAD
2 - Add the domains to the hosts files.
=======
2 - Adicione a seguinte linha em seu arquivo hosts (linux).

127.0.0.1  corridas

//---------------------- Após a clonagem do laradock ---------------------------------

1º Substituir os seguintes arquivos da pasta laradock:

Mover os arquivos (docker-compose.yml e env_laradocker) para a pasta laradock (onde foi clonado o laradock), trocando o nome do arquivo env_laradocker para .env
>>>>>>> f34f78d87031218b8660b2f3d3a4f80d341dac8b

2º Entrar na pasta "laradock" e executar os seguintes comandos:

sudo docker-compose build nginx mysql php-fpm phpmyadmin (preparando os arquivos do laradock)
sudo docker-compose up -d nginx mysql phpmyadmin (executando o ambiente do laradocker)

<<<<<<< HEAD
1º Entrar na pasta "laradock" e clonar o repositório corridas.

2º Substituir os seguintes arquivos da pasta laradock:

Mover os arquivos (docker-compose.yml e env_laradocker) para a pasta laradock (onde foi clonado o laradock), trocando o nome do arquivo env_laradocker para .env

3º Mover o arquivo (corridas.conf) para a pasta nginx/sites.

=======
3º Clonar este repositório.

>>>>>>> f34f78d87031218b8660b2f3d3a4f80d341dac8b
Após, entrar na pasta corridas e seguir as instruções abaixo:

// --------------------- Instruções para a migração da base de dados -----------------

<<<<<<< HEAD
Para a migração da base de dados, trocar o valor do DB_HOST, de "mysql" para "127.0.0.1". Após realizar o migration, voltar o conteúdo do arquivo DB_HOST para "mysql".

Após, entrar na pasta laradock e executar os seguintes comandos:
=======
Para a migração da base de dados, trocar o valor do DB_HOST, de "mysql" para "127.0.0.1"
Executar o comando: php artisan migrate
>>>>>>> f34f78d87031218b8660b2f3d3a4f80d341dac8b

Após realizar a migração, voltar o conteúdo do arquivo DB_HOST para "mysql".

// --------------------- Sobre o projeto --------------------------

Para facilitar os testes, foram criadas views para visualização dos dados.
Ao iniciar o sistema o usuário deverá se cadastrar e logar para ter acesso a todas as funções do sistema.
