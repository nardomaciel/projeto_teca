<?php
include_once('include/factory.php');
$user = exigir_login();

$autor = AutorRepository::get($_GET["id"] ?? 0);
if (!$autor) {
    redirecionar("autor_listagem.php", "Autor não encontrado.", "warning");
}

if (LivroRepository::countByAutor($autor->getId()) > 0) {
    redirecionar("autor_listagem.php", "Esse autor tem livros cadastrados e não pode ser excluído.", "danger");
}

AutorRepository::delete($autor->getId());

redirecionar("autor_listagem.php", "Autor excluído.");
