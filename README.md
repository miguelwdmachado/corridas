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

Choose the setup the best suits your needs.

    A) Setup for Single Project
        A.1) Already have a PHP project
        A.2) Don’t have a PHP project yet

A) Setup for Single Project
#

    (Follow these steps if you want a separate Docker environment for each project)

A.1) Already have a PHP project:
#

1 - Clone laradock on your project root directory:

git submodule add https://github.com/Laradock/laradock.git

Note: If you are not using Git yet for your project, you can use git clone instead of git submodule.

To keep track of your Laradock changes, between your projects and also keep Laradock updated check these docs

2 - Make sure your folder structure should look like this:

* project-a
*   laradock-a
* project-b
*   laradock-b

(It’s important to rename the laradock folders to unique name in each project, if you want to run laradock per project).

3 - Go to the Usage section.

A.2) Don’t have a PHP project yet:
#

1 - Clone this repository anywhere on your machine:

git clone https://github.com/laradock/laradock.git

Your folder structure should look like this:

* laradock
* project-z

2 - Edit your web server sites configuration.

We’ll need to do step 1 of the Usage section now to make this happen.

cp env-example .env

At the top, change the APP_CODE_PATH_HOST variable to your project path.

APP_CODE_PATH_HOST=../project-z/

Make sure to replace project-z with your project folder name.

3 - Go to the Usage section.

4 - Add the domains to the hosts files.

127.0.0.1  corridas

//---------------------- Após a clonagem do laradock ---------------------------------

Mover os arquivos (docker-compose.yml e env_laradocker) para a pasta laradock (onde foi clonado o laradock), trocando o nome do arquivo env_laradocker para .env

Entrar na pasta "laradock" e clonar o repositorio corridas
Após, entrar na pasta corridas e seguir as instruções abaixo:

// --------------------- Instruções para a migração da base de dados -----------------

1º Substituir os seguintes arquivos da pasta laradock:

Para a migração da base de dados, trocar o valor do DB_HOST, de "mysql" para "127.0.0.1". Após realizar o migration, voltar o conteúdo do arquivo DB_HOST para "mysql".

Após, entrar na pasta laradock e executar os seguintes comandos:

sudo docker-compose build nginx mysql php-fpm phpmyadmin
sudo docker-compose up -d nginx mysql phpmyadmin

// --------------------- Sobre o projeto --------------------------

Para facilitar os testes, foram criadas views para visualização dos dados.
Ao iniciar o sistema o usuário deverá se cadastrar e logar para ter acesso a todas as funções do sistema.
