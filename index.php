<?php include_once("inc/header.php");  ?>
<?php include_once("DB/DB.php");
session_start();
?>

<div class="container w-50 my-5 ">


    <!-- show error  -->
    <?php
    if (isset($_SESSION['error_task'])) :
        foreach ($_SESSION['error_task'] as $error) :
    ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
    <?php
        endforeach;
        unset($_SESSION['error_task']);
    endif; ?>




    <!-- show result when task added -->
    <?php if (isset($_SESSION["task_added"])) : ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["task_added"] ?>
        </div>
    <?php unset($_SESSION["task_added"]);
    endif; ?>

    <!-- show result when record deleted -->
    <?php if (isset($_SESSION["data_deleted"])) : ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION["data_deleted"] ?>
        </div>
    <?php unset($_SESSION["data_deleted"]);
    endif; ?>


    <!-- this form  to enter title of record-->
    <form method="POST" action="./handle/handle_input.php">
        <div class="mb-3">
            <input type="text" class="form-control" id="exampleInput1" placeholder="add new todo" name="task">
        </div>
        <button type="submit" name="submit" class="btn btn-outline-primary form-control">ADD</button>
    </form>


    <!-- table to show all record of tasks -->
    <div class="my-5 text-center ">
        <table class="table  table-striped border border-secondary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (get_all_tasks() as $value) : ?>
                    <tr>
                        <th scope="row"><?= $value[0] ?></th>
                        <td><?= $value[1] ?></td>
                        <td>
                            <!-- to use GET METHOD -->
                            <!-- <a href="./operations/delete.php?" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></a> -->

                            <!-- form to send id of record with POST METHOD to page delete -->
                            <form action="./operations/delete.php" method="POST">
                                <input type="hidden" name="id" value="<?= $value[0] ?>" name="id">
                                <button type="submit" name="delete" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                            </form>

                        </td>
                        <td>
                            <!-- to use GET METHOD -->
                            <!-- <a href="" class="btn btn-success"><i class="fa-regular fa-trash-can"></i></a> -->

                            <!-- form to send id of record with POST METHOD to page update -->
                            <form action="./operations/update.php" method="POST">
                                <input type="hidden" name="id" value="<?= $value[0] ?>" name="id">
                                <button type="submit" name="update" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>


<?php

create_table_tasks();

?>


<?php include_once("inc/footer.php");  ?>