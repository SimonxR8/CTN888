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
    <link rel="stylesheet" href="addquestion.css">
    <link rel="icon" href="../images/logo_computer.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    :root {
    --theme-primary: #6F1E51;
    --theme-sub: #8e44ad;
    --theme-cut: #fff;
    --theme-cut-sub: #f1c40f;
    --theme-fade-f7: #f7f7f7;
    --theme-fade-e5: #e5e5e5;
    --theme-fade-ad: #adadad;
    --danger: #EA2027;
    --warning: #FFC312;
    --success: #1abc9c;
    --info: #3498db;
    --liner1: linear-gradient(to bottom, #929b92, #a8b4b1, #c4ccce, #e2e5e7, #ffffff);
}
    .btn-logout {
    background: #EA2027;
    color: #fff;
    border-radius: 10px;
    margin: 30px;
}

.btn-logout:hover {
    background: #fff;
    color: #000;
    font-weight: bold;
}
</style>
<body>

    <div class="sidebar">
        <div class="sidebar-top">
            <div class="sb-logo" style="width: 200px;">
                <!-- <a href="index.php"> -->

                <img class='image' src='<?php if ($row['member_img'] == '') echo './images/img_avatar.png';
                                        else echo '../../../../Page/teacher/uploads/' . $row['member_img']; ?>' width='167px' height='166px'>
                </a>
                <h3 style="text-align: center; margin-top: 10px; color:#fff;"><?php echo $row['member_title'] . " " . $row['member_firstname'] . " " . $row['member_lastname'] ?></h3>
                <hr width="100%" style="margin-top: 10px;">
            </div>

            <ul class="sb-ul" style="margin-top: 50px;">
                <li style="cursor: pointer;">

                </li>
            </ul>
        </div>
        <?php

        $id = $_GET['id'];
        include('connectdb.php');
        $sql = "SELECT * FROM question5 WHERE id = '$id' ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        ?>
        <div class="sidebar-bottom">
            <a href="../addquestion.php?id=<?php echo $row['questionid'];?>" style="margin-right: 10px;" class="btn btn-logout">
                <i class="fa-solid fa-right-from-bracket">
                </i>ออก</a>
        </div>
    </div>

    <div class="dashboard">
        <form action="check_addquestion.php" method="post">
        
            <div style="background-color: rgba(0, 0, 0, 0.2); border-radius: 5px; padding: 30px; margin: 10px; margin-top: 0; display: flex; justify-content: center; ">
                <div>
                    <div style="display: flex; align-items: center;justify-content: center; margin: 15px;">
                        <label for="" style="margin-right: 5px;">โจทย์ :</label>
                        <textarea name="questionname" cols="25" rows="8"><?php echo $row['questionname'];?></textarea>
                    </div>
                    <div style="display: flex; justify-content: center; margin: 15px;">
                        <div style="display: flex; align-items: center;justify-content: center; margin-right: 30px;">
                            <label for="" style="margin-right: 5px;">ก :</label>
                            <textarea name="c-1" cols="25" rows="7"><?php echo $row['choice1'];?></textarea>
                        </div>
                        <div style="display: flex; align-items: center;justify-content: center;">
                            <label for="" style="margin-right: 5px;">ข :</label>
                            <textarea name="c-2" cols="25" rows="7"><?php echo $row['choice2'];?></textarea>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center;justify-content: center;">
                        <div style="display: flex; align-items: center;justify-content: center;margin-right: 30px;">
                            <label for="" style="margin-right: 5px;">ค :</label>
                            <textarea name="c-3" cols="25" rows="7"><?php echo $row['choice3'];?></textarea>
                        </div>
                        <div style="display: flex; align-items: center;justify-content: center;margin-right: 30px;"">
                            <label for="" style="margin-right: 5px;">ง :</label>
                            <textarea name="c-4" cols="25" rows="7"><?php echo $row['choice4'];?></textarea>
                        </div>
                        <div style="display: flex; align-items: center;justify-content: center;">
                            <label for="" style="margin-right: 5px;">จ :</label>
                            <textarea name="c-5" cols="25" rows="7"><?php echo $row['choice5'];?></textarea>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; margin: 10px;">
                        <label for="" style="margin-right: 5px;">คำตอบ :</label>
                        <select name="answer">
                            <option value="ก">ก</option>
                            <option value="ข">ข</option>
                            <option value="ค">ค</option>
                            <option value="ง">ง</option>
                            <option value="จ">จ</option>
                        </select>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
                        <button type="submit" name="submit" class="btn-submit">บันทึก</button>
                    </div>
        
    </div> 
    </div>
        </form>
    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>