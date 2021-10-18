<?php 
    session_start();
    require('./clases/usuario.php');
    require('./clases/auto.php');
    $autos = [];
    $usuario = $_SESSION['usuario'];
    $usuario = new Usuario($usuario['id'],$usuario['usuario'], $usuario['clave'],$usuario['nombre'],$usuario['apellido'],$usuario['superadmin']);
    if($_POST)
    {
        if($POST[''] == "crear")
        {

        }
        if($POST[''] == "editar")
        {
            
        }
        if($POST[''] == "eliminar")
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>TP 4</title>
</head>
<body>
    <div class="col-10 mx-auto"> 
        <h1 class="text-uppercase text-center mt-4">
            sistema de ventas automotriz
        </h1>
        <table class="table table-dark table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <?php if($usuario->getSuperadmin()) : ?>
                            <th scope="col">Nombre</th>
                        <?php endif;?>
                        <?php if($usuario->getSuperadmin()) : ?>
                            <th scope="col">Apellido</th>
                        <?php endif;?>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Precio</th>
                        <?php if($usuario->getSuperadmin()) : ?>
                        <th scope="col" style="text-align:center !important;">Acciones</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>  
                    <?php if(count($autos)) :?>
                        <?php foreach($autos as $auto) :?>               
                            <th scope="row"><?= $auto->getId() ?></th>
                            <?php if($usuario->getSuperadmin()) : ?>
                                <td><?= $auto->getUsuarioId() ?></td>
                            <?php endif;?>
                            <?php if($usuario->getSuperadmin()) : ?>
                                <td><?= $auto->getUsuarioId() ?></td>
                            <?php endif;?>
                            <td><?= $auto->getMarca() ?></td>
                            <td><?= $auto->getModelo() ?></td>
                            <td><?= $auto->getPrecio() ?></td>
                            <?php if($usuario->getSuperadmin()) : ?>
                                <td class="text-center ">
                                    <form action="" method="POST">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                    </form>
                                    <form action="" method="POST">
                                        <button type="submit" class="btn btn-success"> <i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php else :?>
                        <tr>    
                        <th scope="row"> -</th>
                            <td>-</td>
                            <?php if($usuario->getSuperadmin()) : ?>
                                <td>-</td>
                            <?php endif;?>
                            <?php if($usuario->getSuperadmin()) : ?>
                                <td>-</td>
                            <?php endif;?>
                            <td>-</td>
                            <td>-</td> 
                            <?php if($usuario->getSuperadmin()) : ?>   
                                <td class="text-center ">-</td>  
                            <?php endif;?>               
                        </tr>    
                    <?php endif;?>
                    </tr>                    
                </tbody>            
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
         CREAR
        </button>

<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black;">CREAR NUEVA VENTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="sistema.php" method="POST">
                     <input type="hidden" name="evento" value="crear">
                     <input class="form-control mb-4" type="text" name="marca" placeholder="Marca">
                     <input class="form-control mb-4" type="text" name="modelo" placeholder="Modelo">
                     <input class="form-control mb-4" type="text" name="precio" placeholder="Precio">
                     <select class="form-control mb-4" name="usuarios" id="usuarios">
                         <?php foreach(Usuario::all() as $user) :?>
                            <option value="<?= $user['id'] ?>">
                                    <?= $user['nombre']. " ".$user['apellido']  ?> 
                            </option>
                        <?php endforeach;?>
                     </select>
                     <button type="submit" class="btn btn-primary">ACEPTAR</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>             
            </div>
            </div>
        </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>