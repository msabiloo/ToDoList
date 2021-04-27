<?php


function request($field) {
    return isset($_REQUEST[$field]) && $_REQUEST[$field] != "" ? trim($_REQUEST[$field]) : null;
}

function has_error($field){
    global $error;
    return isset($error[$field]);
}


function get_error($field){
    global $error;
    return has_error($error[$field]) ? $error[$field] : null;
}

$error=[];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $task = request('task');
    
   
   

    if(! is_null($task)) {
        $link = mysqli_connect('localhost:3306', 'root', '');
        if (! $link){
            echo 'error: ' .mysqli_connect_error($link); 
        }
        mysqli_select_db($link, 'php');

    }

}



?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>