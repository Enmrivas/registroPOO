<?php
    require_once 'helpers/utilities.php';
    require_once 'student.php';
    require_once 'services/IServiceBase.php';
    require_once 'services/StudentServiceCookies.php';

    $service = new StudentServiceCookie();

    $containsId = isset($_GET['id']);

    if($containsId){
        $idStudent = $_GET['id'];

        $service->Delete($idStudent);

    }

    header("Location: ../index.php");

    exit();

?>
