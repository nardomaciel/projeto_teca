<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}
$user = Auth::getUser();

if(!isset($_POST['id'])){
    header("location: emprestimo_listagem.php");
    exit();
}
if($_POST["id"] == '' || $_POST["id"] == null){
    header("location: emprestimo_listagem.php");
    exit();
}
$emprestimo = EmprestimoRepository::get($_POST["id"]);
if(!$emprestimo){
    header("location: emprestimo_listagem.php");
    exit();
}

if (!(
    $emprestimo->getDataRenovacao() == null &&
    $emprestimo->getDataRenovacao() == null &&
    $emprestimo->getDataAlteracao() == null
    )){
        header("location: emprestimo_listagem.php");
        exit();
    }
if ($emprestimo->getDataVencimento() < date("Y-m-d")){
    header("location: emprestimo_listagem.php");
    exit();
}
$novo_emprestimo = Factory::emprestimo();
// $datetime = DateTime::createFromFormat('d/m/Y', $_POST["data_vencimento"]);
// $dateFormatted = $datetime->format('Y-m-d');



$emprestimo->setDataRenovacao(date('Y-m-d'));
$emprestimo->setDataAlteracao(date('Y-m-d'));
$emprestimo->setAlteracaoFuncionarioId($user->getId());
$emprestimo->setRenovacaoFuncionarioId($user->getId());
$emprestimo->setDataVencimento($novo_emprestimo->getDataVencimento());


EmprestimoRepository::update($emprestimo);

header("Location: emprestimo_listagem.php");