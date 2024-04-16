<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_GET['id'])){
    header("location: livro_listagem.php");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: livro_listagem.php");
    exit();
}
$livro = LivroRepository::get($_GET["id"]);
if(!$livro){
    header("location: livro_listagem.php");
    exit();
}


LivroRepository::delete($livro->getId());
header("location:livro_listagem.php");