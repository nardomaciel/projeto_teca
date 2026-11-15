<?php
include_once('include/factory.php');
$user = exigir_login();

$cliente = ClienteRepository::get($_POST["id"] ?? 0);
if (!$cliente) {
    redirecionar("cliente_listagem.php", "Cliente não encontrado.", "warning");
}

$voltar = "cliente_editar.php?id=" . $cliente->getId();

if (campo('nome') == '' || campo('cpf') == '' || campo('email') == '') {
    redirecionar($voltar, "Preencha nome, CPF e e-mail.", "danger");
}

$data_nascimento = data_para_banco(campo('data_nascimento'));
if (!$data_nascimento) {
    redirecionar($voltar, "Data de nascimento inválida. Use dd/mm/aaaa.", "danger");
}

$cliente->setNome(campo('nome'));
$cliente->setTelefone(campo('telefone'));
$cliente->setEmail(campo('email'));
$cliente->setCpf(campo('cpf'));
$cliente->setRg(campo('rg'));
$cliente->setDataNascimento($data_nascimento);
$cliente->setAlteracaoFuncionarioId($user->getId());
$cliente->setDataAlteracao(date('Y-m-d H:i:s'));

ClienteRepository::update($cliente);

redirecionar("cliente_listagem.php", "Cliente atualizado.");
