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
    <link rel="stylesheet" href="create-quiz.css">
    <link rel="icon" href="../images/logo_computer.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .box-create{
    height: 50%;
    margin-top: 30px;
    display: block;
    background-color:#e74c3c;
    padding: 10px;
    width: 95%;
    border: 2px solid #fff;
    border-radius: 10px;
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
                    <a href="../show-quiz-create/show-quiz.php" class="" style="margin-right: 10px;">
                        <i class="fas fa-user-plus fontawesome "></i>
                        ข้อสอบ</a>
                </li>
                <li style="cursor: pointer;">
                    <a href="create-quiz.php" class="" style="margin-right: 10px;">
                        <i class="fas fa-user-plus fontawesome "></i>
                        สร้างข้อสอบ</a>
                </li>
                <li style="cursor: pointer;">
                    <a href="../show-quiz-create/show-point.php" class="" style="margin-right: 10px;">
                        <i class="fas fa-user-plus fontawesome "></i>
                        ดูคะแนน</a>
                </li>
            </ul>
        </div>
        <div class="sidebar-bottom">
            <a href="../show-quiz-create/show-quiz.php" style="margin-right: 10px;" class="btn btn-logout">
                <i class="fa-solid fa-right-from-bracket style-icon-logout"></i>
                ออก</a>
        </div>
    </div>

    <div class="dashboard">
        <div class="box-create">
        <h1 style="text-align: center;">สร้างข้อสอบ</h1>
        <div style="margin: 20px;text-align: center; margin-top: 10px;">
            <form action="check-create-quiz.php" method="POST">

                <div>
                    <label for="">ชื่อแบบทดสอบ :</label>
                    <input type="text" name="quizname" required>
                </div>
                
                <div style="margin-top: 10px;">
                    <label for="">ประเภท : </label>
                    <input type="radio" name="exam" value="ทดสอบย่อย" required style="font-size: 20px;">
                    <label for="">ทดสอบย่อย</label>
                    <input type="radio" name="exam"  value="สอบกลางภาค" required>
                    <label for="">สอบกลางภาค</label>
                    <input type="radio" name="exam"  value="สอบปลายภาค" required>
                    <label for="">สอบปลายภาค</label>
                    <input type="radio" name="exam"  value="สอบมาตราฐานฝีมือแรงงาน" required>
                    <label for="">สอบมาตราฐานฝีมือแรงงาน</label>
                </div>

                <div style="margin-top: 10px;">
                    <label for="">ระดับการศึกษา : </label>
                    <input type="radio" name="edu" value="ปวช" required>
                    <label for="">ปวช</label>
                    <input type="radio" name="edu" id="" value="ปวส" required>
                    <label for="">ปวส</label>
                </div>

                <div style="margin-top: 10px;">
                    <label for="">จำนวนตัวเลือก : </label>
                    <input type="radio" name="choice" value="4 ตัวเลือก" required>
                    <label for="">4 ตัวเลือก</label>
                    <input type="radio" name="choice" id="" value="5 ตัวเลือก" required>
                    <label for="">5 ตัวเลือก</label>
                </div>

                <div style="margin-top: 10px;">
                    <label for=""จำนวน : </label>
                    <select name="quanlity" id="" required>
                    <?php
                    for($i = 1; $i<=100; $i++){
                        echo "<option value='$i'";
                        echo ($row['scpe_grades_status'] == $i) ? " selected='selected'": "";
                        echo ">$i"."</option>";
                    }
                        ?>
                    </select>
                    <label for="">คะแนน : </label>
                    <select name="point" id="" required>
                       <?php
                    for($i = 1; $i<=100; $i++){
                        echo "<option value='$i'";
                        echo ($row['scpe_grades_status'] == $i) ? " selected='selected'": "";
                        echo ">$i"."</option>";
                    }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" name="submit" class="btn-submit" >บันทึก</button>
                </div>
                </div>
            </form>
        </div>
    </div>








    <script src="script.js"></script>
</body>

</html>