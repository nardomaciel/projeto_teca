# Biblioteca online (biblioTECA)

Sistema para controlar o dia a dia de uma biblioteca: o acervo, quem pega livro emprestado e quando ele precisa voltar.

Foi um dos meus primeiros sistemas completos, escrito em PHP puro, sem framework, separando as regras em classes e o acesso ao banco em repositórios. Foi aqui que eu entendi na prática por que os frameworks existem.

Um tempo depois voltei nele para um remaster: a estrutura e a lógica são as mesmas que eu escrevi na época, mas corrigi os bugs, dei uma limpada no código e troquei o visual para Bootstrap 5, para quem abrir encontrar um sistema funcionando de verdade.

O sistema tem duas partes: a área do funcionário, onde a biblioteca é administrada, e a biblioteca online, aberta ao público.

## Biblioteca online

Uma estante de madeira com as lombadas dos livros, separados por gênero em prateleiras. A pessoa clica num livro, lê a sinopse e, se ele estiver na estante, digita o código de acesso que recebeu no cadastro. O empréstimo sai na hora, no nome dela, por 7 dias.

- Busca por título ou autor e filtro de só disponíveis
- Livros emprestados aparecem apagados, com a data em que voltam
- "Meu empréstimo": com o código, a pessoa vê qual livro está com ela e até quando
- Depois de 5 códigos errados seguidos, a tentativa fica bloqueada por alguns minutos

## Área do funcionário

- Cadastrar livros (com sinopse e cor da lombada), autores, clientes e funcionários
- Cadastrar vários livros de uma vez, colando uma lista. Autores novos são criados junto
- Gerar e trocar o código de acesso de cada cliente
- Registrar empréstimos com prazo de 7 dias, renovar uma vez e dar baixa na devolução
- Ver a multa por atraso na hora da devolução (R$ 1,00 por dia)
- Ver os empréstimos separados por situação. Os feitos pela biblioteca online aparecem marcados
- Cada cadastro guarda quem incluiu e quem alterou

## Como rodar localmente

Não precisa instalar banco de dados nem nada além do PHP. Por padrão o sistema usa SQLite: na primeira vez que abrir, ele cria o banco sozinho em `database/teca.sqlite`, já com 217 livros de 9 gêneros, alguns clientes e empréstimos de exemplo.

### 1. Baixe o projeto

```bash
git clone https://github.com/nardomaciel/projeto_teca.git
cd projeto_teca
```

Ou baixe o ZIP pelo botão **Code > Download ZIP** e extraia.

### 2. Escolha um jeito de rodar

**Opção A: só com o PHP (o mais rápido)**

Precisa do PHP 8 ou mais novo. Confira com `php -v`. Dentro da pasta do projeto, rode:

```bash
php -S localhost:8000
```

Deixe o terminal aberto enquanto usa o sistema. Para parar, aperte `Ctrl + C`.

**Opção B: com XAMPP ou Laragon**

1. Copie a pasta `projeto_teca` para dentro de `htdocs` (XAMPP) ou `www` (Laragon).
2. Inicie o Apache pelo painel.
3. Acesse http://localhost/projeto_teca.

### 3. Abra no navegador

| O quê | Endereço (opção A) | Como entrar |
|---|---|---|
| Biblioteca online | http://localhost:8000/biblioteca.php | Escolha um livro e use o código `CAR8P3` |
| Área do funcionário | http://localhost:8000 | CPF `123.456.789-09`, senha `biblioteca` |

Na opção B, troque `localhost:8000` por `localhost/projeto_teca`.

Outros códigos de exemplo: `ANA7K2` e `BRU4M9` (já estão com um livro) e `DIE5R6`.

### Usar MySQL em vez de SQLite (opcional)

1. No phpMyAdmin, vá em **Importar** e envie o arquivo `database/projeto_teca.sql`. Ele cria o banco `projeto_teca` com os mesmos dados de exemplo.
2. Em `include/config.php`, troque `'driver' => 'sqlite'` por `'driver' => 'mysql'` e ajuste usuário e senha se o seu MySQL não for `root` sem senha.

### Problemas comuns

- **"could not find driver"**: a extensão do banco está desligada no PHP. Abra o `php.ini` (o caminho aparece em `php --ini`), tire o `;` da frente de `extension=pdo_sqlite` (ou `extension=pdo_mysql`, se usar MySQL) e reinicie.
- **Quero começar do zero**: apague o arquivo `database/teca.sqlite`. Ele é recriado com os dados de exemplo na próxima vez que você abrir o sistema.
- **A página abriu sem estilo**: o Bootstrap e os ícones vêm da internet (CDN), então é preciso estar conectado.

Os ISBNs dos livros de exemplo são fictícios.

## Tecnologias

PHP, PDO, MySQL ou SQLite, Bootstrap 5, jQuery e jQuery Mask.

## Estrutura

```
include/class/             classes de domínio (livro, autor, cliente, empréstimo...)
include/class/repository/  acesso ao banco de cada entidade
include/header.php, footer.php, navbar.php   partes comuns das páginas
*_listagem.php, *_novo.php, *_editar.php, *_excluir.php   telas de cada cadastro
*_post.php                 recebem os formulários
biblioteca*.php            a biblioteca online (estante, empréstimo e consulta)
css/biblioteca.css         o visual da estante
database/                  scripts do banco (MySQL e SQLite)
```

## O que mudou no remaster

**Bugs corrigidos**
- Editar um funcionário não salvava nada, e trocar a senha também não.
- Ao carregar um funcionário, a senha era criptografada de novo, o que travaria o login dele depois de qualquer edição.
- As datas de inclusão e alteração eram gravadas no formato errado (ano-dia-mês).
- O cadastro de empréstimo lia o campo errado do formulário e não bloqueava livro ou cliente já com empréstimo ativo.
- A página de novo empréstimo abria sem exigir login.
- No menu, "Renovados" e "Não renovados" estavam trocados.
- Depois de salvar, alguns cadastros redirecionavam para endereços quebrados.
- A listagem de funcionários tinha o HTML da tabela quebrado.
- A consulta de multa estava incompleta e sem uso. Removi.

**Limpeza**
- Topo, menu e rodapé viraram includes únicos (`header.php`, `footer.php`), em vez de cada página repetir tudo.
- As cinco listagens de empréstimo usam a mesma tabela (`include/emprestimo_tabela.php`).
- Funções pequenas de apoio em `include/helpers.php`: exigir login, redirecionar com mensagem, formatar datas.
- Configuração do banco num arquivo só (`include/config.php`), em vez de fixa no código.
- O script do banco (`database/`) não existia no repositório. Agora existe, com dados de exemplo.

**Segurança básica**
- Senhas com `password_hash` no lugar de SHA-256 sem salt.
- Todo texto vindo do banco passa por `htmlspecialchars` antes de aparecer na tela.
- Exclusões pedem confirmação, e as regras de exclusão também são conferidas no servidor.

**Visual**
- Bootstrap 5 em todas as páginas (antes misturava a versão 4 e a 5), com mensagens de sucesso e erro depois de cada ação.
- Página inicial com os números do acervo e os empréstimos vencidos.
- Modo claro e escuro, seguindo o sistema e com botão para trocar no menu.
- Funciona no celular: menu recolhível e tabelas que rolam para o lado sem cortar a página.
