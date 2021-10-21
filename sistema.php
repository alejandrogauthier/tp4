<?php
include_once('./clases/Usuario.php');
include_once('./repositorios/UsuarioRepository.php');
include_once('./repositorios/VentaRepository.php');
include_once('./repositorios/AutoRepository.php');
session_start();

//todos las ventas,usuarios y autos
$ventas = VentaRepository::all();
$usuarios = UsuarioRepository::all();
$autos = AutoRepository::all();

//asigno a una variable la session del usuario
$usuario = $_SESSION['usuario'];

//variables para el informe
$minVenta = VentaRepository::min();
$maxVenta = VentaRepository::max();

//variable para error
$error = '';

$usuario = new Usuario($usuario['id'], $usuario['usuario'], $usuario['clave'], $usuario['nombre'], $usuario['apellido'], $usuario['superadmin']);
if ($_SERVER["REQUEST_METHOD"] == 'POST' || $_POST) {
   
    $datos = json_decode(file_get_contents("php://input"),true);
    if($datos == null)
    {
        $datos = $_POST;
    }

    //switch para validar el tipo de evento
    switch($datos['evento'])
    {
       case 'crear' :  
                    if ($datos['usuario_id'] != '' && $datos['auto_id'] != '' && $datos['fecha'] != '') {
                        VentaRepository::create($datos);   
                        header("Location:sistema.php");                                    
                    } else {
                        $error = "Campo vacio";
                    }
                break;
        case 'editar': 
                        if ($datos['usuario_id'] != '' && $datos['auto_id'] != '' && $datos['fecha'] != '') {
                            VentaRepository::update($datos); 
                            header("Location:sistema.php");                        
                        } else {
                            $error = "Campo vacio";
                        }
                        break;
        case 'eliminar': 
                        VentaRepository::delete($datos);
                        header("Location:sistema.php");
                        break;
        case 'salir': 
                            session_destroy();
                            break;
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
                    <?php if ($usuario->getSuperadmin()) : ?>
                        <th scope="col">Nombre</th>
                    <?php endif; ?>
                    <?php if ($usuario->getSuperadmin()) : ?>
                        <th scope="col">Apellido</th>
                    <?php endif; ?>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Fecha</th>
                    <?php if ($usuario->getSuperadmin()) : ?>
                        <th scope="col" style="text-align:center !important;">Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (count($ventas)) : ?>
                    <?php foreach ($ventas as $venta) : ?>
                        <tr>
                            <th scope="row"><?= $venta->getId() ?></th>
                            <?php if ($usuario->getSuperadmin()) : ?>
                                <td><?= $venta->usuario()->getNombre() ?></td>
                            <?php endif; ?>
                            <?php if ($usuario->getSuperadmin()) : ?>
                                <td><?= $venta->usuario()->getApellido() ?></td>
                            <?php endif; ?>
                            <td><?= $venta->auto()->getMarca() ?></td>
                            <td><?= $venta->auto()->getModelo() ?></td>
                            <td><?= $venta->auto()->getPrecio() ?></td>
                            <td><?= date_format(new DateTime($venta->getFecha()), 'd-m-Y') ?></td>
                            <?php if ($usuario->getSuperadmin()) : ?>

                                <td class="text-center ">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarVenta<?= $venta->getId() ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="modal fade" id="editarVenta<?= $venta->getId() ?>" tabindex="-1" aria-labelledby="editarVenta<?= $venta->getId() ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarVenta<?= $venta->getId() ?>Label" style="color: black;">EDITAR VENTA</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" id="form-editar">
                                                        <input type="hidden" name="evento" value="editar">
                                                        <input type="hidden" name="id" value="<?= $venta->getId() ?>">
                                                        <label for="usuarios" class="text-dark float-start mb-1">Usuario</label>
                                                        <select class="form-control mb-4" name="usuario_id" id="usuarios">
                                                            <?php foreach ($usuarios as $user) : ?>

                                                                <option value="<?= $user->getId() ?>" <?= ($user->getId() == $venta->usuario()->getId()) ? 'selected' : '' ?>>
                                                                    <?= $user->getNombre() . " " . $user->getApellido()  ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                        <label for="autos" class="text-dark float-start mb-1">Auto</label>
                                                        <select class="form-control mb-4" name="auto_id" id="autos">
                                                            <?php foreach ($autos as $auto) : ?>
                                                                <option value="<?= $auto->getId() ?>" <?= ($auto->getId() == $venta->auto()->getId()) ? 'selected' : '' ?>>
                                                                    <?= $auto->getMarca() . " " . $auto->getModelo()  ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <label for="fechas" class="text-dark float-start mb-1">Fecha</label>
                                                        <input class="form-control mb-4" type="date" name="fecha" id="fechas" placeholder="Fecha" value="<?= $venta->getFecha() ?>">
                                                        <button type="submit" class="btn btn-primary">ACEPTAR</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarVenta<?= $venta->getId() ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="eliminarVenta<?= $venta->getId() ?>" tabindex="-1" aria-labelledby="eliminarVenta<?= $venta->getId() ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="eliminarVenta<?= $venta->getId() ?>Label" style="color: black;">Desea eliminar la venta?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  method="POST" id="form-eliminar">
                                                        <input type="hidden" name="evento" value="eliminar">
                                                        <input type="hidden" name="id" value="<?= $venta->getId() ?>">
                                                        <button type="submit" class="btn btn-primary">ACEPTAR</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                        <tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <th scope="row"> -</th>
                            <td>-</td>
                            <?php if ($usuario->getSuperadmin()) : ?>
                                <td>-</td>
                            <?php endif; ?>
                            <?php if ($usuario->getSuperadmin()) : ?>
                                <td>-</td>
                            <?php endif; ?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <?php if ($usuario->getSuperadmin()) : ?>
                                <td class="text-center ">-</td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                    </tr>
            </tbody>
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearVenta">
            CREAR
        </button>

        <!-- Modal -->
        <div class="modal fade" id="crearVenta" tabindex="-1" aria-labelledby="crearVentaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearVentaLabel" style="color: black;">CREAR NUEVA VENTA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="form-crear">
                            <input type="hidden" name="evento" value="crear">
                            <label for="usuarios" class="text-dark float-start mb-1">Usuario</label>
                            <select class="form-control mb-4" name="usuario_id" id="usuarios">
                                <option value="">Seleccione</option>
                                <?php foreach ($usuarios as $user) : ?>
                                    <option value="<?= $user->getId() ?>">
                                        <?= $user->getNombre() . " " . $user->getApellido()  ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="autos" class="text-dark float-start mb-1">Auto</label>
                            <select class="form-control mb-4" name="auto_id" id="autos">
                                <option value="">Seleccione</option>
                                <?php foreach ($autos as $auto) : ?>
                                    <option value="<?= $auto->getId() ?>">
                                        <?= $auto->getMarca() . " " . $auto->getModelo()  ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="fechas" class="text-dark float-start mb-1">Fecha</label>
                            <input class="form-control mb-4" type="date" name="fecha" id="fechas" placeholder="Fecha">
                            <button type="submit" class="btn btn-primary">ACEPTAR</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#informe">
            Informe
        </button>
        <form action="sistema.php" method="POST" id="form-salir" class="float-end">
            <input type="hidden" name="evento" value="salir">
            <button type="submit" class="btn btn-success">
                Salir
            </button>
         </form>                           
        <!-- Modal -->
        <div class="modal fade" id="informe" tabindex="-1" aria-labelledby="informeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="informeLabel" style="color: black;">Informe de maxima y minima venta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <div class="text-dark">
                             <p>Minima: <?= $minVenta ?></p>
                             <p>Maxima: <?= $maxVenta ?></p>
                         </div>    
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                    </div>
                </div>
            </div>
        </div>                          
         
        <?php if ($error != '') : ?>
            <div class="alert alert-danger mt-4">
                <?= $error ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>

        //pedido ajax para la creacion de una venta
        document.querySelector('#form-crear').onsubmit = function(event)
        {
            event.preventDefault();
            inputs = Array.from(this.elements);
            let errors = 0;
            let valores = [];
            inputs.pop();
            inputs.pop();
            inputs.shift();
            inputs.forEach(input => {
                if(input.getAttribute('id') == 'usuarios' || input.getAttribute('id') == 'autos')
                {             
                    if(input.options[input.selectedIndex].value == '')
                    {                    
                        errors++;
                    }
                }else 
                {     
                        if(input.value == ''){
                            errors++;
                        }
                }
            })
            if(errors == 0)
            {               
                inputs.forEach(input => {
                    valores.push(input.getAttribute('id') == 'usuarios' || input.getAttribute('id') == 'autos' ? input.options[input.selectedIndex].value : input.value)
                })
                axios.post('sistema.php', {
                    evento: 'crear',
                    usuario_id : valores[0],
                    auto_id : valores[1],
                    fecha : valores[2],
                }).then(()=> window.location.reload())
            }
        }
        //pedido ajax para la edicion de una venta
        document.querySelector('#form-editar').onsubmit = function(event)
        {
            event.preventDefault();
            inputs = Array.from(this.elements);
            let errors = 0;
            let valores = [];
            inputs.pop();
            inputs.pop();
            inputs.shift();
            inputs.forEach(input => {
                if(input.getAttribute('id') == 'usuarios' || input.getAttribute('id') == 'autos')
                {             
                    if(input.options[input.selectedIndex].value == '')
                    {                    
                        errors++;
                    }
                }else 
                {     
                        if(input.value == ''){
                            errors++;
                        }
                }
            })
            if(errors == 0)
            {               
                inputs.forEach(input => {
                    valores.push(input.getAttribute('id') == 'usuarios' || input.getAttribute('id') == 'autos' ? input.options[input.selectedIndex].value : input.value)
                })
                console.log(valores)
                axios.post('sistema.php', {
                    evento: 'editar',
                    id: valores[0],
                    usuario_id : valores[1],
                    auto_id : valores[2],
                    fecha : valores[3],
                }).then(()=> window.location.reload())
            }
        }
        //pedido ajax para la eliminacion de una venta
        document.querySelector('#form-eliminar').onsubmit = function(event)
        {
            event.preventDefault();
            inputs = Array.from(this.elements);
            inputs.pop();
            inputs.pop();
            inputs.shift();    
            axios.post('sistema.php', {
                evento: 'eliminar',
                id: inputs[0].value,
                }).then(()=> window.location.reload())
            }
        //pedido ajax para deslogearse
        document.querySelector('#form-salir').onsubmit = function(event)
        {
            event.preventDefault();
           
            axios.post('sistema.php', {
                    evento: 'salir',
                }).then(()=> window.location.href="index.php")
            }
    </script>
</body>

</html>