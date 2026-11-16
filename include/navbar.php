<?php
$pagina_atual = basename($_SERVER['PHP_SELF']);
$usuario_logado = Auth::getUser();

// Marca o item do menu da página aberta (ex.: livro_editar.php acende "Livros").
function menu_ativo($prefixo, $pagina_atual){
    return str_starts_with($pagina_atual, $prefixo) ? 'active' : '';
}
function item_ativo($pagina, $pagina_atual){
    return $pagina == $pagina_atual ? 'active' : '';
}

$listas_emprestimo = [
    'emprestimo_listagem.php' => 'Todos',
    'emprestimo_listagem_ativos.php' => 'Ativos',
    'emprestimo_listagem_vencidos.php' => 'Vencidos',
    'emprestimo_listagem_renovados.php' => 'Renovados',
    'emprestimo_listagem_naoRenovados.php' => 'Não renovados',
    'emprestimo_listagem_devolvidos.php' => 'Devolvidos',
];
?>
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="index.php"><i class="bi bi-book-half me-1"></i>biblioTECA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?php echo item_ativo('index.php', $pagina_atual); ?>" href="index.php">Início</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo menu_ativo('emprestimo', $pagina_atual); ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empréstimos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?php echo item_ativo('emprestimo_novo.php', $pagina_atual); ?>" href="emprestimo_novo.php"><i class="bi bi-plus-lg me-2"></i>Novo empréstimo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php foreach ($listas_emprestimo as $pagina => $rotulo): ?>
                            <li><a class="dropdown-item <?php echo item_ativo($pagina, $pagina_atual); ?>" href="<?php echo $pagina; ?>"><?php echo $rotulo; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('livro', $pagina_atual); ?>" href="livro_listagem.php">Livros</a></li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('autor', $pagina_atual); ?>" href="autor_listagem.php">Autores</a></li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('cliente', $pagina_atual); ?>" href="cliente_listagem.php">Clientes</a></li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('funcionario', $pagina_atual); ?>" href="funcionario_listagem.php">Funcionários</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2 pb-2 pb-lg-0">
                <a href="biblioteca.php" target="_blank" class="btn btn-sm btn-outline-warning" title="Abre a área pública numa nova aba"><i class="bi bi-bookshelf me-1"></i>Biblioteca online</a>
                <span class="navbar-text small me-auto me-lg-2"><i class="bi bi-person-circle me-1"></i><?php echo e($usuario_logado ? $usuario_logado->getNome() : ''); ?></span>
                <button type="button" class="btn btn-sm btn-outline-light trocar-tema" title="Trocar tema" aria-label="Trocar entre modo claro e escuro"><i class="bi bi-moon-stars"></i></button>
                <a href="logout.php" class="btn btn-sm btn-outline-light">Sair</a>
            </div>
        </div>
    </div>
</nav>
