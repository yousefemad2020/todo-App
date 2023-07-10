<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    
</head>
<body>

<?php include_once("../DB/DB.php") ;
include_once("../core/functions.php") ;
include_once("../DB/DB.php");
session_start() ;
?>


<?php

if ( check_post_input('update') && check_request_method('POST') ) :
    $id = $_POST['id'] ;
    $_SESSION['id'] = $id ;
    if (check_if_task_in_DB_has_id(DB_NAME, $id)->num_rows == 1) :
        $title = mysqli_fetch_assoc(check_if_task_in_DB_has_id(DB_NAME, $id))['title'] ;
?>
        <div class="container w-50 my-5 ">
            <form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
                <div class="mb-3">
                    <input value="<?= $title?>" type="text" class="form-control" id="exampleInput1" placeholder="add new todo" name="task">
                </div>
                <button type="submit" name="submit_update" class="btn btn-outline-primary form-control">ADD</button>
            </form>
        </div>


<?php endif ;
endif ; ?>


<?php
if (check_post_input('submit_update') && check_request_method('POST')) :

    $new_task = htmlspecialchars(htmlentities(trim($_POST['task'])));
    $error = [] ;
    validation_name( "task" , $new_task , 8 , 149 );

    if ( empty($error) ) {
        $number_of_task = check_if_task_in_DB( DB_NAME , $new_task ) -> num_rows ;
        if( $number_of_task == 0 ){
            $_SESSION["task_added"] = update_task_in_db( $_SESSION['id'] , $new_task );
        header("location:../index.php");
        die;
        }else{
            $error[] = "this task already added before" ;
            $_SESSION['error_task'] = $error ;
            header("Location:../index.php") ;
            die ;
        }
        
    } else {

        $_SESSION['error_task'] = $error;
        header("Location:../index.php");
        die;
    }





endif;
?>




<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>