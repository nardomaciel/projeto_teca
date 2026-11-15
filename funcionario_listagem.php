<?php
include_once("include/factory.php");
$user = exigir_login();

// Só dá para excluir quem nunca registrou nada no sistema (e nunca a si mesmo).
function pode_excluir_funcionario($id, $user){
    return $id != $user->getId()
        && EmprestimoRepository::countByInclusaoFuncionario($id) == 0
        && EmprestimoRepository::countByAlteracaoFuncionario($id) == 0
        && EmprestimoRepository::countByDevolucaoFuncionario($id) == 0
        && EmprestimoRepository::countByRenovacaoFuncionario($id) == 0
        && ClienteRepository::countByInclusaoFuncionario($id) == 0
        && ClienteRepository::countByAlteracaoFuncionario($id) == 0
        && AutorRepository::countByInclusaoFuncionario($id) == 0
        && AutorRepository::countByAlteracaoFuncionario($id) == 0
        && LivroRepository::countByInclusaoFuncionario($id) == 0
        && LivroRepository::countByAlteracaoFuncionario($id) == 0;
}

$titulo = "Funcionários";
include("include/header.php");
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h3 mb-0">Funcionários</h1>
    <a href="funcionario_novo.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo funcionário</a>
</div>

<div class="tabela-card">
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $funcionarios = FuncionarioRepository::listAll(); ?>
            <?php if (!$funcionarios): ?>
                <tr><td colspan="6" class="vazio"><i class="bi bi-inbox"></i>Nenhum funcionário cadastrado.</td></tr>
            <?php endif; ?>
            <?php foreach ($funcionarios as $funcionario): ?>
                <tr>
                    <td><?php echo $funcionario->getId(); ?></td>
                    <td>
                        <?php echo e($funcionario->getNome()); ?>
                        <?php if ($funcionario->getId() == $user->getId()): ?><span class="badge text-bg-secondary ms-1">você</span><?php endif; ?>
                    </td>
                    <td><?php echo e($funcionario->getTelefone()); ?></td>
                    <td><?php echo e($funcionario->getCpf()); ?></td>
                    <td><?php echo e($funcionario->getEmail()); ?></td>
                    <td class="acoes">
                        <a href="funcionario_editar.php?id=<?php echo $funcionario->getId(); ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                        <?php if (pode_excluir_funcionario($funcionario->getId(), $user)): ?>
                            <a href="funcionario_excluir.php?id=<?php echo $funcionario->getId(); ?>" class="btn btn-sm btn-outline-danger" data-confirmar="Excluir o funcionário <?php echo e($funcionario->getNome()); ?>?">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<?php include("include/footer.php"); ?>
