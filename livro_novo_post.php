<?php
include_once('include/factory.php');
$user = exigir_login();

if (campo('titulo') == '' || campo('autor_id') == '' || campo('ano') == '' || campo('isbn') == '') {
    redirecionar("livro_novo.php", "Preencha título, autor, ano e ISBN.", "danger");
}

if (!AutorRepository::get(campo('autor_id'))) {
    redirecionar("livro_novo.php", "Escolha um autor da lista.", "danger");
}

$livro = Factory::livro();
$livro->setTitulo(campo('titulo'));
$livro->setAno(campo('ano'));
$livro->setGenero(campo('genero'));
$livro->setIsbn(campo('isbn'));
$livro->setSinopse(campo('sinopse'));
$livro->setCor(preg_match('/^#[0-9a-fA-F]{6}$/', campo('cor')) ? campo('cor') : null);
$livro->setAutorId(campo('autor_id'));
$livro->setInclusaoFuncionarioId($user->getId());
$livro->setDataInclusao(date('Y-m-d H:i:s'));

LivroRepository::insert($livro);

redirecionar("livro_listagem.php", "Livro cadastrado.");
