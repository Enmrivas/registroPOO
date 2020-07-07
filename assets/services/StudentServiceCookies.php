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

        array_push($listStudent, $entidad);

        setcookie($this->cookieName, json_encode($listStudent), $this->utilities->GetCookieTime(), "/");

    }

    public function Update($id, $entidad){
        
        $element = $this->GetById($id);
        $listStudent = $this->GetList();

        $elementIndex = $this->utilities->buscarID($listStudent, 'id', $id);

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