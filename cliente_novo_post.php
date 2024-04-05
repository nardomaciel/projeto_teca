<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_POST['nome'])){
    echo('viado');
    header("Location: cliente_novo.php");
    exit();
}
if($_POST["nome"] == '' || $_POST["nome" ] == null){
    echo('vagabunda');
    header("Location: cliente_novo.php");
    exit();
}
$datetime=  DateTime::createFromFormat('d/m/Y', $_POST['data_nascimento']);
$dateFormatted =  $datetime->format('Y-m-d');
$cliente = Factory::cliente();

$cliente->setNome($_POST['nome']);
$cliente->setTelefone($_POST['telefone']);
$cliente->setEmail($_POST['email']);
$cliente->setCpf($_POST['cpf']);
$cliente->setRg($_POST['rg']);
$cliente->setDataNascimento($dateFormatted);
$cliente->setInclusaoFuncionarioId($user->getID());
$cliente->setDataInclusao(date('Y-d-m h:i:s'));

$cliente_retorno = ClienteRepository::insert($cliente);

if($cliente_retorno > 0){
    header("Location: cliente_editar.php?id=".$cliente_retorno);
    exit();
}

header("Location: cliente_novo.php");
 exit();