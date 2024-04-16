<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_GET['id'])){
    header("location: emprestimo_listagem.php");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == null){
    header("location: emprestimo_listagem.php");
    exit();
}
$emprestimo = EmprestimoRepository::get($_GET["id"]);
if(!$emprestimo){
    header("location: emprestimo_listagem.php");
    exit();
}

if(EmprestimoRepository::countByDataDevolucao($_GET["id"]) > 0){
    header("location: emprestimo_listagem.php");
    exit(); 
}
if(EmprestimoRepository::countByDataRenovacao($_GET["id"]) > 0){
    header("location: emprestimo_listagem.php");
    exit(); 
}
if(EmprestimoRepository::countByDataAlteracao($_GET["id"]) > 0){
    header("location: emprestimo_listagem.php");
    exit(); 
}


EmprestimoRepository::delete($emprestimo->getId());

header("Location: emprestimo_listagem.php");