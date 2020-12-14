<?php 
    require "empleados.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud con htnl</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-row">
            <input type="hidden" required name="txtID" value="<?php echo $txtID;?>" placeholder="" id="txtID" require="">

            <div class="form-group col-md-4">
                <label for="">usuario</label>
                <input type="text" class="form-control <?php echo (isset($error["usuario"]))?"is-invalid":"";?>"  name="txtusuario" value="<?php echo $txtusuario;?>" placeholder="" id="txtusuario" require="">
                <div class="invalid-feedback">
                    <?php echo (isset($error["usuario"]))?$error["usuario"]:""; ?>
                </div>

                <br>
            </div>

            <div class="form-group col-md-4">
                <label for="">nombre</label>
                <input type="text" class="form-control <?php echo (isset($error["nombre"]))?"is-invalid":"";?>" name="txtnombre" value="<?php echo $txtnombre;?>" placeholder="" id="txtnombre" require="">
                <div class="invalid-feedback">
                    <?php echo (isset($error["nombre"]))?$error["nombre"]:""; ?>
                </div>
                <br>
            </div>
            
            <div class="form-group col-md-4">
                <label for="">sexo</label>
                <input type="text" class="form-control <?php echo (isset($error["sexo"]))?"is-invalid":"";?>" name="txtsexo" value="<?php echo $txtsexo;?>" placeholder="" id="txtsexo" require="">
                <div class="invalid-feedback">
                    <?php echo (isset($error["sexo"]))?$error["sexo"]:""; ?>
                </div>
                <br>
            </div>

            <div class="form-group col-md-4">
                <label for="">nivel</label>
                <input type="text" class="form-control <?php echo (isset($error["nivel"]))?"is-invalid":"";?>" name="txtnivel" value="<?php echo $txtnivel;?>" placeholder="" id="txtnivel" require="">
                <div class="invalid-feedback">
                    <?php echo (isset($error["nivel"]))?$error["nivel"]:""; ?>
                </div>
                <br>
            </div>

            <div class="form-group col-md-4">
                <label for="">email</label>
                <input type="text" class="form-control <?php echo (isset($error["email"]))?"is-invalid":"";?>" name="txtemail" value="<?php echo $txtemail;?>" placeholder="" id="txtemail" require="">
                <div class="invalid-feedback">
                    <?php echo (isset($error["email"]))?$error["email"]:""; ?>
                </div>
                <br>
            </div>

           
            
      </div>
      </div>
      <div class="modal-footer">
            <button value="btnAgregar"  <?php echo $accionAgregar;?> class="btn btn-success" type="submit" name="accion">Agregar</button>
            <button value="btnModificar" <?php echo $accionModificar;?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
            <button value="btnElimninar" onclick="return Confirmar('¿Realmente deseas borrar?');" <?php  echo $accionEliminar;?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
            <button value="btnCancelar" <?php echo $accionCancelar;?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<br/>
<br/>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar Registro 
</button>
<br/>
<br/>         

        </form>
        <div class="row"> 
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>usuario</th>
                        <th>nombre</th>
                        <th>sexo</th>
                        <th>nivel</th>
                        <th>email</th>
                        <th>acciones</th>
                        

                    </tr>
                </thead>
                <?php foreach($listaEmpleados as $empleado) { ?>
                    <tr>
                        <td><?php echo $empleado["usuario"];?> </td>
                        <td><?php echo $empleado["nombre"];?> </td>
                        <td><?php echo $empleado["sexo"];?> </td>
                        <td><?php echo $empleado["nivel"];?></td>
                        <td><?php echo $empleado["email"];?></td>
                        

                        <td> 
                            <form action="" method="post">

                                    <input type="hidden" name="txtID" value="<?php echo $empleado["ID"];?>">
                                    <input type="submit" class="btn btn-info" value="Seleccionar" name="accion">
                                    <button value="btnElimninar" onclick="return Confirmar('¿Realmente deseas borrar?');" class="btn btn-danger" type="submit" name="accion">Eliminar</button>

                            </form>

                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php if($mostrarModal){?>
        <script>
            $("#exampleModal").modal("show");
        </script>
        <?php } ?>
        <script>
            function Confirmar(Mensaje){
                return (confirm(Mensaje))?true:false;
            }
        </script>
    </div>
</body>
</html>