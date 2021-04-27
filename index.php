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
    $email = request('email');
    $password_1 = request('password_1');
    $password_2 = request('password_2');
    

    if (is_null($email)){
        $error['email'] = "The email field could not be empty";
        var_dump($error);
    };
    
    if (is_null($password_1) || is_null($password_2)){
        $error['password'] = "The password fild could not be empty";
        var_dump($error);
        if ($password_1 != $password_2 ){
            $error['password'] = "The password ";
            var_dump($error);
        }
    }

    if(! is_null($email) && ! is_null($password_1) && ! is_null($password_2)) {
        $link = mysqli_connect('localhost:3306', 'root', '');
        if (! $link){
            echo 'error: ' .mysqli_connect_error($link); 
        }
        mysqli_select_db($link, 'php');

        $SQL = "INSERT INTO `users`( `name`, `email`, `password`) VALUES ('{$name}','{$email}','{$password_1}')";
        if ($result = mysqli_query($link, $SQL)) { ?>
            <a href="login.php"></a>;
        <?php }
    }

}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
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
    <h2>Register</h2>
</div>

<form action="/" method="post"> 
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="name">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email"><br>
            <?php if(has_error('email')) { ?>
                <span><?php  echo get_error('email'); ?></span><br>
            <?php  } ?>
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
        <?php if(has_error('password_1')) { ?>
                <span><?php  echo get_error('password_1'); ?></span><br>
        <?php  } ?>
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
        <?php if(has_error('password_2')) { ?>
                <span><?php  echo get_error('password_2'); ?></span><br>
        <?php  } ?>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>