# Manga Reader

Manga Reader é um app PHP para cadastrar, organizar e ler obras no estilo mangá, manhwa, manhua e novel. O projeto nasceu como TCC procedural e foi reorganizado para uma versão mais atual, com backend em POO, MySQL local, Bootstrap 5.3 e layout responsivo com tema claro/escuro.

## Funcionalidades

- Página inicial com destaques, favoritos, lançamentos e obras atualizadas.
- Cadastro, edição, listagem e exclusão de obras.
- Cadastro, edição, listagem e exclusão de capítulos.
- Cadastro de capítulo por arquivo `.zip`.
- Extração das imagens do ZIP com `ZipArchive`.
- Organização automática das imagens em pastas por obra e capítulo.
- Cadastro e edição de usuários.
- Cadastro e edição de artistas.
- Login simples com sessão PHP.
- Perfil do usuário.
- Favoritos por usuário.
- Histórico de leitura.
- Listagem de obras com filtro por busca, status e gênero.
- Gêneros em tabela própria com relação N:N entre obra e gênero.
- Tema escuro e claro.
- Interface com Bootstrap 5.3, Bootstrap Icons, cards, navbar, breadcrumbs, modais, dropdowns, accordion, badges, tabelas e formulários responsivos.

## Requisitos

- XAMPP, WAMP ou ambiente equivalente com Apache, PHP e MySQL/MariaDB.
- PHP com a extensão `mysqli`.
- PHP com a extensão `zip` habilitada para cadastro de capítulos por `.zip`.
- HeidiSQL, phpMyAdmin ou outro cliente MySQL.

## Como Rodar

1. Copie o projeto para a pasta do XAMPP:

```text
C:\xampp\htdocs\TCC-arquivs
```

2. Inicie o Apache e o MySQL no painel do XAMPP.

3. Crie ou recrie o banco usando o arquivo:

```text
mangareader.sql
```

4. Confira as credenciais em:

```text
config/database.php
```

Configuração padrão atual:

```php
return array(
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => '123456',
    'database' => 'mangareader',
    'port' => 3306,
    'charset' => 'utf8mb4'
);
```

5. Acesse no navegador:

```text
http://localhost/TCC-arquivs/
```

## Acesso de Teste

O dump SQL cria um usuário de teste:

```text
E-mail: miguel@miguel
Senha: 1234
```

## Estrutura do Projeto

```text
app/
  Controllers/     Fluxos de entrada, edição, exclusão, login e upload.
  Core/            Conexão com banco e criação automática de campos/tabelas auxiliares.
  Repositories/    Consultas e gravações no banco.
  Services/        Serviços de upload e extração de ZIP.
  Support/         Helpers de URL, tema, texto, autenticação, opções e assets.

assets/
  CSS/             Tema principal do app.
  images/          Capas, páginas de capítulo, logo e imagem fallback.
  js/              Scripts próprios da interface.
  vendor/          Bootstrap 5.3 e Bootstrap Icons locais.

auth/              Login, logout e perfil.
config/            Configuração do banco.
crud_artistas/     CRUD de artistas.
crud_capitulos/    CRUD de capítulos.
crud_mangas/       CRUD, leitura, favoritos e visualização de obras.
crud_usuarios/     CRUD de usuários.
includes/          Header, footer, componentes compartilhados e funções de compatibilidade.
```

## Arquitetura

O backend usa POO simples, mantendo as páginas PHP tradicionais como pontos de entrada.

As páginas em `crud_*` e `auth/` carregam `includes/funcoes.php`. Esse arquivo inicializa `app/bootstrap.php`, registra o autoload das classes `App\...` e expõe funções auxiliares para manter compatibilidade com o estilo antigo do projeto.

Os controllers recebem `$_POST`, `$_GET` ou `$_FILES`, chamam repositories/services e redirecionam o usuário. Os repositories concentram SQL e acesso ao banco. Os helpers em `Support` cuidam de formatação, caminhos, autenticação, tema e URLs.

## Banco de Dados

Arquivo principal:

```text
mangareader.sql
```

Tabelas principais:

- `obras`: dados das obras, capa, slug, status, tipo, sinopse e pasta da obra.
- `capitulo`: capítulos cadastrados por obra.
- `imagem_cap`: imagens extraídas dos capítulos.
- `genero`: catálogo de gêneros.
- `obra_genero`: relação entre obras e gêneros.
- `usuario`: usuários do app.
- `favorito`: obras favoritas por usuário.
- `leitura_historico`: histórico de capítulos lidos.
- `artista`: artistas cadastrados.
- `artista_has_obras`: relação entre artistas e obras.

O app também executa uma verificação leve de estrutura em `App\Core\Database::ensureSchema()`, criando campos/tabelas auxiliares quando necessário. Mesmo assim, para banco vazio, o recomendado é executar o `mangareader.sql`.

## Fluxo de Obra

1. O usuário acessa `crud_mangas/cadastrar.php`.
2. Informa título, capa por link, autor, tipo, status, gêneros e sinopse.
3. `MangaController::store()` prepara os dados.
4. `MangaRepository::create()` grava a obra.
5. `GenreRepository::syncForManga()` salva as tags/gêneros.
6. O sistema cria a pasta da obra em:

```text
assets/images/obras/{slug-da-obra}
```

## Fluxo de Capítulo por ZIP

1. O usuário acessa `crud_capitulos/cadastrar.php`.
2. Seleciona uma obra, informa número/título e envia um `.zip`.
3. `ChapterController::store()` valida o upload.
4. `ChapterRepository::create()` cria o capítulo.
5. `UploadService::chapterZip()` abre o ZIP com `ZipArchive`.
6. O sistema filtra imagens `.jpg`, `.jpeg`, `.png`, `.gif` e `.webp`.
7. As imagens são ordenadas pelo nome de arquivo.
8. Os arquivos são salvos em:

```text
assets/images/obras/{slug-da-obra}/capitulo-{numero}
```

9. `ChapterRepository::addImage()` grava cada imagem em `imagem_cap`.

Se o ZIP não tiver imagens válidas, o capítulo criado é removido e a tela mostra erro.

## Página Inicial

A home fica em:

```text
home.php
```

Ela exibe:

- Destaques em carousel.
- Continue lendo, baseado no histórico do usuário.
- Favoritas atualizadas.
- Lançamentos.
- Atualizados recentes.

As seções de capítulos exibem uma única obra por card. Quando há capítulo novo, o card mostra o selo `Novo cap.` e aponta para o capítulo mais recente daquela obra.

## Tema e Layout

O tema principal está em:

```text
assets/CSS/mangareader-dark.css
```

O app usa variáveis CSS para tema claro e escuro. A cor principal atual é roxa.

O Bootstrap e os ícones estão locais:

```text
assets/vendor/bootstrap/
assets/vendor/bootstrap-icons/
```

O tema é alternado por:

```text
tema.php
```

## Componentes Compartilhados

Arquivo:

```text
includes/components.php
```

Componentes disponíveis:

- `mr_breadcrumb()`
- `mr_page_header()`
- `mr_delete_button()`
- `mr_delete_modal()`

Esses helpers evitam duplicação de HTML nas páginas e mantêm os componentes com padrão Bootstrap.

## Rotas Principais

- `index.php`: redireciona para a home.
- `home.php`: página inicial.
- `crud_mangas/listar.php`: biblioteca de obras.
- `crud_mangas/cadastrar.php`: cadastro de obra.
- `crud_mangas/editar.php?id_obra=1`: edição de obra.
- `crud_mangas/visualizar.php?id_obra=1`: página da obra.
- `crud_mangas/ler.php?id_cap=1`: leitor do capítulo.
- `crud_mangas/favoritos.php`: favoritos.
- `crud_capitulos/listar.php`: listagem de capítulos.
- `crud_capitulos/cadastrar.php`: cadastro de capítulo por ZIP.
- `crud_artistas/listar.php`: listagem de artistas.
- `crud_usuarios/listar.php`: listagem de usuários.
- `auth/login.php`: login.
- `auth/perfil.php`: perfil e histórico.

## Manutenção

Para adicionar uma nova tela:

1. Crie o arquivo dentro do CRUD correspondente.
2. Inclua `../includes/funcoes.php`.
3. Defina `$tituloPagina`.
4. Defina `$breadcrumbs`, se a tela precisar.
5. Inclua `../includes/header.php`.
6. Use componentes Bootstrap e helpers de `includes/components.php`.
7. Inclua `../includes/footer.php`.

Para adicionar uma regra de banco:

1. Prefira criar ou ajustar um repository em `app/Repositories`.
2. Mantenha SQL fora das telas.
3. Atualize `mangareader.sql`.
4. Se for mudança incremental importante, atualize também `Database::ensureSchema()`.

## Observações

- O projeto não usa Composer.
- O autoload é manual e fica em `app/bootstrap.php`.
- O app usa `mysqli`.
- O cadastro de senha ainda mantém compatibilidade com senha simples e `md5`, pois veio da versão antiga do TCC.
- Este projeto é local, pensado para rodar em XAMPP.
