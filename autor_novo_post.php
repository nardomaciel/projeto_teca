<?php
include_once('include/factory.php');
$user = exigir_login();

if (campo('nome') == '') {
    redirecionar("autor_novo.php", "Informe o nome do autor.", "danger");
}

$autor = Factory::autor();
$autor->setNome(campo('nome'));
$autor->setInclusaoFuncionarioId($user->getId());
$autor->setDataInclusao(date('Y-m-d H:i:s'));

AutorRepository::insert($autor);

redirecionar("autor_listagem.php", "Autor cadastrado.");
