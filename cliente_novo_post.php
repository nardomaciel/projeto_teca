<?php
include_once('include/factory.php');
$user = exigir_login();

if (campo('nome') == '' || campo('cpf') == '' || campo('email') == '') {
    redirecionar("cliente_novo.php", "Preencha nome, CPF e e-mail.", "danger");
}

$data_nascimento = data_para_banco(campo('data_nascimento'));
if (!$data_nascimento) {
    redirecionar("cliente_novo.php", "Data de nascimento inválida. Use dd/mm/aaaa.", "danger");
}

$cliente = Factory::cliente();
$cliente->setNome(campo('nome'));
$cliente->setTelefone(campo('telefone'));
$cliente->setEmail(campo('email'));
$cliente->setCpf(campo('cpf'));
$cliente->setRg(campo('rg'));
$cliente->setDataNascimento($data_nascimento);
$cliente->setInclusaoFuncionarioId($user->getId());
$cliente->setDataInclusao(date('Y-m-d H:i:s'));

ClienteRepository::insert($cliente);

redirecionar("cliente_listagem.php", "Cliente cadastrado.");
