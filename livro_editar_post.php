<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location:livro_listagem.php");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == NULL){
    header("location: livro_listagem.php");
    exit();
}
$livro = LivroRepository::get($_POST["id"]);
if(!$livro){
    header("location: livro_listagem.php");
    exit();
}

if(!isset($_POST['titulo'])){
    header("Location: livro_editar.php?id=".$livro->getId()."90");
    exit();
}
if($_POST["titulo" ] == '' || $_POST["titulo"] == null){
    header("Location: livro_editar.php?id=".$livro->getId()."sdgsdg");
    exit();
}



date_default_timezone_set('America/Sao_Paulo');

$livro->setTitulo($_POST['titulo']);
$livro->setAno($_POST['ano']);
$livro->setGenero($_POST['genero']);
$livro->setAutorId($_POST['autor_id']);
$livro->setIsbn($_POST['isbn']);
$livro->setAlteracaoFuncionarioId($user->getId());
$livro->setDataAlteracao(date('Y-d-m H:i:s'));

LivroRepository::update($livro);


header("location:livro_editar.php?id=".$livro->getId()."ultimo");
 