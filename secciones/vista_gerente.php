<?php include("../templates/cabecera.php"); ?>
<?php include('../secciones/gerente.php');?>
</br>
<div class="row">
    <div class="col-6">
        <form action="" method="post">
        <div class="card">
            <div class="card-header">
                Agregar Empleado
            </div>
            <div class="card-body">

            <div class="mb-3 d-none">
              <label for="id" class="form-label">ID</label>
              <input type="text"
                class="form-control" name="id" value="<?php echo $id;?>" id="id" aria-describedby="helpId" placeholder="ID">
            </div>   
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"
                class="form-control" name="nombre" value="<?php echo $nombre;?>" id="nombre" aria-describedby="helpId" placeholder="Escriba el nombre">
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text"
                class="form-control" name="apellido" value="<?php echo $apellido;?>" id="apellido" aria-describedby="helpId" placeholder="Escriba los apellidos">
              
            </div>
           
            <div class="mb-3">
              <label for="" class="form-label">Tipo de ingreso:</label>

              <select multlipe class="form-control" name="productividad[]" id="listaproductividad">

                <?php foreach($productividad as $sueldo){ ?>
                    
                   <option
                   <?php
                       if(!empty($arregloproductividad)):
                           if(in_array($sueldo['id'],$arregloproductividad)):
                                echo 'selected'; 
                           endif;
                       endif
                   ?>
                   value="<?php echo $sueldo['id'];?>" >
                   <?php echo $sueldo['id'];?> - <?php echo $sueldo['nombre_Productividad'];?>
                   </option>

                <?php } ?>

              </select>
            </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
            </div>


            </div>
       
        </div>


        </form>
    </div>
    <div class="col-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php foreach($gerente as $gerente): ?>
                    <tr>
                        <td><?php echo $gerente['id'];?></td>

                        <td>
                            <?php echo $gerente['nombre'];?> <?php echo $gerente['apellido'];?>
                            <br/>
                            <?php foreach($gerente["productividad"] as $sueldo){ ?>
                                   -<a href="sueldo.php?idproductividad=<?php echo $sueldo['id']; ?>&idgerente=<?php echo $gerente["id"];?>"> 
                                   <i class="bi bi-filetype-pdf text-danger"></i> <?php echo $sueldo['nombre_Productividad']; ?>
                            </a><br/>
                               

                            <?php }  ?>


                        </td>

                        <td>
                        <form action="" method="post">

                            <input type="hidden" name="id" value="<?php echo $gerente['id'];?>">
                            <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                        </form>
                     
                            
                        </td>
                    </tr>
                   <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        
    </div>
        
</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.1.0/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.1.0/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect('#listaproductividad');

</script>


<?php include("../templates/pie.php"); ?>

