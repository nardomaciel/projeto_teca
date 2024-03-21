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
  <title>NOVO AUTOR</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #titAndButton{
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
        text-decoration: none;
    }
  </style>
</head>
<body>
    <?php include("include/navbar.php"); ?>

  <div class="container">
    <div id="titAndButton">
        <h2>AUTORES</h2>
        <button  type="submit" class="btn btn-success"  ><a id="titAndButton"href="autor_novo.php">NOVO AUTOR</a></button>
       
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
                    <br>
                <div>
                    <td>
                    <a href=" autor_editar.php?id=<?php echo $autor->getId();?>" type="button" class="btn btn-primary">EDITAR</a>
                    <a type="button" class="btn btn-danger">DELETAR</a>
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