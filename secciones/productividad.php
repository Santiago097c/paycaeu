<?php
include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();

$id=isset($_POST['id'])?$_POST['id']:'';
$nombre_productividad=isset($_POST['mombre_productividad'])?$_POST['nombre_productividad']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';




if($accion!=''){

    switch($accion){

        case 'agregar':

            $sql="INSERT INTO productividad (id, nombre_Productividad) VALUES (NULL,:nombre_Productividad)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre_Productiviada',$nombre_productividad);
            $consulta->execute();

            echo $sql;
        break;

        case 'editar';
           $sql="UPDATE productividad SET nombre_Productividad=:nombre_Productividad WHERE id=:id";
           $consulta=$conexionBD->prepare($sql);
           $consulta->bindParam(':id',$id);
           $consulta->bindParam(':nombre_Productividad',$nombre_productividad);
           $consulta->execute();

           echo $sql;
        break;

        case 'borrar';
            $sql="DELETE FROM productividad WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();

        break;

        case "Seleccionar";
            $sql="SELECT * FROM Productividad WHERE id=:id";
            $consulta=$conexionBD->prepare($sql); 
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $productividad=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_productividad=$productividad['nombre_Productividad'];
           echo $nombre_productividad;
        break;
    

    }

}


$consulta=$conexionBD->prepare("SELECT * FROM  productividad");
$consulta->execute();
$listaproductividad=$consulta->fetchAll();










  
    





?> 