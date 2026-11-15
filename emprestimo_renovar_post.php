<?php
include_once('include/factory.php');
$user = exigir_login();

$emprestimo = EmprestimoRepository::get($_POST["id"] ?? 0);
if (!$emprestimo) {
    redirecionar("emprestimo_listagem.php", "Empréstimo não encontrado.", "warning");
}

// Só renova uma vez, se ainda não foi devolvido e se não está vencido.
if ($emprestimo->getDataDevolucao() != null) {
    redirecionar("emprestimo_listagem.php", "Esse livro já foi devolvido.", "danger");
}
if ($emprestimo->getDataRenovacao() != null) {
    redirecionar("emprestimo_listagem.php", "Esse empréstimo já foi renovado uma vez.", "danger");
}
if ($emprestimo->getDataVencimento() < date("Y-m-d")) {
    redirecionar("emprestimo_listagem.php", "Empréstimo vencido não pode ser renovado. Registre a devolução.", "danger");
}

$novo_emprestimo = Factory::emprestimo();

$emprestimo->setDataRenovacao(date('Y-m-d'));
$emprestimo->setDataAlteracao(date('Y-m-d H:i:s'));
$emprestimo->setAlteracaoFuncionarioId($user->getId());
$emprestimo->setRenovacaoFuncionarioId($user->getId());
$emprestimo->setDataVencimento($novo_emprestimo->getDataVencimento());

EmprestimoRepository::update($emprestimo);

redirecionar("emprestimo_listagem.php", "Empréstimo renovado até " . $emprestimo->getDataVencimento("d/m/Y") . ".");
