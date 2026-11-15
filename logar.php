<?php
include_once('include/factory.php');

$cpf = campo("cpf");
$senha = $_POST["senha"] ?? '';

if ($cpf == "" || $senha == "") {
    header("Location: login.php");
    exit();
}

$auth = Auth::login($cpf, $senha);
if (Auth::isAuthenticated()) {
    header("Location: index.php");
    exit();
}

header("Location: login.php?message=" . urlencode($auth));
exit();
