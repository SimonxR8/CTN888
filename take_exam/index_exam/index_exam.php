<?php
include("connectdb.php");
session_start();
$sql = "SELECT * FROM tb_member INNER JOIN tb_student_level ON tb_member.member_id=tb_student_level.member_id where tb_member.member_code='" . $_SESSION['username'] . "'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$student = $row['student_level'];

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
    <title>เข้าทำแบบทดสอบ</title>
    <link rel="stylesheet" href="index_exam.css">
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    width: 100%;
    height: 100vh;
    background: url('https://images.unsplash.com/photo-1585432959315-d9342fd58eb6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}
.main{
    display: flex;  
}
.box{
    margin: 10px;
    border: 2px solid #000;
    padding: 20px;
    border-radius: 10px;
    font-size: 20px;
    width: 280px;
    cursor: pointer;
    background: rgba(0, 0, 0, 0.3);
}

.link_exam{
    border: 2px solid #000;
    border: none;
    text-decoration: none;
}
.box:hover{
    transform: scale(1.05);
    transition: .3s;
}

.submain{
    margin: 10px;
    /* border: 2px solid #000; */
    padding: 10px;
    /* border-radius: 10px;
    font-size: 20px; */
}

label{
    color: #000;
    margin-right: 5px;
}

.detail{
    display: flex;
    color: #ecf0f1;
    box-shadow: 2px 2px 2px #000;
}

.long{
    margin-left: 100px;
}

.detail-long{
    width: 235px;
    box-shadow: 2px 2px 2px #000;
    color: #ecf0f1;
}

.status1{
    border: 2px solid #2980b9;
    padding: 5px;
    background-color: #2980b9;
    color: #ecf0f1;
    border-radius: 5px;
    box-shadow: 1px 3px 5px #000;
    cursor: pointer;
}

.status2{
    border: 2px solid #2980b9;
    padding: 5px;
    background-color: #2980b9;
    color: #ecf0f1;
    border-radius: 5px;
    box-shadow: 1px 3px 5px #000;
    cursor: pointer;
}

.close{
    color: #ecf0f1;
    border: 2px solid #e74c3c;
    padding: 5px;
    border-radius: 5px;
    background-color: #e74c3c;
    box-shadow: 1px 3px 5px #000;
    cursor: pointer;
}
.open{
    color: #ecf0f1;
    border: 2px solid #2ecc71;
    padding: 5px;
    border-radius: 5px;
    background-color: #2ecc71;
    box-shadow: 1px 3px 5px #000;
    cursor: pointer;
}

nav{
    width: 100%;
    height: 70px;
    background-color: #d63031;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.back{
    font-size: 17px;
    padding: 5px 10px;
    background-color: #3498db;
    border: none;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    box-shadow: 1px 1px 5px #000;
}
.back:hover{
    background-color: #2980b9;
}
    </style>
    
</head>
<body>
    <nav>
        <div style="margin-left: 10px;">
            <form action="check_exam.php" method="post">
                <button type="submit" name="back" class="back">กลับ</button>
            </form>
        </div>

        <div style="display: flex; align-items: center; margin-right: 10px;">   
        <img class='image' src='<?php if ($row['member_img'] == '') echo '../images/img_avatar.png';
                                        else echo '../../Page/student/uploads/' . $row['member_img']; ?>' width='60px' height='60px' style="margin-right: 10px;">
            <p style="color: #fff;"><?php echo $row['member_title'];?> <?php echo $row['member_firstname'];?> <?php echo $row['member_lastname']?></p>
        </div>

    </nav>
    <div class="main">
            <?php
                include('connectdb.php');
                $sql = "SELECT * FROM ceate_quiz WHERE statuss = '1' AND edu = '$student' ";
                $result = mysqli_query($conn, $sql);
                $order = 1; 
                // echo $student;
    
                // loop ข้อมูล
                while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="submain">
             <a href="check_exam.php?choice=<?php echo $row['choice'] ?>&id=<?php echo $row['id'] ?>" class="link_exam">
                <div class="box">
                <div class="detail">
                    <label>ชื่อขอสอบ :</label> 
                    <p><?php echo $row['quizname'];?></p>
                </div>
                <br>

                <?php if($row['exam'] == "สอบมาตราฐานฝีมือแรงงาน") {?>
                <div class="detail-long">
                    <label>ประเภท :</label>
                    <p><?php echo $row['exam'];?></p>
                </div>
                <?php }else { ?>
                <div class="detail">
                    <label>ประเภท :</label> 
                    <p><?php echo $row['exam'];?></p>
                </div>
                <?php } ?>

                <br>
                <div class="detail">
                    <label>ระดับการศึกษา :</label> 
                    <p><?php echo $row['edu'];?></p>
                </div>
                <br>
                <div class="detail">
                    <label>จำนวนตัวเลือก :</label> 
                    <p><?php echo $row['choice'];?></p>
                </div>
                <br>
                <div class="detail">
                    <label>จำนวนข้อ :</label> 
                    <p><?php echo $row['quantity'];?></p>
                </div>
                <br>
                <div class="detail">
                    <label>คะแนน :</label> 
                    <p><?php echo $row['points'];?></p>
                </div>
                <br>
                <!-- <?php if($row['statuss'] == "0") {?>
                    <label class="status1">สถานะ</label>
                    <label class="close">ปิด</label>
                    <input type="hidden" value="<?php echo $row['statuss']?>">
                <?php }else { ?>
                    <label class="status2">สถานะ</label>
                    <label class="open">เปิด</label>        
                    <input type="hidden" value="<?php echo $row['statuss']?>">
                <?php } ?> -->
            </div>
            </a>
        </div>     
        <?php } ?>
    </div>
</body>
</html>