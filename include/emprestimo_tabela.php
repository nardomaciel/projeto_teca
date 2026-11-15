<?php
// Tabela de empréstimos usada por todas as listagens.
// Antes de incluir, defina $emprestimos (lista) e $titulo.
$hoje = date('Y-m-d');
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0"><?php echo e($titulo); ?></h1>
    <a href="emprestimo_novo.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo empréstimo</a>
</div>

<ul class="nav nav-pills filtros mb-3 small">
    <?php
    $filtros = [
        'emprestimo_listagem.php' => 'Todos',
        'emprestimo_listagem_ativos.php' => 'Ativos',
        'emprestimo_listagem_vencidos.php' => 'Vencidos',
        'emprestimo_listagem_renovados.php' => 'Renovados',
        'emprestimo_listagem_naoRenovados.php' => 'Não renovados',
        'emprestimo_listagem_devolvidos.php' => 'Devolvidos',
    ];
    foreach ($filtros as $pagina => $rotulo): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == $pagina ? 'active' : ''; ?>" href="<?php echo $pagina; ?>"><?php echo $rotulo; ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<?php if (!$emprestimos): ?>
    <div class="tabela-card">
        <div class="vazio"><i class="bi bi-inbox"></i>Nenhum empréstimo nesta lista.</div>
    </div>
<?php else: ?>
<div class="tabela-card">
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Livro</th>
                <th>Cliente</th>
                <th>Vencimento</th>
                <th>Situação</th>
                <th class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emprestimos as $emprestimo):
                $livro = LivroRepository::get($emprestimo->getLivroId());
                $cliente = ClienteRepository::get($emprestimo->getClienteId());
                $devolvido = $emprestimo->getDataDevolucao() != null;
                $renovado = $emprestimo->getDataRenovacao() != null;
                $vencido = !$devolvido && $emprestimo->getDataVencimento() < $hoje;
                ?>
                <tr>
                    <td><?php echo $emprestimo->getId(); ?></td>
                    <td><?php echo e($livro ? $livro->getTitulo() : ''); ?></td>
                    <td><?php echo e($cliente ? $cliente->getNome() : ''); ?></td>
                    <td><?php echo $emprestimo->getDataVencimento('d/m/Y'); ?></td>
                    <td>
                        <?php if ($devolvido): ?>
                            <span class="badge text-bg-secondary">Devolvido em <?php echo $emprestimo->getDataDevolucao('d/m/Y'); ?></span>
                        <?php elseif ($vencido): ?>
                            <span class="badge text-bg-danger">Vencido há <?php echo dias_de_atraso($emprestimo); ?> dias</span>
                        <?php elseif ($renovado): ?>
                            <span class="badge text-bg-warning">Renovado</span>
                        <?php else: ?>
                            <span class="badge text-bg-success">No prazo</span>
                        <?php endif; ?>
                    </td>
                    <td class="acoes">
                        <?php if (!$devolvido): ?>
                            <a href="emprestimo_devolver.php?id=<?php echo $emprestimo->getId(); ?>" class="btn btn-sm btn-outline-primary">Devolver</a>
                        <?php endif; ?>
                        <?php if (!$devolvido && !$renovado && !$vencido): ?>
                            <a href="emprestimo_renovar.php?id=<?php echo $emprestimo->getId(); ?>" class="btn btn-sm btn-outline-secondary">Renovar</a>
                        <?php endif; ?>
                        <?php if (!$devolvido && !$renovado && $emprestimo->getDataAlteracao() == null): ?>
                            <a href="emprestimo_excluir.php?id=<?php echo $emprestimo->getId(); ?>" class="btn btn-sm btn-outline-danger" data-confirmar="Excluir este empréstimo?">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<?php endif; ?>
