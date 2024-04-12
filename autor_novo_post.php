<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['nome'])){
    header("Location: autor_novo.php?2");
    exit();
}
if($_POST["nome"] == '' || $_POST["nome"] == null){
    header("Location: autor_novo.php?3");
    exit();
}

$autor = Factory::autor();
date_default_timezone_set('America/Sao_Paulo');
$autor->setNome($_POST['nome']);
$autor->setInclusaoFuncionarioId($user->getID());
$autor->setDataInclusao(date('Y-d-m H:i:s'));

$autor_retorno = AutorRepository::insert($autor);

if($autor_retorno > 0){
    header("Location: autor_editar.php?4id=".$autor_retorno);
    exit();
}

header("Location: autor_novo.php");
 exit();