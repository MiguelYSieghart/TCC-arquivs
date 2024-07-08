# Como Rodar o Manga Reader

Projeto PHP com MySQL/MariaDB, Bootstrap 5.3 e backend organizado em POO.

Para a documentação completa do app, leia `README.md`.

## Requisitos

- XAMPP, WAMP ou outro servidor com Apache, PHP e MySQL/MariaDB
- phpMyAdmin ou cliente MySQL
- Extensao `zip` habilitada no PHP para cadastrar capitulos por arquivo `.zip`

## Banco de dados pelo HeidiSQL

1. Abra o HeidiSQL e conecte no MySQL local.
2. Abra o arquivo `mangareader.sql` em uma aba de query.
3. Execute o script inteiro.
4. O script cria/usa o banco `mangareader` e recria as tabelas principais.

Se o banco `mangareader` ja existir, nao tem problema: o script usa `CREATE DATABASE IF NOT EXISTS` e depois `USE mangareader`.

Atencao: o script usa `DROP TABLE IF EXISTS`, entao se ja existirem tabelas com dados nesse banco, elas serao apagadas e recriadas.

Depois das alteracoes de estrutura, execute novamente o `mangareader.sql` para criar os campos novos usados pelo app, como `slug`, `titulo_alt`, `genero`, `pasta_obra`, `data_cadastro` e as tabelas de generos, capitulos, imagens, favoritos e historico de leitura.

O app tambem tenta criar os campos novos automaticamente ao abrir qualquer pagina, mas o arquivo SQL atualizado continua sendo a forma mais limpa de preparar um banco vazio.

## Configuracao

As credenciais ficam em `config/database.php`:

```php
'host' => '127.0.0.1',
'user' => 'root',
'password' => '123456',
'database' => 'mangareader',
'port' => 3306,
```

No XAMPP padrao, esses valores normalmente funcionam sem alterar.

## Acessos principais

- `index.php`: redireciona para a home
- `home.php`: pagina inicial
- `crud_mangas/listar.php`: listar, editar e excluir mangas
- `crud_mangas/listar.php?genero=1`: filtrar obras por genero
- `crud_mangas/cadastrar.php`: cadastrar manga
- `crud_mangas/visualizar.php?id_obra=1`: visualizar manga
- `crud_capitulos/listar.php`: listar capitulos
- `crud_capitulos/cadastrar.php`: cadastrar capitulos enviando um ZIP com imagens
- `crud_usuarios/listar.php`: listar usuarios
- `crud_artistas/listar.php`: listar artistas
- `auth/login.php`: login simples usando a tabela `usuario`
- `auth/perfil.php`: perfil, favoritos e historico de leitura

## Cadastro de capitulos por ZIP

1. Cadastre a obra informando o link da capa.
2. O app cria a pasta da obra em `assets/images/obras/{slug-da-obra}`.
3. No cadastro de capitulo, envie um arquivo `.zip` com as paginas em `.jpg`, `.jpeg`, `.png`, `.gif` ou `.webp`.
4. O app cria a pasta `assets/images/obras/{slug-da-obra}/capitulo-{numero}` e grava as paginas na ordem natural dos nomes dos arquivos.

## Estrutura atual

- `app/`: classes do backend em POO
- `app/Core/`: conexao com banco
- `app/Repositories/`: consultas e operacoes no banco
- `app/Controllers/`: fluxos de cadastro, edicao e exclusao
- `app/Services/`: servicos como upload
- `app/Support/`: helpers de URL, tema, auth e opcoes
- `config/`: configuracao do banco
- `includes/`: funcoes de compatibilidade e layout comum
- `crud_mangas/`: telas e acoes de mangas
- `crud_capitulos/`: cadastro, listagem e exclusao de capitulos
- `crud_usuarios/`: telas e acoes de usuarios
- `crud_artistas/`: telas e acoes de artistas
- `auth/`: login e logout
- `assets/`: CSS, JS, imagens e Bootstrap local

Usuario de teste do dump:

- E-mail: `miguel@miguel`
- Senha: `1234`
