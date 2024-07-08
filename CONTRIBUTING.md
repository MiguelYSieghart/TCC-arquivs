# Contribuindo com o Manga Reader

Obrigado por querer melhorar o Manga Reader. Este projeto nasceu como um TCC em PHP e foi reorganizado para uma versão mais atual, mantendo a proposta de ser simples de rodar em XAMPP com MySQL local.

## Antes de Começar

- Leia o `README.md` para entender a estrutura do app.
- Rode o projeto localmente pelo XAMPP antes de alterar telas ou fluxos.
- Importe o `mangareader.sql` em um banco local de teste.
- Evite alterar arquivos de upload reais em `assets/images/obras`.

## Padrão do Projeto

- Backend em PHP orientado a objetos dentro da pasta `app/`.
- Páginas de entrada separadas por módulo em `auth/`, `crud_mangas/`, `crud_capitulos/`, `crud_artistas/` e `crud_usuarios/`.
- Componentes compartilhados em `includes/`.
- Layout usando Bootstrap 5.3 e Bootstrap Icons.
- CSS principal em `assets/CSS/mangareader-dark.css`.
- JavaScript principal em `assets/js/scripts.js`.

## Como Fazer Alterações

1. Crie uma branch para a alteração.
2. Faça mudanças pequenas e focadas.
3. Teste o fluxo afetado no navegador.
4. Verifique se as páginas continuam responsivas.
5. Confirme se o PHP não possui erro de sintaxe.

Comando sugerido para validar PHP no Windows com XAMPP:

```powershell
C:\xampp\php\php.exe -l caminho\do\arquivo.php
```

## Banco de Dados

Quando alterar tabelas, campos ou dados iniciais:

- Atualize o arquivo `mangareader.sql`.
- Mantenha compatibilidade com MySQL/MariaDB local.
- Use `utf8mb4`.
- Evite remover dados de exemplo que ajudam a testar a aplicação.
- Documente no `README.md` se o fluxo mudar.

## Uploads de Capítulos

O cadastro de capítulos por ZIP depende da extensão `ZipArchive` do PHP.

Ao alterar esse fluxo:

- Valide arquivos `.zip`.
- Extraia apenas imagens permitidas.
- Mantenha a organização por obra e capítulo.
- Não sobrescreva arquivos de capítulos já cadastrados sem necessidade.

## Estilo de Commit

Use mensagens curtas e claras, explicando o que mudou de forma simples.

Exemplos:

```text
Ajusta tela de obras
Melhora cadastro de capítulos
Corrige favoritos duplicados
Atualiza banco do app
```

## Pull Requests

Ao abrir uma alteração:

- Explique o que foi feito.
- Informe quais telas foram testadas.
- Avise se o SQL precisa ser importado novamente.
- Inclua prints quando a mudança for visual.

## Cuidados

- Não envie senhas reais, dumps privados ou dados pessoais.
- Não apague uploads locais sem confirmar.
- Não misture refatoração grande com correção pequena.
- Não altere o tema ou layout global sem testar as principais páginas.
