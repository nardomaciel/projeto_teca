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
  <title>AUTOR LISTAGEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style> 
    #titAndButton{
        display: flex;
        align-items: right;
        justify-content: space-between;
       
       

    }
  
   
  </style>
</head>
<body>
    <?php include("include/navbar.php"); ?>

  <div class="container">
    <div >
        <h2 >AUTORES < LISTAGEM</h2>
         <a href="autor_novo.php" type="submit" class="btn btn-success" >NOVO AUTOR</a>
         <a href="index.php" class="btn btn-warning">VOLTAR</a>
       
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <?php 
                foreach(AutorRepository::listAll() as $autor){
            ?>
              <tr>
                    <td><?php echo $autor->getId(); ?></td>
                    <td><?php echo $autor->getNome(); ?></td>
                    
                <div>
                    <td>
                    <a href=" autor_editar.php?id=<?php echo $autor->getId();?>" type="button" class="btn btn-primary">EDITAR</a>

                    <?php if(LivroRepository::countByAutor($autor->getId())== 0){?>

                    <a href="autor_excluir.php?id=<?php echo $autor->getId();?>" type="button" class="btn btn-danger">DELETAR</a>
                    
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