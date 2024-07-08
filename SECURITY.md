# Política de Segurança

## Versões Suportadas

Este projeto é mantido como aplicação local de estudo/TCC. A versão principal do repositório é a única considerada para correções.

| Versão | Suporte |
| --- | --- |
| Atual | Sim |
| Versões antigas/procedurais | Não |

## Como Reportar Problemas

Se encontrar uma falha de segurança, evite abrir detalhes sensíveis em issues públicas.

Reporte com:

- Descrição curta do problema.
- Passos para reproduzir.
- Página ou arquivo afetado.
- Impacto esperado.
- Sugestão de correção, se houver.

## Cuidados no Ambiente Local

- Não use senha real no banco local.
- Não publique `config/database.php` com credenciais de produção.
- Não importe dumps contendo dados pessoais.
- Não habilite listagem pública de diretórios no Apache.
- Mantenha PHP, Apache e MySQL atualizados.
- Habilite a extensão `zip` apenas em ambiente confiável.

## Uploads

O app aceita upload de capas e capítulos por ZIP. Ao usar essa funcionalidade:

- Envie apenas arquivos confiáveis.
- Use ZIPs contendo imagens.
- Evite nomes de arquivos com dados pessoais.
- Não reaproveite a pasta local de uploads como backup definitivo.

## Dependências Frontend

O projeto usa Bootstrap 5.3 e Bootstrap Icons em `assets/vendor/`.

Ao atualizar dependências:

- Prefira versões oficiais.
- Teste o tema claro e escuro.
- Confira modais, dropdowns, cards, navbar, tabelas e formulários.

## Escopo

Esta política cobre o código deste repositório. Problemas em XAMPP, MySQL, Apache, navegador ou sistema operacional devem ser corrigidos nos respectivos projetos ou fornecedores.
