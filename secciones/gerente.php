<?php

include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();

$id=isset($_POST['id'])?$_POST['id']:'';
$nombre=isset($_POST['nombre'])?$_POST['nombre']:'';
$apellido=isset($_POST['apellido'])?$_POST['apellido']:'';

$productividad=isset($_POST['productividad'])?$_POST['productividad']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';



if($accion!=""){
    switch($accion){

        case 'agregar':

            $sql="INSERT INTO gerente (id, nombre, apellido) VALUES (NULL,:nombre,:apellido)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellido',$apellido);
            $consulta->execute();

            $idgerente=$conexionBD->lastInsertId();

            foreach($productividad as $productividad){
                $sql="INSERT INTO sueldo (id, idgerente, idproductividad) VALUES (NULL,:idgerente,:idproductividad)";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':idgerente',$idgerente);
                $consulta->bindParam(':idproductividad',$productividad);
                $consulta->execute();  
            }


        break;

        case 'Seleccionar':

           

           

            $sql="SELECT * FROM gerente WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $gerente=$consulta->fetch(PDO::FETCH_ASSOC);

            $nombre=$gerente['nombre'];
            $apellido=$gerente['apellido'];
            
            $sql="SELECT productividad.id FROM sueldo
            INNER JOIN productividad ON productividad.id=sueldo.idproductividad
            WHERE sueldo.idgerente=:idgerente";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':idgerente',$id);
            $consulta->execute();
            $sueldo=$consulta->fetchAll(PDO::FETCH_ASSOC);

           

            foreach($sueldo as $productividad){
              $arregloproductividad[]=$productividad['id'];
            }

        break;
        case "borrar":
            $sql="DELETE FROM gerente WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;    
        case "editar":
            $sql="UPDATE gerente SET nombre=:nombre, apellido=:apellido
             WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellido',$apellido);
            $consulta->bindParam(':id',$id);
            $consulta->execute();

            if(isset($productividad)){
             
                $sql="DELETE FROM sueldo WHERE idgerente=:idgerente";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':idgerente',$id);
                $consulta->execute();

                foreach($productividad as $sueldo){
                
                    $sql="INSERT INTO sueldo (id, idgerente, idproductividad)
                    VALUES (NULL,:idgerente,:idproductividad)";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':idgerente',$id);
                    $consulta->bindParam(':idproductividad',$sueldo);
                    $consulta->execute();


                }
                $arregloproductividad=$productividad;

            }
        break;    


    }   


}



$sql="SELECT * FROM gerente";
$listaGerente=$conexionBD->query($sql);
$gerente=$listaGerente->fetchAll();

foreach($gerente as $clave => $Gerente){

    $sql="SELECT * FROM productividad 
    WHERE id IN (SELECT idproductividad FROM sueldo WHERE idgerente=:idgerente)";

    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':idgerente',$Gerente['id']);
    $consulta->execute();
    $sueldo=$consulta->fetchAll();
    $gerente[$clave]['productividad']=$sueldo;
}

$sql="SELECT * FROM productividad";
$listaproductividad=$conexionBD->query($sql);
$productividad=$listaproductividad->fetchAll();



?>