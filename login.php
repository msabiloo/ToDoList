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
    $name = request('name');
    $password = request('password');
   
   

    if(! is_null($password) && ! is_null($name)) {
        $link = mysqli_connect('localhost:3306', 'root', '');
        if (! $link){
            echo 'error: ' .mysqli_connect_error($link); 
        }
        mysqli_select_db($link, 'php');

        $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
        //$id = "SELECT id FROM users WHERE name='$name'";
        //var_dump($id);
       
        $results = mysqli_query($link, $query);
        $SQL = "SELECT id FROM users WHERE name='$name'";
        $result = mysqli_query($link, $SQL);
        $id = mysqli_fetch_assoc($result);
        //$id = $select_id['id'];
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['name'] = $name;
            $_SESSION['success'] = "You are now logged in";
            header("location: task.php?id={$id['id']}");
            
        }else {
            echo 'Wrong username/password combination';   
        }
    }

}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }
        body {
            font-size: 120%;
            background: #F8F8FF;
        }

        .header {
            width: 30%;
            margin: 50px auto 0px;
            color: white;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }
        form, .content {
            width: 30%;
            margin: 0px auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 0px 0px 10px 10px;
        }
        .input-group {
            margin: 10px 0px 10px 0px;
        }
        .input-group label {
            display: block;
            text-align: left;
            margin: 3px;
        }
        .input-group input {
            height: 30px;
            width: 93%;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid gray;
        }
        .btn {
            padding: 10px;
            font-size: 15px;
            color: white;
            background: #5F9EA0;
            border: none;
            border-radius: 5px;
        }
        .error {
            width: 92%;
            margin: 0px auto;
            padding: 10px;
            border: 1px solid #a94442;
            color: #a94442;
            background: #f2dede;
            border-radius: 5px;
            text-align: left;
        }
        .success {
            color: #3c763d;
            background: #dff0d8;
            border: 1px solid #3c763d;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="login.php">
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="name" >
        <?php if(has_error('name')) { ?>
            <span><?php  echo get_error('name'); ?></span><br>
        <?php  } ?>
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
        <?php if(has_error('password')) { ?>
            <span><?php  echo get_error('password'); ?></span><br>
        <?php  } ?>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
        Not yet a member? <a href="index.php">Sign up</a>
    </p>
</form>
</body>
</html>