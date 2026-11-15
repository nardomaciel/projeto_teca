<?php
include_once('include/factory.php');
$user = exigir_login();

$funcionario = FuncionarioRepository::get($_POST["id"] ?? 0);
if (!$funcionario) {
    redirecionar("funcionario_listagem.php", "Funcionário não encontrado.", "warning");
}

$voltar = "funcionario_editar.php?id=" . $funcionario->getId();

if (campo('nome') == '' || campo('cpf') == '' || campo('email') == '') {
    redirecionar($voltar, "Preencha nome, CPF e e-mail.", "danger");
}

$outro = FuncionarioRepository::getByCPF(campo('cpf'));
if ($outro && $outro->getId() != $funcionario->getId()) {
    redirecionar($voltar, "Já existe outro funcionário com esse CPF.", "danger");
}

$funcionario->setNome(campo('nome'));
$funcionario->setCpf(campo('cpf'));
$funcionario->setTelefone(campo('telefone'));
$funcionario->setEmail(campo('email'));
$funcionario->setAlteracaoFuncionarioId($user->getId());
$funcionario->setDataAlteracao(date('Y-m-d H:i:s'));

FuncionarioRepository::update($funcionario);

redirecionar("funcionario_listagem.php", "Funcionário atualizado.");
