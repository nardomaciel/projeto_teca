<?php
// O cliente digita o código e vê qual livro está com ele e até quando.
include_once("include/factory.php");

if (($_SESSION['bloqueado_ate'] ?? 0) > time()) {
    redirecionar("biblioteca.php", "Muitas tentativas com código errado. Espere alguns minutos e tente de novo.", "danger");
}

$cliente = ClienteRepository::getByCodigo(campo('codigo'));
if (!$cliente) {
    $_SESSION['tentativas'] = ($_SESSION['tentativas'] ?? 0) + 1;
    if ($_SESSION['tentativas'] >= 5) {
        $_SESSION['bloqueado_ate'] = time() + 300;
        $_SESSION['tentativas'] = 0;
    }
    redirecionar("biblioteca.php", "Código de acesso não encontrado.", "danger");
}
$_SESSION['tentativas'] = 0;

$primeiro_nome = explode(' ', $cliente->getNome())[0];

$atual = null;
foreach (EmprestimoRepository::listAtivos() as $emprestimo) {
    if ($emprestimo->getClienteId() == $cliente->getId()) {
        $atual = $emprestimo;
        break;
    }
}

if (!$atual) {
    redirecionar("biblioteca.php", "Oi, " . $primeiro_nome . "! Você não está com nenhum livro agora. Escolha um na estante.", "info");
}

$livro = LivroRepository::get($atual->getLivroId());
$atraso = dias_de_atraso($atual);

if ($atraso > 0) {
    redirecionar("biblioteca.php", $primeiro_nome . ", \"" . $livro->getTitulo() . "\" venceu em " . $atual->getDataVencimento("d/m/Y") . " (" . $atraso . " dias de atraso). Devolva na biblioteca assim que puder.", "warning");
}

redirecionar("biblioteca.php", "Oi, " . $primeiro_nome . "! Você está com \"" . $livro->getTitulo() . "\" até " . $atual->getDataVencimento("d/m/Y") . ".", "info");
