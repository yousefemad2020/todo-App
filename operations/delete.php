<?php include_once("../DB/DB.php");
        include_once("../core/functions.php");
session_start() ;
?>
<?php

// echo $_POST['id'];
if (check_post_input('delete') && check_request_method('POST')) {

    $id = $_POST['id'] ;
    if(check_if_task_in_DB_has_id(DB_NAME,$id)->num_rows == 1){
        $result = delete_task_from_DB($id) ;
        $_SESSION["data_deleted"] = $result ;

    }else{
        $_SESSION["error_task"] = ["this task not found"] ;
    }
    header("location:../index.php") ;
    die;

}


?>



