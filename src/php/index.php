<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Private-Network: *');
header('Access-Control-Allow-Methods: OPTIONS, DELETE, POST, GET, PATCH, PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$servername = 'localhost';
$username = 'root';
$pass = '';

// Create connection
$conn =  mysqli_connect($servername, $username, $pass, 'sys_db');


// Check connection
if (!$conn) {
  die("Connection failed: " .mysqli_error($conn));
}

$received_data = json_decode(file_get_contents("php://input"));

if ($received_data->action == 'auth_user'){
    $pass = '';
    $result = mysqli_query($conn, "SELECT password FROM users WHERE username = '$received_data->data'");
    while($row = mysqli_fetch_assoc($result)) {
      $pass = $row["password"];
    }
    if($received_data->pass == $pass){
      echo 'GOOD';
    } else echo 'BAD';
}

if ($received_data->action == 'get_user'){
  $name = '';
  $result = mysqli_query($conn, "SELECT name FROM users WHERE username = '$received_data->data'");
  while($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
  }
  echo $name;
}

if ($received_data->action == 'get_role'){
  $role = '';
  $result = mysqli_query($conn, "SELECT roleId FROM users WHERE username = '$received_data->data'");
  while($row = mysqli_fetch_assoc($result)) {
    $role = $row["roleId"];
  }
  echo $role;
}

if ($received_data->action == 'find'){
  if($received_data->option == "1")
    $result = mysqli_query($conn, "SELECT username, name FROM users WHERE username LIKE '%$received_data->keyword%'");
  else if($received_data->option == "2")
    $result = mysqli_query($conn, "SELECT receiptid, amout, status FROM receipt WHERE receiptid LIKE '%$received_data->keyword%'");
  else if($received_data->option == "3")
    $result = mysqli_query($conn, "SELECT  reqID, username, content, status FROM request WHERE reqID LIKE '%$received_data->keyword%'");
    if(mysqli_num_rows($result) !=0){
  while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);
} else echo "null";
}

if ($received_data->action == 'usr'){
  $res = '';
  $result = mysqli_query($conn, "SELECT username, name FROM users WHERE roleId = 1");
  while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);
}

if ($received_data->action == 'req'){
  $res = '';
  $result = mysqli_query($conn, "SELECT username, reqID FROM request WHERE status = 0");
  while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);
}

if ($received_data->action == 'req2'){
  $res = '';
  $result = mysqli_query($conn, "SELECT  reqID, username, content, status FROM request");
  while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  echo json_encode($data);
}

if ($received_data->action == 'new_req'){
  $res = '';
  $result = mysqli_query($conn, "INSERT INTO `request`(`reqID`, `username`, `content`, `status`) VALUES ('$received_data->req_id','$received_data->usr','$received_data->req_content','0')");
  if ($result) echo "Gửi yêu cầu thành công";
  else "Gửi yêu cầu không thành công";
}

if ($received_data->action == 'reply'){
  $res = '';
  $result = mysqli_query($conn, "UPDATE `request` SET `status`='1',`response`='$received_data->content' WHERE `reqID`='$received_data->id'");
  if ($result) echo "Xử lý yêu cầu thành công";
  else "Xử lý yêu cầu không thành công";
}

if ($received_data->action == 'add_new_usr'){
  $res = '';
  $result = mysqli_query($conn, "INSERT INTO `users`(`username`, `password`, `roleId`) VALUES ('$received_data->usrname','$received_data->pw','1')");
  if ($result) {
    $message = "Sử dụng tên đăng nhập và mật khẩu sau để đăng nhập.";
    $message = wordwrap($message, 70);
    mail("hphuckhanh@gmail.com", "Tài khoản đăng nhập mới của bạn vào SmartWaterMeter đã được tạo", $message);  
    echo "200";
  } 
  else "";
}
?>
