<?php
include_once('include/factory.php');

if (!Auth::isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUser();

if(!isset($_GET['id'])){
    header("location: autor_listagem.php?1");
    exit();
}
if($_GET["id"] == "" || $_GET["id"] == NULL){
    header("location: autor_listagem.php?2");
    exit();
}
$autor = AutorRepository::get($_GET["id"]);
if(!$autor){
    header("location: autor_listagem.php?3");
    exit();
}


AutorRepository::delete($autor->getId());
header("location:autor_listagem.php");