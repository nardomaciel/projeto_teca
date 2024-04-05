<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_GET['id'])){
    header("location: funcionario_listagem.php?1");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: funcionario_listagem.php?2");
    exit();
}
$funcionario = FuncionarioRepository::get($_GET["id"]);
if(!$funcionario){
    header("location: funcionario_listagem.php?3");
    exit();
}


FuncionarioRepository::delete($funcionario->getId());
header("location:funcionario_listagem.php");