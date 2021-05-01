<?php
    $user = new \App\Controller\UsersController();
    var_dump($user);
    $user->register($_POST);

?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel pavel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register Page</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                             <form class="form-horizontal" action="/register.php" method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email ...">
                                </div>
                                <div class="form-group">
                                    <label >Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password ...">
                                </div>
                                <div class="form-group">
                                    <label >Password</label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password ...">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Register</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

