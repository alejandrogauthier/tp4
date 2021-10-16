<?php 
    $usuario = '';
    $clave = '';
    $errors = [];
    if($_POST)
    {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        if($usuario == '' || $clave == '')
        {
            $errors[] = 'Usuario o clave vacia';        
        }
        if()
        {
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>TP 4</title>
</head>
<body>
    <div>
        <h1 class="text-center my-5">
            Bienvenido
        </h1>
        <form action="index.php" method="POST" class="col-4 mx-auto">
            <div class="row mb-3">
                <label for="usuario" class="form-label col-sm-3">Usuario</label>
                <div class="col-sm-9">
                    <input type="text" name="usuario" class="form-control" id="usuario" value="<?= $usuario?>">
                </div>
               
            </div>
           <div class="row mb-4">
                <label for="clave" class="form-label col-sm-3">Contraseña</label>
                <div class="col-sm-9">
                    <input type="password" name="clave" class="form-control mb-4" id="clave">
                    <button class="btn btn-success w-100">
                        LOGEARSE
                    </button>
                </div>
            </div> 
            <?php if(count($errors)) : ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error)
                    {
                        echo $error;
                    }
                    ?>
                </div>
            <?php endif; ?>         
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>