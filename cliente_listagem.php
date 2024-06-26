<?php
include_once("include/factory.php");
if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CLIENTE LISTAGEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #titAndButton{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
  </style>
</head>
<body>
    <?php include("include/navbar.php"); ?>

  <div class="container">
    <div id="titAndButton">
        <h2>CLIENTES < LISTAGEM</h2>
        <a href="cliente_novo.php" class="btn btn-success">NOVO CLIENTE</a>
        <a href="index.php" class="btn btn-warning">VOLTAR</a>
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Cpf</th>
            <th>Rg</th>
            <th>Data de nascimento</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php 
                
                foreach(ClienteRepository::listAll() as $cliente){
                   
            ?>
              <tr>
                    <td><?php echo $cliente->getId(); ?></td>
                    <td><?php echo $cliente->getNome(); ?></td>
                    <td><?php echo $cliente->getTelefone(); ?></td>
                    <td><?php echo $cliente->getEmail(); ?></td>
                    <td><?php echo $cliente->getCpf(); ?></td>
                    <td><?php echo $cliente->getRg(); ?></td>
                    <td><?php echo $cliente->getDataNascimento('d/m/Y'); ?></td>
                    
                <div  id="titAndButton">
                    <td>
                    <a href="cliente_editar.php?id=<?php echo $cliente->getId();?>" type="button" class="btn btn-primary">EDITAR</a>

                    <?php if(EmprestimoRepository::countByClientes($cliente->getId())== 0){?>
                      
                    <a href="cliente_excluir.php?id=<?php echo $cliente->getId();?>" type="button" class="btn btn-danger">DELETAR</a>
                    
                    <?php } ?>
                    </td>
                </div>
                </tr>
            <?php
                }
            ?>
        
           
        
            
    
          
        
        </tbody>
      </table>
     
    </div>
  </div>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
</body>
</html>