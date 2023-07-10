<?php

function check_post_input($name){
    if(isset($_POST[$name]))
        return true;
    return false ;
}

function check_request_method($request){
    if($_SERVER['REQUEST_METHOD'] == $request )
        return true ;
    return false ;
}
function validation_name( $name , $value_name , $min_length , $max_length ){
    global $error ;
    if(empty($value_name)){
        $error[] = "$name is required";
    }elseif( strlen($value_name) < $min_length ){
        $error[] = "length of $name should be greater than ".$min_length;
    }elseif( strlen($value_name) > $max_length ){
        $error[] = "length of $name should be smaller than ".$max_length;
    }
}


















?>