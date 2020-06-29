<?php

    include 'helpers/utilities.php';

    session_start();

    $estudiante = $_SESSION['estudiante'];

    if(isset($_GET['id'])){
        $idStudent = $_GET['id'];

        $elementIndex = buscarID($estudiante, 'id', $idStudent);

        unset($estudiante[$elementIndex]);

        $_SESSION['estudiante'] = $estudiante;

    }

    header("Location: ../index.php");

    exit();

?>
