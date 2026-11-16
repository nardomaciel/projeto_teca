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

## Como rodar

Precisa de PHP 8 com a extensão `pdo_sqlite` (já vem ligada no XAMPP e no Laragon).

```bash
php -S localhost:8000
```

- **Biblioteca online:** http://localhost:8000/biblioteca.php. Para pegar um livro, use o código `CAR8P3` (cliente de exemplo).
- **Área do funcionário:** http://localhost:8000, com CPF `123.456.789-09` e senha `biblioteca`.

Na primeira vez, o banco é criado sozinho em `database/teca.sqlite`, já com 217 livros de 9 gêneros, alguns clientes e empréstimos de exemplo. Os ISBNs dos livros de exemplo são fictícios.

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
