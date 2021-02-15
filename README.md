# corridas

Antes de clonar o repositório "corridas", proceder com a instalação do laradock, conforme instruções abaixo.

Instruções para a instalação do laradock:

Requirementos:
#
    Git
    Docker [ >= 17.12 ]

Instalação:
#

1 - Proceda com a clonagem do repositório em uma pasta de sua escolha:

git clone https://github.com/laradock/laradock.git

Sua estrutura de pastas deve ser semelhante a esta:

* laradock
* corridas

2 - Adicione a seguinte linha em seu arquivo hosts (linux).

127.0.0.1  corridas

//---------------------- Após a clonagem do laradock ---------------------------------

1º Substituir os seguintes arquivos da pasta laradock:

Mover os arquivos (docker-compose.yml e env_laradocker) para a pasta laradock (onde foi clonado o laradock), trocando o nome do arquivo env_laradocker para .env

2º Entrar na pasta "laradock" e executar os seguintes comandos:

sudo docker-compose build nginx mysql php-fpm phpmyadmin (preparando os arquivos do laradock)
sudo docker-compose up -d nginx mysql phpmyadmin (executando o ambiente do laradocker)

3º Clonar este repositório.

Após, entrar na pasta corridas e seguir as instruções abaixo:

// --------------------- Instruções para a migração da base de dados -----------------

Para a migração da base de dados, trocar o valor do DB_HOST, de "mysql" para "127.0.0.1"
Executar o comando: php artisan migrate

Após realizar a migração, voltar o conteúdo do arquivo DB_HOST para "mysql".

// --------------------- Sobre o projeto --------------------------

Para facilitar os testes, foram criadas views para visualização dos dados.
Ao iniciar o sistema o usuário deverá se cadastrar e logar para ter acesso a todas as funções do sistema.
