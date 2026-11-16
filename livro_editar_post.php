<?php
include_once('include/factory.php');
$user = exigir_login();

$livro = LivroRepository::get($_POST["id"] ?? 0);
if (!$livro) {
    redirecionar("livro_listagem.php", "Livro não encontrado.", "warning");
}

$voltar = "livro_editar.php?id=" . $livro->getId();

if (campo('titulo') == '' || campo('autor_id') == '' || campo('ano') == '' || campo('isbn') == '') {
    redirecionar($voltar, "Preencha título, autor, ano e ISBN.", "danger");
}

if (!AutorRepository::get(campo('autor_id'))) {
    redirecionar($voltar, "Escolha um autor da lista.", "danger");
}

$livro->setTitulo(campo('titulo'));
$livro->setAno(campo('ano'));
$livro->setGenero(campo('genero'));
$livro->setAutorId(campo('autor_id'));
$livro->setIsbn(campo('isbn'));
$livro->setSinopse(campo('sinopse'));
$livro->setCor(preg_match('/^#[0-9a-fA-F]{6}$/', campo('cor')) ? campo('cor') : null);
$livro->setAlteracaoFuncionarioId($user->getId());
$livro->setDataAlteracao(date('Y-m-d H:i:s'));

LivroRepository::update($livro);

redirecionar("livro_listagem.php", "Livro atualizado.");
