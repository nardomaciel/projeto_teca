# Biblioteca online

Sistema para controlar o dia a dia de uma biblioteca: o acervo, quem pega livro emprestado e quando ele precisa voltar.

Foi um dos meus primeiros sistemas completos. Escrevi tudo em PHP puro, sem framework, separando as regras em classes e o acesso ao banco em repositórios. Foi aqui que eu entendi na prática por que os frameworks existem.

## O que dá pra fazer

- Cadastrar livros, autores, clientes e funcionários
- Registrar empréstimos, renovar e dar baixa na devolução
- Ver os empréstimos separados por situação: ativos, vencidos, renovados, não renovados e devolvidos
- Entrar com login de funcionário, com troca de senha

## Tecnologias

PHP, PDO, MySQL, HTML, CSS e jQuery Mask para as máscaras dos formulários.

## Como rodar

1. Coloque a pasta dentro do servidor local (XAMPP, Laragon ou parecido).
2. Crie um banco MySQL chamado `projeto_teca`.
3. Se o seu MySQL não usa `root` sem senha, ajuste a conexão em `include/db.php`.
4. Abra `index.php` no navegador.

## Estrutura

```
include/class/             classes de domínio (livro, autor, cliente, empréstimo...)
include/class/repository/  acesso ao banco de cada entidade
*_listagem.php, *_novo.php, *_editar.php, *_excluir.php   telas de cada cadastro
```
