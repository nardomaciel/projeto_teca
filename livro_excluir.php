<?php
include_once('include/factory.php');
$user = exigir_login();

$livro = LivroRepository::get($_GET["id"] ?? 0);
if (!$livro) {
    redirecionar("livro_listagem.php", "Livro não encontrado.", "warning");
}

if (EmprestimoRepository::countByLivros($livro->getId()) > 0) {
    redirecionar("livro_listagem.php", "Esse livro tem empréstimos registrados e não pode ser excluído.", "danger");
}

LivroRepository::delete($livro->getId());

redirecionar("livro_listagem.php", "Livro excluído.");
