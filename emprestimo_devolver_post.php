<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}
$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: emprestimo_listagem.php?1");
    exit();
}
if($_POST["id"] == '' || $_POST["id"] == null){
    header("location: emprestimo_listagem.php?2");
    exit();
}
$emprestimo = EmprestimoRepository::get($_POST["id"]);
if(!$emprestimo){
    header("location: emprestimo_listagem.php?3");
    exit();
}

$novo_emprestimo = Factory::emprestimo();



date_default_timezone_set('America/Sao_Paulo');

$emprestimo->setDataAlteracao(date('Y-m-d'));
$emprestimo->setAlteracaoFuncionarioId($user->getId());
$emprestimo->setDevolucaoFuncionarioId($user->getId());
$emprestimo->setDataDevolucao(date('Y-m-d H:i:s'));


EmprestimoRepository::update($emprestimo);

header("Location: emprestimo_listagem.php?5");