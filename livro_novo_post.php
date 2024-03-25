<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['titulo'])){
    header("Location: livro_novo.php?1");
    exit();
}
if($_POST["nome" == ''] || $_POST["nome" == null]){
    header("Location: livro_novo.php?2");
    exit();
}

$livro = Factory::livro(); 

$livro->setTitulo($_POST['titulo']);
$livro->setAno($_POST['ano']);
$livro->setGenero($_POST['genero']);
$livro->setIsbn($_POST['isbn']);
$livro->setAutorId($_POST['autor']);
$livro->setinclusaoFuncionarioId($user->getID());
$livro->setDataInclusao(date('Y-d-m H:i:s'));

$livro_retorno = LivroRepository::insert($livro);

if($livro_retorno > 0){
    header("Location: livro_editar.php?id=".$livro_retorno);
    exit();
}

header("Location: livro_novo.php?3");
    exit();