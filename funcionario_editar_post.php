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

if(!isset($_POST['nome'])){
    header("Location: funcionario_novo.php?id=".$funcionario->getId());
    exit();
}
if($_POST["nome" ] == '' || $_POST["nome"] == null){
    header("Location: funcionario_novo.php?id=".$funcionario->getId());
    exit();
}

date_default_timezone_set('America/Sao_Paulo');

$funcionario->setNome($_POST['nome']);
$funcionario->setCpf($_POST['cpf']);
$funcionario->setTelefone($_POST['telefone']);
$funcionario->setEmail($_POST['email']);
$funcionario->setInclusaoFuncionarioId($user->getID());
$funcionario->setDataInclusao(date('Y-d-m H:i:s'));

FuncionarioRepository::update($funcionario);


header("location:funcionario_editar.php?id=".$funcionario->getId());
 