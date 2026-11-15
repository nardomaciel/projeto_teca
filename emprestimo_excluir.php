<?php
include_once('include/factory.php');
$user = exigir_login();

$emprestimo = EmprestimoRepository::get($_GET["id"] ?? 0);
if (!$emprestimo) {
    redirecionar("emprestimo_listagem.php", "Empréstimo não encontrado.", "warning");
}

// Excluir serve só para corrigir um lançamento errado, antes de qualquer movimento.
if ($emprestimo->getDataDevolucao() != null
    || $emprestimo->getDataRenovacao() != null
    || $emprestimo->getDataAlteracao() != null) {
    redirecionar("emprestimo_listagem.php", "Só dá para excluir um empréstimo que ainda não teve renovação nem devolução.", "danger");
}

EmprestimoRepository::delete($emprestimo->getId());

redirecionar("emprestimo_listagem.php", "Empréstimo excluído.");
