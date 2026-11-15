<?php
include_once('include/factory.php');
$user = exigir_login();

$funcionario = FuncionarioRepository::get($_POST["id"] ?? 0);
if (!$funcionario) {
    redirecionar("funcionario_listagem.php", "Funcionário não encontrado.", "warning");
}

$voltar = "funcionario_editar_senha.php?id=" . $funcionario->getId();

if (($_POST['senha'] ?? '') == '') {
    redirecionar($voltar, "Digite a nova senha.", "danger");
}
if ($_POST['senha'] != ($_POST['repSenha'] ?? '')) {
    redirecionar($voltar, "As senhas não conferem.", "danger");
}

$funcionario->setSenha($_POST['senha']);
$funcionario->setAlteracaoFuncionarioId($user->getId());
$funcionario->setDataAlteracao(date('Y-m-d H:i:s'));

FuncionarioRepository::update($funcionario);

redirecionar("funcionario_editar.php?id=" . $funcionario->getId(), "Senha alterada.");
