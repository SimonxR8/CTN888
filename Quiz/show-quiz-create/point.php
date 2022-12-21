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


        </div>
        <div class="sidebar-bottom">
            <a href="show-quiz.php" style="margin-right: 10px;" class="btn btn-logout">
                <i class="fa-solid fa-right-from-bracket style-icon-logout"></i>
                ออก</a>
        </div>
    </div>

    <div class="dashboard">
        <h1 style="text-align: center;">รายชื่อนักเรียนที่เข้าทำแบบทดสอบ</h1>
        <table>
            <tr>
                <th>ลำดับ</th>
                <th>รหัสประจำตัว</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>คะแนน</th>
                <th>ลบ</th>

            </tr>
            <form action="delete_point.php" method="post">
                <?php
                $id = $_GET['id'];
                include('connectdb.php');
                $sql = "SELECT * FROM score where quiz_id = '$id' ";
                $result = mysqli_query($conn, $sql);
                $order = 1;

                // loop ข้อมูล
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id2">
                    <tr>
                        <input type="hidden" value="<?php echo $row['id']?>" name="id1">
                        <td><?php echo $order++ ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['score']; ?> คะแนน</td>
                        <td><button type="submit" name="delete_point" class="remove" onclick="return confirm('คุณต้องการลบหรือไม่!?')">ลบ<i class="fa-regular fa-trash-can fontawesome"></i></button></td>
                    </tr>
                <?php } ?>
        </table>
        <input type="hidden" value="<?php echo $id ?>" name="id2">
    </form>
    </div>
    <script src="script.js"></script>
</body>

</html>