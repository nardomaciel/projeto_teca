<?php
// Funções pequenas usadas em várias páginas.

// Escapa o texto antes de mostrar na tela.
function e($valor){
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

// Exige login. Vai no topo de toda página interna.
function exigir_login(){
    if (!Auth::isAuthenticated()) {
        header("Location: login.php");
        exit();
    }
    return Auth::getUser();
}

// Redireciona com uma mensagem que aparece na próxima página.
function redirecionar($pagina, $mensagem = null, $tipo = 'success'){
    if ($mensagem) {
        $_SESSION['mensagem'] = ['texto' => $mensagem, 'tipo' => $tipo];
    }
    header("Location: " . $pagina);
    exit();
}

// Mostra (e apaga) a mensagem guardada por redirecionar().
function mostrar_mensagem(){
    if (empty($_SESSION['mensagem'])) {
        return;
    }
    $m = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
    echo '<div class="alert alert-' . e($m['tipo']) . ' alert-dismissible fade show" role="alert">'
        . e($m['texto'])
        . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button></div>';
}

// Lê um campo do POST já sem espaços nas pontas.
function campo($nome){
    return trim($_POST[$nome] ?? '');
}

// Converte dd/mm/aaaa para aaaa-mm-dd. Devolve null se a data for inválida.
function data_para_banco($data){
    $datetime = DateTime::createFromFormat('!d/m/Y', $data);
    if (!$datetime || $datetime->format('d/m/Y') !== $data) {
        return null;
    }
    return $datetime->format('Y-m-d');
}

// Converte uma data do banco para dd/mm/aaaa.
function data_br($data){
    if (!$data) {
        return '';
    }
    return date('d/m/Y', strtotime($data));
}

// Dias de atraso de um empréstimo, contando até hoje (ou até a devolução).
function dias_de_atraso($emprestimo){
    $fim = $emprestimo->getDataDevolucao() ? substr($emprestimo->getDataDevolucao(), 0, 10) : date('Y-m-d');
    $vencimento = $emprestimo->getDataVencimento();
    if ($fim <= $vencimento) {
        return 0;
    }
    return (int) (new DateTime($vencimento))->diff(new DateTime($fim))->days;
}
