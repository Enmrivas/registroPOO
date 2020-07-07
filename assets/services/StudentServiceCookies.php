<?php

class StudentServiceCookie implements IServiceBase{

    private $utilities;
    private $cookieName;

    public function __construct(){

        $this->utilities = new Utilities();
        $this->cookieName = "estudiante";

    }

    public function GetList(){

        $listStudent = array();

        if (isset($_COOKIE[$this->cookieName])){

            $listStudent = json_decode($_COOKIE[$this->cookieName], false);

        }else{
            setcookie($this->cookieName, json_encode($listStudent), $this->utilities->GetCookieTime(), "/");
        }

        return $listStudent;

    }

    public function GetById($id){

        $listStudent = $this->GetList();
        $elementDecode = $this->utilities->filtro($listStudent, 'id', $id)[0];
        $estudiante = new Student();

        $estudiante->set($elementDecode);


        return $estudiante;

    }

    public function Add($entidad){

        $listStudent = $this->GetList();
        $estudianteID = 1;

        if(!empty($listStudent)){
            $lastStudent = $this->utilities->getLast($listStudent);
            $estudianteID = $lastStudent->$id + 1;
        }

        $entidad->id = $estudianteID;
        $entidad->fotoPerfil = "";

        if(isset($_FILES['fotoPerfil'])){

            $fotoFile = $_FILES['fotoPerfil'];

            if($fotoFile['error'] == 4){

                $entidad->fotoPerfil = "";

            }else{

                $typeReplace = str_replace("image/", "", $fotoFile['type']); 
                $type = $fotoFile['type'];
                $size = $fotoFile['size'];
                $nombre = $estudianteID . '.' . $typeReplace;
                $tmpFile = $fotoFile['tmp_name'];

                $success = $this->utilities->agregarImagen('image/estudiantes/', $nombre, $tmpFile, $type, $size);

                if($success){
                    $entidad->fotoPerfil = $nombre;
                }
            }

        }

        array_push($listStudent, $entidad);

        setcookie($this->cookieName, json_encode($listStudent), $this->utilities->GetCookieTime(), "/");

    }

    public function Update($id, $entidad){
        
        $element = $this->GetById($id);
        $listStudent = $this->GetList();

        $elementIndex = $this->utilities->buscarID($listStudent, 'id', $id);

        if(isset($_FILES['fotoPerfil'])){

            $fotoFile = $_FILES['fotoPerfil'];

            if($fotoFile['error'] == 4){

                $entidad->fotoPerfil = $element->fotoPerfil;

            }else{
                $typeReplace = str_replace("image/", "", $fotoFile['type']); 
                $type = $fotoFile['type'];
                $size = $fotoFile['size'];
                $nombre = $id . '.' . $typeReplace;
                $tmpFile = $fotoFile['tmp_name'];
    
                $success = $this->utilities->agregarImagen('image/estudiantes/', $nombre, $tmpFile, $type, $size);
    
                if($success){
                    $entidad->fotoPerfil = $nombre;
                }
            }

            

        }

        $listStudent[$elementIndex] = $entidad;

        setcookie($this->cookieName, json_encode($listStudent), $this->utilities->GetCookieTime(), "/");

    }

    public function Delete($id){

        $listStudent = $this->GetList();
        $elementIndex = $this->utilities->buscarID($listStudent, 'id', $id);

        unset($listStudent[$elementIndex]);

        $listStudent = array_values($listStudent);

        setcookie($this->cookieName, json_encode($listStudent), $this->utilities->GetCookieTime(), "/");
    }

}

?>