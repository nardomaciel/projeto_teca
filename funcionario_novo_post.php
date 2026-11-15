<?php
include_once('include/factory.php');
$user = exigir_login();

if (campo('nome') == '' || campo('cpf') == '' || campo('email') == '') {
    redirecionar("funcionario_novo.php", "Preencha nome, CPF e e-mail.", "danger");
}

if (($_POST['senha'] ?? '') == '' || $_POST['senha'] != ($_POST['repSenha'] ?? '')) {
    redirecionar("funcionario_novo.php", "As senhas estão vazias ou não conferem.", "danger");
}

if (FuncionarioRepository::getByCPF(campo('cpf'))) {
    redirecionar("funcionario_novo.php", "Já existe um funcionário com esse CPF.", "danger");
}

$funcionario = Factory::funcionario();
$funcionario->setNome(campo('nome'));
$funcionario->setCpf(campo('cpf'));
$funcionario->setTelefone(campo('telefone'));
$funcionario->setSenha($_POST['senha']);
$funcionario->setEmail(campo('email'));
$funcionario->setInclusaoFuncionarioId($user->getId());
$funcionario->setDataInclusao(date('Y-m-d H:i:s'));

FuncionarioRepository::insert($funcionario);

redirecionar("funcionario_listagem.php", "Funcionário cadastrado.");
