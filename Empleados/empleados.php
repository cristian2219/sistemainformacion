<?php


$txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
$txtusuario=(isset($_POST["txtusuario"]))?$_POST["txtusuario"]:"";
$txtnombre=(isset($_POST["txtnombre"]))?$_POST["txtnombre"]:"";
$txtsexo=(isset($_POST["txtsexo"]))?$_POST["txtsexo"]:"";
$txtnivel=(isset($_POST["txtnivel"]))?$_POST["txtnivel"]:"";
$txtemail=(isset($_POST["txtemail"]))?$_POST["txtemail"]:"";


$accion=(isset($_POST["accion"]))?$_POST["accion"]:"";

$error=array();

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal=false;

include ("../conexion/conexion.php");
    
switch ($accion) {
    case 'btnAgregar':

        if ($txtusuario=="") {
            $error["txtusuario"]="Escribe el usuario";
        }
        if ($txtnombre=="") {
            $error["txtnombre"]="Escribe el nombre";
        }
        if ($txtsexo=="") {
            $error["txtsexo"]="Escribe el sexo";
        }
        if ($txtnivel=="") {
            $error["txtnivel"]="Escribe el nivel";
        }
        if ($txtemail=="") {
            $error["txtemail"]="Escribe el email";
        }
        if (count($error)>0) {
            $mostrarModal=true;
            break;
        }

        $sentencia=$pdo->prepare("INSERT INTO tblusuarios(usuario,nombre,sexo,nivel,email) 
        values (:usuario,:nombre,:sexo,:nivel,:email)");

        $sentencia->bindParam(":usuario",$txtusuario);
        $sentencia->bindParam(":nombre",$txtnombre);
        $sentencia->bindParam(":sexo",$txtsexo);
        $sentencia->bindParam(":nivel",$txtnivel);
        $sentencia->bindParam(":email",$txtemail);

        $sentencia->execute();
        header("Location: index.php");        

      
    break;

    case 'btnModificar':

        $sentencia=$pdo->prepare(" UPDATE empleados SET 
        usuario=:usuario,
        nombre=:nombre,
        sexo=:sexo,
        nivel=:nivel WHERE
        email=:email");

        $sentencia->bindParam(":usuario",$txtusuario);
        $sentencia->bindParam(":nombre",$txtnombre);
        $sentencia->bindParam(":sexo",$txtsexo);
        $sentencia->bindParam(":nivel",$txtnivel);
        $sentencia->bindParam(":email",$txtemail);
        $sentencia->execute();



        $Fecha= new DateTime();
        $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES['txtFoto']["name"]:"imagen.png";
        $tmpFoto= $_FILES['txtFoto']["tmp_name"];
        if($tmpFoto!="")
        {
            move_uploaded_file($tmpFoto,"../imagenes/".$nombreArchivo);

            $sentencia=$pdo->prepare(" SELECT Foto FROM empleados WHERE id=:id");
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
            $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
    
            PRINT_R($empleado);
    
            if(isset($empleado["Foto"])){
                if(file_exists("../imagenes/".$empleado["Foto"])){

                    if($empleado["Foto"]!="imagen.png"){
                    unlink("../imagenes/".$empleado["Foto"]);
                    }
                }
            }


            

            $sentencia=$pdo->prepare(" UPDATE empleados SET 
            Foto=:Foto WHERE
            id=:id");
    
            $sentencia->bindParam(":Foto",$nombreArchivo);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();

        }



        header("Location: index.php");

        echo $txtID;
        echo "Presionaste btnModificar";
    break;

    case 'btnElimninar':

        $sentencia=$pdo->prepare(" SELECT Foto FROM empleados WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $empleado=$sentencia->fetch(PDO::FETCH_LAZY);

        PRINT_R($empleado);

        if(isset($empleado["Foto"])&&($empleado["Foto"]!="imagen.png")){
            if(file_exists("../imagenes/".$empleado["Foto"])){
                unlink("../imagenes/".$empleado["Foto"]);

            }
        }
    
        $sentencia=$pdo->prepare(" DELETE FROM empleados WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        header("Location: index.php");

        echo $txtID;
        echo "Presionaste btnElimninar";
    break;

    case 'btnCancelar':
        header("Location: index.php");
    break;

    case 'Seleccionar':
        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=True;

        $sentencia=$pdo->prepare(" SELECT * FROM tblusuarios WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $empleado=$sentencia->fetch(PDO::FETCH_LAZY);

        $txtusuario=$empleado["usuario"];
        $txtnombre=$empleado["Nombre"];
        $txtsexo=$empleado["sexo"];
        $txtnivel=$empleado["nivel"];
        $txtemail=$empleado["email"];
   
    break;
}

    $sentencia= $pdo->prepare("SELECT * FROM tblusuarios WHERE 1");
    $sentencia->execute();
    $listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    //print_r($listaEmpleados);


?>