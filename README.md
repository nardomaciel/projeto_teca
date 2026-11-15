# Biblioteca online (biblioTECA)

Sistema para controlar o dia a dia de uma biblioteca: o acervo, quem pega livro emprestado e quando ele precisa voltar.

Foi um dos meus primeiros sistemas completos, escrito em PHP puro, sem framework, separando as regras em classes e o acesso ao banco em repositórios. Foi aqui que eu entendi na prática por que os frameworks existem.

Um tempo depois voltei nele para um remaster: a estrutura e a lógica são as mesmas que eu escrevi na época, mas corrigi os bugs, dei uma limpada no código e troquei o visual para Bootstrap 5, para quem abrir encontrar um sistema funcionando de verdade.

## O que dá pra fazer

- Cadastrar livros, autores, clientes e funcionários
- Registrar empréstimos com prazo de 7 dias, renovar uma vez e dar baixa na devolução
- Ver a multa por atraso na hora da devolução (R$ 1,00 por dia)
- Ver os empréstimos separados por situação: ativos, vencidos, renovados, não renovados e devolvidos
- Entrar com login de funcionário. Cada cadastro guarda quem incluiu e quem alterou

## Como rodar

Precisa de PHP 8 com a extensão `pdo_sqlite` (já vem ligada no XAMPP e no Laragon).

```bash
php -S localhost:8000
```

Abra http://localhost:8000 e entre com:

- **CPF:** 123.456.789-09
- **Senha:** biblioteca

Na primeira vez, o banco é criado sozinho em `database/teca.sqlite`, já com alguns livros, clientes e empréstimos de exemplo.

**Com MySQL:** importe `database/projeto_teca.sql` no phpMyAdmin e troque `'driver' => 'sqlite'` por `'driver' => 'mysql'` em `include/config.php`.

## Tecnologias

PHP, PDO, MySQL ou SQLite, Bootstrap 5, jQuery e jQuery Mask.

## Estrutura

```
include/class/             classes de domínio (livro, autor, cliente, empréstimo...)
include/class/repository/  acesso ao banco de cada entidade
include/header.php, footer.php, navbar.php   partes comuns das páginas
*_listagem.php, *_novo.php, *_editar.php, *_excluir.php   telas de cada cadastro
*_post.php                 recebem os formulários
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
