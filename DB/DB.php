<?php




const DB_HOST     = "localhost";
const DB_PASSWORD = "";
const DB_USERNAME = "root";
const DB_NAME = "todo App";

// this function  create connection with dataBase 
// it can get parameter ( database name ) , parameter is optional
function get_connection( $DataBase_name = null )
{
    $db_conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, $DataBase_name)  ;
    if (!$db_conn) {
        die("connection filed " . mysqli_connect_error());
    }
    return $db_conn;
}

// function create database 
// only take database name 
function create_database( $DataBase_name )
{
    $db_conn = get_connection();
    $sql_statement = " CREATE DATABASE IF NOT EXISTS `$DataBase_name` ";
    if (mysqli_query($db_conn, $sql_statement)) {
        $result = "DataBase created successfully ";
    } else {
        $result = "Error to create database ";
    }
    return $result;
}

// you should to call function to create database if not created
// don't worry to call this function in every file you connect with database
create_database( DB_NAME ) ;

// create table ( public )
function create_table( $DataBase_name , $sql_statement )
{
    $db_conn = get_connection($DataBase_name) ;
    if ( mysqli_query($db_conn, $sql_statement) ) {
        $result = "Table created successfully";
    } else {
        $result = "Error to create Table ";
    }
    return $result;
}

// create specific table
function create_table_tasks(){
    $sql_statement = "CREATE TABLE IF NOT EXISTS TASKS (
        id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT  ,
        title VARCHAR(150) NOT NULL 
    ) ";
    create_table( DB_NAME , $sql_statement );
}

// check if task added before through use title
function check_if_task_in_DB( $DataBase_name , $title ){
    $db_conn = get_connection($DataBase_name);
    create_table_tasks();
    $sql_statement = "SELECT `id` FROM tasks where `title` = '$title'";
    return mysqli_query($db_conn,$sql_statement);
}

// check if task added before through use id
function check_if_task_in_DB_has_id( $DataBase_name , $id ){
    $db_conn = get_connection($DataBase_name);
    create_table_tasks();
    $sql_statement = "SELECT `id`,`title` FROM tasks where `id` = '$id'";
    return mysqli_query($db_conn,$sql_statement);
}

// insert new record in table
function insert_task_in_DB($DataBase_name,$title){
    $db_conn = get_connection($DataBase_name);
    create_table_tasks();
    $sql_statement = "INSERT INTO `tasks` (`title`) VALUES('$title')";
    mysqli_query($db_conn,$sql_statement);
    switch( mysqli_affected_rows($db_conn) ){
        case '1' :
            $result = "true" ;
        break;
        case '0' :
            $result = "no action" ;
        break;
        case '-1' :
            $result = "false" ;
        break;
    }
    return $result ;


}

// get all records in table `tasks`
function get_all_tasks(  ){
    $result = get_connection(DB_NAME);
    create_table_tasks();
    $sql_statement = "SELECT `id`,`title` FROM `tasks`" ;
    $result = mysqli_query( $result , $sql_statement );
    $row = mysqli_fetch_all($result);
    return $row ;
}

// delete specific task
function delete_task_from_DB( $id ){
    $result = get_connection( DB_NAME );
    create_table_tasks();
    $sql_statement = "DELETE FROM tasks WHERE id = '$id' ;" ;
    $result = mysqli_query( $result , $sql_statement );
    if( $result ){
        return "data deleted successfully" ;
    }
}

// update specific task
function update_task_in_db($id,$task){
    $result = get_connection( DB_NAME );
    create_table_tasks();
    $sql_statement = "UPDATE `tasks` SET `title` = '$task' WHERE `id` = '$id' " ;
    $result = mysqli_query( $result , $sql_statement );
    if( $result ){
        return "data updated successfully" ;
    }

}
