<?php
    date_default_timezone_set('asia/tehran');
    if(! isset($_GET['id'])) {
        header("Location: /");
    }
    
    $link = mysqli_connect('localhost:3306' , 'root' , '');
    if(! $link) {
        echo 'could not connect : ' . mysqli_connect_error();
        exit;
    }

    mysqli_select_db($link , 'php');
    $task_id = (int) $_GET['id'];
    $user_id = (int) $_GET['user_id'];
    $SQL = "select * from tasks WHERE id ='$task_id'";
    $result = mysqli_query($link, $SQL);
    var_dump($result);
    
    // $stmt = mysqli_prepare($link, "select * from tasks WHERE id = ?");
    // $id = (int) $_GET['id'];
    // mysqli_stmt_bind_param($stmt, 'i', $id);
    // mysqli_stmt_execute($stmt);
    // var_dump($stmt);
    // if( $result = mysqli_query($link , $SQL) ) {
    // } else {
    //     echo 'error : ' . mysqli_error($link);
    //     exit;
    // }
    

   // }
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //var_dump($id);
        //$new_task = request('new_task');
        $edit_task = $_POST['new_task'];
        // $new_task = 'test';
        // var_dump($new_task);
        $dateTimeVariable = date("Y-m-d H:i:s");
        $query = "UPDATE `tasks` SET `name`='$edit_task', `update_at`='$dateTimeVariable' WHERE id= '$task_id'";
        
        var_dump($query);
        $result= mysqli_query($link, $query);
        header("location: task.php?id={$user_id}");
        //header("Refresh:0");
        //if($result === false){
        //    var_dump(mysqli_error($link));
    // }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>


</style>

<body>
    <div id="myDIV" class="header">
        <h2>My To Do List</h2>      
        <form method='post' action="edit.php?user_id=<?=$user_id?>&id=<?=$task_id ?>">
        
        <input type="text" name="new_task" id="myInput" placeholder="Title...">
        <!--  <span onclick="newElement()" class="addBtn">Add</span> -->
        <button  type="submit" class="addBtn" name="add_task">Edit</button>
        </form>
    </div>
</body>
</html>