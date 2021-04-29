<?php

$link = mysqli_connect('localhost:3306' , 'root' , '');
if(! $link) {
    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}

mysqli_select_db($link , 'php');

$SQL = "select * from tasks ORDER by id DESC ";

if( $result = mysqli_query($link , $SQL) ) {
} else {
    echo 'error : ' . mysqli_error($link);
    exit;
}
$user_id = $_GET['user_id'];
//if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //var_dump($id);
    //$new_task = request('new_task');
    //$new_task = $_POST['new_task'];
    // $new_task = 'test';
    // var_dump($new_task);
    $query = "SELECT * FROM `tasks` WHERE 1";
    //var_dump($query);
    $result= mysqli_query($link, $query);
    //header("Refresh:0");
    if($result === false){
        var_dump(mysqli_error($link));
    }
//}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    .header {
        width: 80%;
        margin: 50px auto 0px;
        color: white;
        background: #5F9EA0;
        text-align: center;
        border: 1px solid #B0C4DE;
        border-bottom: none;
        border-radius: 10px 10px 0px 0px;
        padding: 20px;
            }
    form, .content, ul, table {
        width: 80%;
        margin: 0px auto;      
        background: white;
        border-radius: 0px 0px 10px 10px;

        }
    table tr {
    cursor: pointer;
    position: relative;
    padding: 12px 8px 12px 40px;
    background: #eee;
    font-size: 18px;
    transition: 0.2s;
    text-align: center;

    /* make the list items unselectable */
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    /* Set all odd list items to a different color (zebra-stripes) */
    table tr:nth-child(odd) {
    background: #f9f9f9;
    }

    /* Darker background-color on hover */
    table tr:hover {
    background: #ddd;
    }

</style>
</head>
<body>

    <div id="myDIV" class="header">
        <h2>History</h2>      
    </div> 

    <table>
        <th> Task </th>
        <th> Created at </th>
        <th> Update at </th>
        <?php  while ($task = mysqli_fetch_assoc($result) ) { 
             if($task['user_id'] == $user_id) {?>          
            <tr>
               
                
                <td><?= $task['name'] ?></td>
                <td> 
                    <?php  {
                        $old_date_timestamp = strtotime($task['created_at']);
                        $new_date = date('l, Y F d - h:i', $old_date_timestamp);                        
                        echo $new_date;
                     }?>
                </td>
                <td>
                    <?php if( $task['update_at'] != NULL) {
                         $old_date_timestamp = strtotime($task['update_at']);
                         $new_date = date('l, Y F d - h:i', $old_date_timestamp);                        
                         echo $new_date;
                     }?>
                        
                </td>
                
               
            </tr>
             <?php }
             } ?> 
        </table>
</body>
</html> 