<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_GET['id'])){
    header("location: funcionario_listagem.php");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: funcionario_listagem.php");
    exit();
}
$funcionario = FuncionarioRepository::get($_GET["id"]);
if(!$funcionario){
    header("location: funcionario_listagem.php");
    exit();
}


FuncionarioRepository::delete($funcionario->getId());
header("location:funcionario_listagem.php");