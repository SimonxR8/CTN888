<?php

include('connectdb.php');
$sql = "SELECT * FROM score";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$id1 = $_POST['id1'];
$id2 = $_POST['id2'];

// echo $id1;
// echo $id2;

$sql = "DELETE FROM score WHERE id= '$id1' ";
if($conn->query($sql) == TRUE){
    echo "<script>window.alert('ลบข้อสอบเรียบร้อยแล้ว'); window.location = 'point.php?id=$id2';</script>";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>