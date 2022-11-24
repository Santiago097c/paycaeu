<?php include("../templates/cabecera.php"); ?>
<?php include('../secciones/productividad.php');?>


<div class="row">
    <div class="col-12">
        <br/>
        <div class="row">
        <div class="col-7">
        <form action="" method="post">
        <div class="card">
            <div class="card-header"> productividad </div>
            <div class="card-body">
            <div class="mb-3 d-none">
                <label for="" class="form-label">ID</label>
                <input type="text"
                        class="form-control"
                        name="id"
                        id="id" 
                        value="<?php echo $id; ?>"
                        aria-describedby="helpId" placeholder="ID">
           </div>
           <div class="mb-3">
                <label for="nombre_Productividad" class="form-label">Nombre</label>
                <input type="text"
                        class="form-control"
                        name="nombre_Productividad" 
                        id="nombre_Productividad" 
                        value="<?php echo $nombre_productividad; ?>"
                        aria-describedby="helpId"
                        placeholder="Nombre de productividad">
           </div>
 
           <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
           </div>

        </div>
</div>






   
</div>
</div>




</div>
<div class="col-7">

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach($listaproductividad as $productividad){ ?>
      </tr>
        <td> <?php echo $productividad['id']; ?> </td>
        <td> <?php echo $productividad['nombre_Productividad']; ?> </td>
        <td> 
        <form action="" method="post">
          <input type="hidden" name="id" id="id" value="<?php echo $productividad['id']; ?>"/>
          <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
        </form>
      </tr>
    <?php }?>
    </tbody>
  </table>


</div>
</div>
</div>


