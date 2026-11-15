<?php
include_once("include/factory.php");
$user = exigir_login();

$emprestimos = EmprestimoRepository::listAtivos();

$titulo = "Empréstimos ativos";
include("include/header.php");
include("include/emprestimo_tabela.php");
include("include/footer.php");
