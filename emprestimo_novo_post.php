<?php
include_once("include/factory.php");
$user = exigir_login();

$livro_id = campo("livro_id");
$cliente_id = campo("cliente_id");

if ($livro_id == "" || $cliente_id == "") {
    redirecionar("emprestimo_novo.php", "Escolha o livro e o cliente.", "danger");
}

if (!LivroRepository::get($livro_id) || !ClienteRepository::get($cliente_id)) {
    redirecionar("emprestimo_novo.php", "Livro ou cliente não encontrado.", "danger");
}

if (EmprestimoRepository::countByLivroWithNotFinished($livro_id) > 0) {
    redirecionar("emprestimo_novo.php", "Esse livro já está emprestado.", "danger");
}

if (EmprestimoRepository::countByClienteWithNotFinished($cliente_id) > 0) {
    redirecionar("emprestimo_novo.php", "Esse cliente ainda não devolveu o último livro.", "danger");
}

$emprestimo = Factory::emprestimo();
$emprestimo->setLivroId($livro_id);
$emprestimo->setClienteId($cliente_id);
$emprestimo->setInclusaoFuncionarioId($user->getId());
$emprestimo->setDataInclusao(date("Y-m-d H:i:s"));

EmprestimoRepository::insert($emprestimo);

redirecionar("emprestimo_listagem_ativos.php", "Empréstimo registrado. Devolução até " . $emprestimo->getDataVencimento("d/m/Y") . ".");
