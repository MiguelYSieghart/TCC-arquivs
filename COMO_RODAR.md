# Como rodar o Manga Reader

Projeto PHP simples, no padrão usado no TCC: PHP procedural, MySQL/MariaDB e Bootstrap 5.

## Requisitos

- XAMPP, WAMP ou outro servidor com Apache, PHP e MySQL/MariaDB
- phpMyAdmin ou cliente MySQL

## Banco de dados pelo HeidiSQL

1. Abra o HeidiSQL e conecte no MySQL local.
2. Abra o arquivo `mangareader.sql` em uma aba de query.
3. Execute o script inteiro.
4. O script cria/usa o banco `mangareader` e recria as tabelas principais.

Se o banco `mangareader` ja existir, nao tem problema: o script usa `CREATE DATABASE IF NOT EXISTS` e depois `USE mangareader`.

Atencao: o script usa `DROP TABLE IF EXISTS`, entao se ja existirem tabelas com dados nesse banco, elas serao apagadas e recriadas.

Depois das alteracoes de estrutura, execute novamente o `mangareader.sql` para criar os campos novos usados pelo app, como `slug`, `titulo_alt`, `genero`, `data_cadastro` e as tabelas de capitulos/imagens.

## Configuracao

As credenciais ficam em `includes/conecta.php`:

```php
$bdServidor = '127.0.0.1';
$bdUsuario = 'root';
$bdSenha = '123456';
$bdBanco = 'mangareader';
$bdPorta = 3306;
```

No XAMPP padrao, esses valores normalmente funcionam sem alterar.

## Acessos principais

- `index.php`: redireciona para a home
- `home.php`: pagina inicial
- `crud_mangas/listar.php`: listar, editar e excluir mangas
- `crud_mangas/cadastrar.php`: cadastrar manga
- `crud_mangas/visualizar.php?id_obra=1`: visualizar manga
- `crud_capitulos/listar.php`: listar capitulos
- `crud_usuarios/listar.php`: listar usuarios
- `crud_artistas/listar.php`: listar artistas
- `auth/login.php`: login simples usando a tabela `usuario`

## Estrutura atual

- `includes/`: conexao, funcoes e layout comum
- `crud_mangas/`: telas e acoes de mangas
- `crud_capitulos/`: cadastro, listagem e exclusao de capitulos
- `crud_usuarios/`: telas e acoes de usuarios
- `crud_artistas/`: telas e acoes de artistas
- `auth/`: login e logout
- `assets/`: CSS, JS e imagens usadas pelo app
- `legado/`: arquivos antigos preservados para consulta
- `exemplo/`: projeto de referencia usado como inspiracao

Usuario de teste do dump:

- E-mail: `miguel@miguel`
- Senha: `1234`
