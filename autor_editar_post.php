<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: autor_listagem.php?1");
    exit();
}
if($_POST["id"] == "" || $_POST["id"] == NULL){
    header("location: autor_listagem.php?2");
    exit();
}
$autor = AutorRepository::get($_POST["id"]);
if(!$autor){
    header("location: autor_listagem.php?3");
    exit();
}

if(!isset($_POST['nome'])){
    header("Location: autor_novo.php?id=".$autor->getId());
    exit();
}
if($_POST["nome" ] == "" || $_POST["nome" == null]){
    header("Location: autor_novo.php?id=".$autor->getId());
    exit();
}



$autor->setNome($_POST['nome']);
$autor->setAlteracaoFuncionarioId($user->getID());
$autor->setDataAlteracao(date('Y-d-m H:i:s'));

AutorRepository::update($autor);


header("location:autor_editar.php?id=".$autor->getId());
 