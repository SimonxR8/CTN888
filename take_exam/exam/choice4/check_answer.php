<?php
include('connectdb.php');
$by = $_POST['by'];
$student_id = $_POST['student_id'];
$quiz_id = $_POST['quiz_id'];
$title = $_POST['title'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$test = 'คะแนน';
echo $student_id;

for ($i=1; $i <= $by ; $i++) { 
    $answer = $_POST["anshidden".$i];
     $ans = $_POST["ans".$i];
     if($answer == $ans){
         $score++;
     }
 }
 
 $sql = "INSERT INTO score (score,student_id,quiz_id,title,firstname,lastname) values ('$score','$student_id','$quiz_id','$title','$firstname','$lastname')";
 if ($conn->query($sql) === TRUE) {
    echo "โดนเกย์เรียบร้อย";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

echo "<script>window.alert('คุณได้ $score คะแนน'); window.location = '../../index_exam/index_exam.php';</script>";



?>
