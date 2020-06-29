<?php 
    include 'layout.php';
    include 'helpers/utilities.php';

    session_start();

    if(isset($_GET['id'])){

        $_SESSION['estudiante'] = isset($_SESSION['estudiante']) ? $_SESSION['estudiante'] : array();
    
        $estudiante = $_SESSION['estudiante'];

        $element = filtro($estudiante, 'id', $_GET['id'])[0];

        $elementIndex = buscarID($estudiante, 'id', $_GET['id']); 

        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['estado']) && isset($_POST['carrera'])){
    
            $newUpdate = ['id' => $idEstudiante, 'nombre' => $_POST['nombre'], 'apellido' => $_POST['apellido'], 'estado' => $_POST['estado'], 'carrera' => $_POST['carrera']];

            $estudiante[$elementIndex] = $newUpdate;
    
            $_SESSION['estudiante'] = $estudiante;
    
            header("Location: ../index.php");
            exit();

    }
    }else{
        header("Location: ../index.php");
        exit();
    }

?>


<?php printNavBar();?>
<div class="container">
    <a href="../index.php" class="btn btn-secondary" style="margin-top: 1%">Volver</a>
</div>

<main role="main" style="background: grey; padding: 5%; margin-top: 3%;">

    <div class="container">

        <div class="card">
            <div class="card-body">
                <form action="editar.php?id=<?php echo $element['id'] ?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" value="<?php echo $element['nombre'] ?>" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" value="<?php echo $element['apellido'] ?>" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
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
                    <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

</main>

<?php printFoot();?>
