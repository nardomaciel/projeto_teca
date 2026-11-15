<?php
$pagina_atual = basename($_SERVER['PHP_SELF']);
$usuario_logado = Auth::getUser();

function menu_ativo($prefixo, $pagina_atual){
    return str_starts_with($pagina_atual, $prefixo) ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="index.php"><i class="bi bi-book-half me-1"></i>biblioTECA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo menu_ativo('emprestimo', $pagina_atual); ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empréstimos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="emprestimo_novo.php">Novo empréstimo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="emprestimo_listagem.php">Todos</a></li>
                        <li><a class="dropdown-item" href="emprestimo_listagem_ativos.php">Ativos</a></li>
                        <li><a class="dropdown-item" href="emprestimo_listagem_vencidos.php">Vencidos</a></li>
                        <li><a class="dropdown-item" href="emprestimo_listagem_renovados.php">Renovados</a></li>
                        <li><a class="dropdown-item" href="emprestimo_listagem_naoRenovados.php">Não renovados</a></li>
                        <li><a class="dropdown-item" href="emprestimo_listagem_devolvidos.php">Devolvidos</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('livro', $pagina_atual); ?>" href="livro_listagem.php">Livros</a></li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('autor', $pagina_atual); ?>" href="autor_listagem.php">Autores</a></li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('cliente', $pagina_atual); ?>" href="cliente_listagem.php">Clientes</a></li>
                <li class="nav-item"><a class="nav-link <?php echo menu_ativo('funcionario', $pagina_atual); ?>" href="funcionario_listagem.php">Funcionários</a></li>
            </ul>
            <span class="navbar-text me-3 small"><i class="bi bi-person-circle me-1"></i><?php echo e($usuario_logado ? $usuario_logado->getNome() : ''); ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
    </div>
</nav>
