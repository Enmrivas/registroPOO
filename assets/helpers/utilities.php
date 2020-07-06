<?php

class Utilities{

    public function getLast($list){
        $countList = count($list);
        $lastElem = $list[$countList - 1];
    
        return $lastElem;
    }
    
    
    public function filtro($list, $filtro, $value){
    
        $filter = [];
        foreach($list as $item){
            if($item->$filtro == $value){
                array_push($filter, $item);
            }
        }
    
        return $filter;
    
    }

    public function GetCookieTime(){
        return time() + 60*60*24*30;
    }

    public function buscarID($list, $filtro, $value){
    
        $index = 0;
        foreach($list as $key => $item){
            if($item->$filtro == $value){
                $index = $key;
            }
        }
    
        return $index;
    
    }


}


?>