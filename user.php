<?php


class user {
    
    private  $name;
    private $profile = array();
    
    function __construct($_profile) {
        $this->profile = $_profile;
    }
    
    function setProfile($_profile){
        $this->profile = $_profile;
    }
    
    function  setName($_name){
        $this->name = $_name;
    }
    
    function getProfile(){
    
        return $this->profile;
    }
            
    function showProfile(){
        echo '<pre>';
        print_r($this->profile);
        echo '</pre>';
        
    }
    
}
