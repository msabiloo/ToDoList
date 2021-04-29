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
$user_id = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //var_dump($id);
    //$new_task = request('new_task');
    $new_task = $_POST['new_task'];
    // $new_task = 'test';
    // var_dump($new_task);
    $query = "INSERT INTO `tasks` (`user_id`,`name`) VALUE ($user_id, '$new_task')";
    //var_dump($query);
    $result= mysqli_query($link, $query);
    header("Refresh:0");
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
        /* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
    }
.header {
    width: 50%;
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
            width: 50%;
            margin: 0px auto;      
            background: white;
            border-radius: 0px 0px 10px 10px;

        }
        
      

/* Style the list items */
table tr {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;

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

/* When clicked on, add a background color and strike out text */
table tr.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
table tr.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}

/* Style the close button */
.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
}

.close:hover {
  background-color: #f44336;
  color: white;
}

/* Style the header */
.header {
  background-color: #5f9ea0;
  padding: 30px 40px;
  color: white;
  text-align: center;
}

/* Clear floats after the header */
.header:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the input */
input {
  margin: 0;
  border: none;
  border-radius: 0;
 
  padding: 10px;
  float: left;
  font-size: 16px;
}

/* Style the "Add" button */
.addBtn {
  padding: 10px;
  width: 25%;
  background: #d9d9d9;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}

.addBtn:hover {
      background-color: #bbb;
    }




    </style>
</head>
<body>

    <div id="myDIV" class="header">
        <h2>My To Do List</h2>      
        <form method='post' action="task.php?id=<?=$user_id ?>">
       
            <input type="text" name="new_task" id="myInput" placeholder="Title...">
        <!--  <span onclick="newElement()" class="addBtn">Add</span> -->
            <button  type="submit" class="addBtn" name="add_task" > Add </button>
            </form>
            <button  type="submit" class="addBtn" name="add_task" >
            
             <a href="/history.php?user_id=<?=$user_id?>"> History </a>
             </button>
    </div>  
  
        <?php  while ($task = mysqli_fetch_assoc($result) ) { 
             if($task['user_id'] == $user_id) {?>          
            <tr>
                <td>
                    <input type="checkbox" style='height: 20px; width: 20px;' value="<?=$task['id']?>">
                    <span class="checkmark"></span>
                    <?php if(checked) {} ?>
                  </td>
                <td><?= $task['name'] ?></td>
                <td>
               
                  <a href="/edit.php?user_id=<?=$user_id?>&id=<?=$task['id']?>"> edit </a>
                </td>
                <td>
                  <a href="/delete.php?user_id=<?=$user_id?>&id=<?=$task['id']?>">  delete </a>
               </td>
               
            </tr>
             <?php }
             } ?> 
        </table>  
</body>
</html>