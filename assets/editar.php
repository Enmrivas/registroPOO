<?php 
    require_once 'layout.php';
    require_once 'helpers/utilities.php';
    require_once 'student.php';
    require_once 'services/IServiceBase.php';
    require_once 'services/StudentServiceCookies.php';

    
    $layout = new Layout();
    $service = new StudentServiceCookie();
    

    if(isset($_GET['id'])){

        $idEstudiante = $_GET['id'];
        $element = $service->GetById($idEstudiante);



        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['estado']) && isset($_POST['carrera']) && isset($_POST['materiaFav'])){

            $newUpdate = new Student();

            $newUpdate->initializeData($idEstudiante, $_POST['nombre'], $_POST['apellido'], $_POST['estado'], $_POST['carrera'], $_POST['materiaFav']);

            $service->Update($idEstudiante, $newUpdate);

            header("Location: ../index.php");
            exit();

    }
    }else{
        header("Location: ../index.php");
        exit();
    }

?>


<?php $layout->printNavBar();?>
<div class="container">
    <a href="../index.php" class="btn btn-secondary" style="margin-top: 1%">Volver</a>
</div>

<main role="main" style="background: grey; padding: 5%; margin-top: 3%;">

    <div class="container">

        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" action="editar.php?id=<?php echo $element->id ?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" value="<?php echo $element->nombre ?>" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" value="<?php echo $element->apellido ?>" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label></br>
                        <label>
                            <input type="radio" checked id="estado" name="estado" value="Activo">Activo
                        </label>
                        <label>
                            <input type="radio" id="estado" name="estado" value="Inactivo">Inactivo
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        <select class="form-control" id="carrera" name="carrera">
                            <option selected="selected">Elige una carrera</option>
                            <option>Redes</option>
                            <option>Software</option>
                            <option>Multimedia</option>
                            <option>Mecatronica</option>
                            <option>Seguridad Informatica</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="materiaFav">Materia Favorita</label>
                        <input required type="text" value="<?php echo $element->materiaFav ?>" class="form-control" id="materiaFav" name="materiaFav" placeholder="Materia Favorita">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto del Estudiante</label>
                        <input type="file" class="form-control" id="foto" name="fotoPerfil" placeholder="Foto del estudiante">
                    </div>
                    <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

</main>

<?php $layout->printFoot();?>
