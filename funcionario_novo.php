<?php
include_once("include/factory.php");
$user = exigir_login();

$titulo = "Novo funcionário";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Novo funcionário</h1>
        <a href="funcionario_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="funcionario_novo_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome completo" required maxlength="200" autofocus>
                </div>
                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control mask-cpf" placeholder="000.000.000-00" required>
                    <div class="form-text">É usado para entrar no sistema.</div>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control mask-telefone" placeholder="(00) 00000-0000" required>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="nome@email.com" required maxlength="200">
                </div>
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required minlength="6" maxlength="100" autocomplete="new-password">
                </div>
                <div class="col-md-6">
                    <label for="repSenha" class="form-label">Confirmar senha</label>
                    <input type="password" name="repSenha" id="repSenha" class="form-control" required autocomplete="new-password">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
