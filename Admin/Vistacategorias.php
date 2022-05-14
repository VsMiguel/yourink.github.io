<?php
include("modulos/categorias.php");
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
            <li class="breadcrumb-item active">Categorias</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Crear categoria</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" class="form-horizontal">
              <div class="card-body">
                <div class="form-group row">
                  <label for="categoria" class="col-sm-2
                          col-form-label">Categoria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Nombre categoria" require>
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
          <h3 class="card-title">Tabla categotias</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Categoria</th>
              </tr>
            </thead>
            <tbody>
              <?php $sentencia = $pdo->prepare("SELECT * FROM `categorias`");
              $sentencia->execute();
              while ($registro = $sentencia->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                  <td><?php echo $registro['id'] ?></td>
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