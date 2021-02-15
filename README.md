# corridas

Antes de clonar o repositório "corridas", proceder com a instalação do laradock, conforme instruções abaixo.

Instruções para a instalação do laradock:

Getting Started
#
Requirements
#

    Git
    Docker [ >= 17.12 ]

Installation
#

1 - Clone this repository anywhere on your machine:

git clone https://github.com/laradock/laradock.git

Your folder structure should look like this:

* laradock
* corridas

2 - Add the domains to the hosts files.

127.0.0.1  corridas

//---------------------- Após a clonagem do laradock ---------------------------------

1º Substituir os seguintes arquivos da pasta laradock:

Mover os arquivos (docker-compose.yml e env_laradocker) para a pasta laradock (onde foi clonado o laradock), trocando o nome do arquivo env_laradocker para .env

Entrar na pasta "laradock" e clonar o repositorio corridas
Após, entrar na pasta corridas e seguir as instruções abaixo:

// --------------------- Instruções para a migração da base de dados -----------------

Para a migração da base de dados, trocar o valor do DB_HOST, de "mysql" para "127.0.0.1". Após realizar o migration, voltar o conteúdo do arquivo DB_HOST para "mysql".

Após, entrar na pasta laradock e executar os seguintes comandos:

sudo docker-compose build nginx mysql php-fpm phpmyadmin
sudo docker-compose up -d nginx mysql phpmyadmin

// --------------------- Sobre o projeto --------------------------

Para facilitar os testes, foram criadas views para visualização dos dados.
Ao iniciar o sistema o usuário deverá se cadastrar e logar para ter acesso a todas as funções do sistema.
