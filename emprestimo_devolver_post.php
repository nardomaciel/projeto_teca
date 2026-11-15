<?php
include_once('include/factory.php');
$user = exigir_login();

$emprestimo = EmprestimoRepository::get($_POST["id"] ?? 0);
if (!$emprestimo) {
    redirecionar("emprestimo_listagem.php", "Empréstimo não encontrado.", "warning");
}

if ($emprestimo->getDataDevolucao() != null) {
    redirecionar("emprestimo_listagem.php", "Esse livro já foi devolvido.", "warning");
}

$emprestimo->setDataAlteracao(date('Y-m-d H:i:s'));
$emprestimo->setAlteracaoFuncionarioId($user->getId());
$emprestimo->setDevolucaoFuncionarioId($user->getId());
$emprestimo->setDataDevolucao(date('Y-m-d H:i:s'));

EmprestimoRepository::update($emprestimo);

redirecionar("emprestimo_listagem_devolvidos.php", "Devolução registrada.");
