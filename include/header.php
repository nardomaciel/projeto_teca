<?php
// Topo de todas as páginas internas. Antes de incluir, defina $titulo.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($titulo ?? 'biblioTECA'); ?> · biblioTECA</title>
    <?php include(__DIR__ . "/tema.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include(__DIR__ . "/navbar.php"); ?>
<main class="container py-4 flex-grow-1">
<?php mostrar_mensagem(); ?>
