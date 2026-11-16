<?php
include_once('include/factory.php');
$user = exigir_login();

// Gera um código de acesso novo para o cliente (o antigo para de funcionar).
$cliente = ClienteRepository::get($_GET["id"] ?? 0);
if (!$cliente) {
    redirecionar("cliente_listagem.php", "Cliente não encontrado.", "warning");
}

$cliente->setCodigoAcesso(gerar_codigo_acesso());
$cliente->setAlteracaoFuncionarioId($user->getId());
$cliente->setDataAlteracao(date('Y-m-d H:i:s'));
ClienteRepository::update($cliente);

redirecionar("cliente_listagem.php", "Novo código de " . $cliente->getNome() . ": " . $cliente->getCodigoAcesso());
