<?php

    class Student {
    

        public $id;
        public $nombre;
        public $apellido;
        public $estado;
        public $carrera;
        public $materiaFav;
        public $fotoPerfil;

        public function __construct(){

        }

        public function set($data){
            foreach ($data as $key => $value) $this->{$key} = $value;
        }

        public function initializeData($id, $nombre, $apellido, $estado, $carrera, $materiaFav){

            
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->estado = $estado;
            $this->carrera = $carrera;
            $this->materiaFav = $materiaFav;
            
        }

    
    }


?>