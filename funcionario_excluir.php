<?php
include_once('include/factory.php');
$user = exigir_login();

$funcionario = FuncionarioRepository::get($_GET["id"] ?? 0);
if (!$funcionario) {
    redirecionar("funcionario_listagem.php", "Funcionário não encontrado.", "warning");
}

$id = $funcionario->getId();

if ($id == $user->getId()) {
    redirecionar("funcionario_listagem.php", "Você não pode excluir o seu próprio acesso.", "danger");
}

$tem_registros = EmprestimoRepository::countByInclusaoFuncionario($id) > 0
    || EmprestimoRepository::countByAlteracaoFuncionario($id) > 0
    || EmprestimoRepository::countByDevolucaoFuncionario($id) > 0
    || EmprestimoRepository::countByRenovacaoFuncionario($id) > 0
    || ClienteRepository::countByInclusaoFuncionario($id) > 0
    || ClienteRepository::countByAlteracaoFuncionario($id) > 0
    || AutorRepository::countByInclusaoFuncionario($id) > 0
    || AutorRepository::countByAlteracaoFuncionario($id) > 0
    || LivroRepository::countByInclusaoFuncionario($id) > 0
    || LivroRepository::countByAlteracaoFuncionario($id) > 0;

if ($tem_registros) {
    redirecionar("funcionario_listagem.php", "Esse funcionário já registrou movimentações e não pode ser excluído.", "danger");
}

FuncionarioRepository::delete($id);

redirecionar("funcionario_listagem.php", "Funcionário excluído.");
