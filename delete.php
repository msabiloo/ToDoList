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
   
        $query = "DELETE FROM `tasks` WHERE `id`= '$task_id'";
        
        var_dump($query);
        $result= mysqli_query($link, $query);
        header("location: task.php?id={$user_id}");
        //header("Refresh:0");
      //  if($result === false){
       //     var_dump(mysqli_error($link));
    // }

?>