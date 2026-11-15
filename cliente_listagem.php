<?php
include_once("include/factory.php");
$user = exigir_login();

$titulo = "Clientes";
include("include/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Clientes</h1>
    <a href="cliente_novo.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo cliente</a>
</div>

<div class="tabela-card table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Nascimento</th>
                <th class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (ClienteRepository::listAll() as $cliente): ?>
                <tr>
                    <td><?php echo $cliente->getId(); ?></td>
                    <td><?php echo e($cliente->getNome()); ?></td>
                    <td><?php echo e($cliente->getTelefone()); ?></td>
                    <td><?php echo e($cliente->getEmail()); ?></td>
                    <td><?php echo e($cliente->getCpf()); ?></td>
                    <td><?php echo e($cliente->getRg()); ?></td>
                    <td><?php echo e($cliente->getDataNascimento('d/m/Y')); ?></td>
                    <td class="acoes">
                        <a href="cliente_editar.php?id=<?php echo $cliente->getId(); ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                        <?php if (EmprestimoRepository::countByClientes($cliente->getId()) == 0): ?>
                            <a href="cliente_excluir.php?id=<?php echo $cliente->getId(); ?>" class="btn btn-sm btn-outline-danger" data-confirmar="Excluir o cliente <?php echo e($cliente->getNome()); ?>?">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("include/footer.php"); ?>
