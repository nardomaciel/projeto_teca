<?php
include_once('include/factory.php');
$user = exigir_login();

$autor = AutorRepository::get($_POST["id"] ?? 0);
if (!$autor) {
    redirecionar("autor_listagem.php", "Autor não encontrado.", "warning");
}

if (campo('nome') == '') {
    redirecionar("autor_editar.php?id=" . $autor->getId(), "Informe o nome do autor.", "danger");
}

$autor->setNome(campo('nome'));
$autor->setAlteracaoFuncionarioId($user->getId());
$autor->setDataAlteracao(date('Y-m-d H:i:s'));

AutorRepository::update($autor);

redirecionar("autor_listagem.php", "Autor atualizado.");
