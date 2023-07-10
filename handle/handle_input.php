<?php

// files  validation
include_once("../core/functions.php");
// files connect with dataBase and functions with dealing with dataBase
include_once("../DB/DB.php");
session_start();

if (check_post_input('submit') && check_request_method('POST')) {
    $task = htmlspecialchars(htmlentities(trim($_POST['task']))) ;

    $error = [] ;

    validation_name( "task" , $task , 8 , 149 );

    if ( empty($error) ) {
        $number_of_task = check_if_task_in_DB( DB_NAME , $task ) -> num_rows ;
        if( $number_of_task == 0 ){
            if( insert_task_in_DB( DB_NAME , $task ) == 'true' )  {
            $_SESSION["task_added"] = "task added successfully";
        }else{
            $_SESSION['error_task'] = ["task not added"];
        }
        header("location:../index.php") ;
        die ;
        }else{
            $error[] = "this task already added before" ;
            $_SESSION['error_task'] = $error;
            header("Location:../index.php");
            die;
        }
        
    } else {

        $_SESSION['error_task'] = $error;
        header("Location:../index.php");
        die;
    }

}
?>