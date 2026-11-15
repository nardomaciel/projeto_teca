<?php
include_once('include/factory.php');
$user = exigir_login();

$cliente = ClienteRepository::get($_GET["id"] ?? 0);
if (!$cliente) {
    redirecionar("cliente_listagem.php", "Cliente não encontrado.", "warning");
}

if (EmprestimoRepository::countByClientes($cliente->getId()) > 0) {
    redirecionar("cliente_listagem.php", "Esse cliente tem empréstimos registrados e não pode ser excluído.", "danger");
}

ClienteRepository::delete($cliente->getId());

redirecionar("cliente_listagem.php", "Cliente excluído.");
