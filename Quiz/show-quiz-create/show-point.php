<?php
include("./connectdb.php");
session_start();
$sql = "SELECT * FROM tb_member INNER JOIN jointthectn_tb ON tb_member.member_code=jointthectn_tb.member_code where tb_member.member_code='" . $_SESSION['username'] . "'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

if ($row['member_code'] == '') {
    $sql = "SELECT * FROM tb_member where member_code='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    $conn->close();
}

if ($_SESSION['username'] != $row['member_code'] || $_SESSION['username'] == '') {
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="show-quiz.css">
    <link rel="icon" href="../images/logo_computer.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
   <style>
    .fontawesome {
    font-size: 1.3rem;
    margin-right: 15px;
}
   </style>
    
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-top">
            <div class="sb-logo" style="width: 200px;">
                <!-- <a href="index.php"> -->

                <img class='image' src='<?php if ($row['member_img'] == '') echo './images/img_avatar.png';
                                        else echo '../../Page/teacher/uploads/' . $row['member_img']; ?>' width='167px' height='166px'>
                </a>
                <h3 class="h3-style"><?php echo $row['member_title'] . " " . $row['member_firstname'] . " " . $row['member_lastname'] ?></h3>
                <hr width="100%" style="margin-top: 10px;">
            </div>

            <ul class="sb-ul" style="margin-top: 50px;">
                <li style="cursor: pointer;">
                    <a href="show-quiz.php" class="" style="margin-right: 10px;">
                        <i class="fas fa-user-plus fontawesome "></i>
                        ข้อสอบ</a>
                </li>
                <li style="cursor: pointer;">
                    <a href="../create_quiz/create-quiz.php" class="" style="margin-right: 10px;">
                        <i class="fas fa-user-plus fontawesome "></i>
                        สร้างข้อสอบ</a>
                </li>
                <li style="cursor: pointer;">
                    <a href="show-point.php" class="" style="margin-right: 10px;">
                        <i class="fas fa-user-plus fontawesome "></i>
                        ดูคะแนน</a>
                </li>
            </ul>
        </div>
        <div class="sidebar-bottom">
            <a href="../../Page/teacher/teacher_page.php" style="margin-right: 10px;" class="btn btn-logout">
                <i class="fa-solid fa-right-from-bracket style-icon-logout"></i>
                ออก</a>
        </div>
    </div>

    <div class="dashboard">
        <h1 style="text-align: center;">ข้อสอบที่สร้าง</h1>
        <table>
            <tr>
                <th>ชุดที่</th>
                <th>ชื่อแบบทดสอบ</th>
                <th>ประเภท</th>
                <th>จำนวนตัวเลือก</th>
                <th>ระดับการศึกษา</th>
                <th>จำนวนข้อ</th>
                <th>คะแนน</th>
                <th>ดูคะแนน</th>
                
            </tr>
            <form action="allbutton.php" method="post">
                <?php
                include('connectdb.php');
                $sql = "SELECT * FROM ceate_quiz";
                $result = mysqli_query($conn, $sql);
                $order = 1;

                // loop ข้อมูล
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <input type="hidden" value="<?php echo $row['choice']; ?>" name="choice">
                    <tr >
                        <td><?php echo $order++ ?></td>
                        <td><?php echo $row['quizname']; ?></td>
                        <td><?php echo $row['exam']; ?></td>
                        <td><?php echo $row['choice']; ?></td>
                        <td><?php echo $row['edu']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['points']; ?></td>
                        
                       <td><a href="point.php?id=<?php echo $row['id']?>" class="add">ดูคะแนน</ฟ></td>
                    </tr>
                <?php } ?>
            </form>
        </table>
    </div>
    <script src="script.js"></script>
</body>

</html>