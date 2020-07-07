<?php 
 require_once 'assets/layout.php';
 require_once 'assets/helpers/utilities.php';
 require_once 'assets/student.php';
 require_once 'assets/services/IServiceBase.php';
 require_once 'assets/services/StudentServiceCookies.php';
 
 $layout = new Layout();
 $utilities = new Utilities();
 $service = new StudentServiceCookie();


 $listEstudiante = $service->GetList();

 if (!empty($listEstudiante)){
   if(isset($_GET['carrera'])){
     $listEstudiante = $utilities->filtro($listEstudiante, 'carrera', $_GET['carrera']);
   }
 }

?>


<?php $layout->printNavBar();?>

<main role="main">

<div class="container" style="margin-top: 10px;">
  <section class="jumbotron text-center">
    <div class="container">
      <h1>Registro de Estudiantes</h1>
      <p class="lead text-muted">Aplicacion para registrar estudiantes del ITLA.<p>
        <a href="assets/registro.php" class="btn btn-primary my-2">Agregar estudiante</a>
      </p>
    </div>
  </section>
  </div>

<div class="container">
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="btn-group" style="margin-bottom: 2%;" role="group" aria-label="Button group with nested dropdown">
        <a type="button" href="index.php" class="btn btn-secondary">Eliminar Filtro</a>

        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filtrar
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="index.php?carrera=Redes">Redes</a>
            <a class="dropdown-item" href="index.php?carrera=Software">Software</a>
            <a class="dropdown-item" href="index.php?carrera=Mecatronica">Mecatronica</a>
            <a class="dropdown-item" href="index.php?carrera=Multimedia">Multimedia</a>
            <a class="dropdown-item" href="index.php?carrera=Seguridad Informatica">Seguridad</a>
          </div>
        </div>
      </div>


    
    
      <div class="row">
      
      
          <?php if(!empty($listEstudiante)): ?>
            <?php foreach($listEstudiante as $student): ?>

              <div class="col-md-4">
              <div class="card mb-2 shadow-sm">
                <div class="card-body">
                  <p class="card-text"> Nombre: <?php echo $student->nombre ?> </p>
                  <p class="card-text"> Apellido: <?php echo $student->apellido ?> </p>
                  <p class="card-text"> Estado: <?php echo $student->estado?> </p>
                  <p class="card-text"> Carrera: <?php echo $student->carrera?> </p>
                  <p class="card-text"> Materia favorita: <?php echo $student->materiaFav?> </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a type="button" href="assets/editar.php?id=<?php echo $student->id ?>" class="btn btn-sm btn-primary">Editar</a>
                      <a type="button" href="assets/borrar.php?id=<?php echo $student->id ?>" class="btn btn-sm btn-danger">Borrar</a>
                    </div>
                  </div>
                </div>
              </div>
              </div>

            <?php endforeach; ?>

          <?php else: ?>

            <a style="margin: 2%;" class="btn btn-primary" href="assets/registro.php">Agregar Estudiante</a>

          <?php endif; ?>

          
        
      </div>
    </div>
  </div>
  </div>

</main>

<?php $layout->printFoot();?>
