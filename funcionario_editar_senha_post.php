<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: funcionario_listagem.php");
    exit();
}
if($_POST["id"] == '' || $_POST["id"] == NULL){
    header("location: funcionario_listagem.php");
    exit();
}
$funcionario = FuncionarioRepository::get($_POST["id"]);
if(!$funcionario){
    header("location: funcionario_listagem.php");
    exit();
}

if(!isset($_POST['senha'])){
    header("Location: funcionario_editar.php?id=".$funcionario->getId());
    exit();
}
if($_POST["senha" ] == '' || $_POST["senha"] == null){
    header("Location: funcionario_editar.php?id=".$funcionario->getId());
    exit();
}
if($_POST["senha" ] != $_POST["repSenha"]){
    header("Location: funcionario_editar.php?id=".$funcionario->getId());
    exit();
}

date_default_timezone_set('America/Sao_Paulo');  //Definindo o fuso horário para Brasília (Brazil)

$funcionario->setSenha($_POST['senha']);
$funcionario->setInclusaoFuncionarioId($user->getId());
$funcionario->setDataInclusao(date('Y-d-m H:i:s'));

FuncionarioRepository::update($funcionario);


header("location:funcionario_editar.php?id=".$funcionario->getId());
 