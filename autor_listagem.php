<?php
include_once("include/factory.php");
$user = exigir_login();

$titulo = "Autores";
include("include/header.php");
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Autores</h1>
    <a href="autor_novo.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo autor</a>
</div>

<div class="tabela-card">
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $autores = AutorRepository::listAll(); ?>
            <?php if (!$autores): ?>
                <tr><td colspan="3" class="vazio"><i class="bi bi-inbox"></i>Nenhum autor cadastrado ainda.</td></tr>
            <?php endif; ?>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?php echo $autor->getId(); ?></td>
                    <td><?php echo e($autor->getNome()); ?></td>
                    <td class="acoes">
                        <a href="autor_editar.php?id=<?php echo $autor->getId(); ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                        <?php if (LivroRepository::countByAutor($autor->getId()) == 0): ?>
                            <a href="autor_excluir.php?id=<?php echo $autor->getId(); ?>" class="btn btn-sm btn-outline-danger" data-confirmar="Excluir o autor <?php echo e($autor->getNome()); ?>?">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<?php include("include/footer.php"); ?>
