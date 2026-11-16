<?php
// Empréstimo feito pelo próprio cliente na biblioteca online, usando o código de acesso.
include_once("include/factory.php");

// Trava simples contra quem fica chutando códigos: 5 erros seguidos bloqueiam por 5 minutos.
if (($_SESSION['bloqueado_ate'] ?? 0) > time()) {
    redirecionar("biblioteca.php", "Muitas tentativas com código errado. Espere alguns minutos e tente de novo.", "danger");
}

$livro = LivroRepository::get(campo('livro_id'));
if (!$livro) {
    redirecionar("biblioteca.php", "Livro não encontrado.", "warning");
}

$cliente = ClienteRepository::getByCodigo(campo('codigo'));
if (!$cliente) {
    $_SESSION['tentativas'] = ($_SESSION['tentativas'] ?? 0) + 1;
    if ($_SESSION['tentativas'] >= 5) {
        $_SESSION['bloqueado_ate'] = time() + 300;
        $_SESSION['tentativas'] = 0;
    }
    redirecionar("biblioteca.php", "Código de acesso não encontrado. Confira o código que a biblioteca te passou.", "danger");
}
$_SESSION['tentativas'] = 0;

$primeiro_nome = explode(' ', $cliente->getNome())[0];

if (EmprestimoRepository::countByLivroWithNotFinished($livro->getId()) > 0) {
    redirecionar("biblioteca.php", "Poxa, " . $primeiro_nome . ": alguém acabou de pegar esse livro.", "warning");
}

if (EmprestimoRepository::countByClienteWithNotFinished($cliente->getId()) > 0) {
    redirecionar("biblioteca.php", $primeiro_nome . ", você já está com um livro. Devolva na biblioteca para pegar outro.", "warning");
}

$emprestimo = Factory::emprestimo();
$emprestimo->setLivroId($livro->getId());
$emprestimo->setClienteId($cliente->getId());
$emprestimo->setInclusaoFuncionarioId(null); // sem funcionário: foi pela biblioteca online
$emprestimo->setDataInclusao(date("Y-m-d H:i:s"));
EmprestimoRepository::insert($emprestimo);

redirecionar(
    "biblioteca.php",
    "Pronto, " . $primeiro_nome . "! \"" . $livro->getTitulo() . "\" está emprestado no seu nome até " . $emprestimo->getDataVencimento("d/m/Y") . ". Boa leitura!"
);
