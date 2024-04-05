<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_GET['id'])){
    header("location: cliente_listagem.php?1");
    exit();
}
if($_GET["id"] == '' || $_GET["id"] == NULL){
    header("location: cliente_listagem.php?2");
    exit();
}
$cliente = ClienteRepository::get($_GET["id"]);
if(!$cliente){
    header("location: cliente_listagem.php?3");
    exit();
}


ClienteRepository::delete($cliente->getId());
header("location:cliente_listagem.php");