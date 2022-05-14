<?php
include("modulos/productos.php");
?>
<?php include("header.php") ?>
<!-- Main Sidebar Container -->
<?php include("sidebar.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Vistapanel.php">Home</a></li>
            <li class="breadcrumb-item active">Productos</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Formulario de productos -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Agregar productos</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" class="form-horizontal">
              <div class="card-body">
                <div class="form-group row">
                  <label for="nombre" class="col-sm-2
                          col-form-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del profucto" require>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="descripcion" class="col-sm-2
                          col-form-label">Descropcion</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descropcion del profucto" require>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="precion" class="col-sm-2
                          col-form-label">Precio</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="precion" name="precion" placeholder="Precio del profucto" require>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="precior" class="col-sm-2
                          col-form-label">Precio rebajado</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="precior" name="precior" placeholder="Precio rebajado del profucto" require>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cantidad" class="col-sm-2
                          col-form-label">Cantidad (Stock)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Stock del profucto" require>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="imagen" class="col-sm-2
                          col-form-label">Imagen</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="imagen" name="imagen" require>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="categoria" class="col-sm-2
                          col-form-label">Categoria (Stock)</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="categoria" aria-label="Default select example" require>
                      <?php
                      $categorias = $pdo->prepare("SELECT * FROM `categorias`");
                      $categorias->execute();
                      foreach ($categorias as $cat) { ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Sign in</button>
                <button type="submit" class="btn btn-default float-right">Cancel</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
      <!-- /Formulario de productos -->
      <!-- Main row -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabla de productos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Precio rebajado</th>
                <th>Cantidad</th>
                <th>Categoria</th>
              </tr>
            </thead>
            <?php
            $sentencia = $pdo->prepare("SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC");
            $sentencia->execute();
            while ($registro = $sentencia->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td><?php echo $registro['id'] ?></td>
                <td><img class="" style="width: 50px;" src="../assets/img/<?php echo $registro['imagen']; ?>" alt="..." /></td>
                <td><?php echo $registro['nombre'] ?></td>
                <td><?php echo $registro['precio_normal'] ?></td>
                <td><?php echo $registro['precio_rebajado'] ?></td>
                <td><?php echo $registro['cantidad'] ?></td>
                <td><?php echo $registro['categoria'] ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("footer.php") ?>