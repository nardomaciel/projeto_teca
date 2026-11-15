<?php
include_once("include/factory.php");
$user = exigir_login();

$emprestimos = EmprestimoRepository::listaNaoRenovados();

$titulo = "Empréstimos não renovados";
include("include/header.php");
include("include/emprestimo_tabela.php");
include("include/footer.php");
