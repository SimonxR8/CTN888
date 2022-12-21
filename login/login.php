
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบทดสอบออนไลน์</title>
    <link rel="icon" href="images/technic1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav>
        <div class="logo-nav">
            <a href="login.php" class="A-logo">ระบบแบบทดสอบออนไลน์</a>
        </div>
        <div class="menu-nav">
            <ul>
                <li><a href="login.php" class="A-hover"><i class='bx bxs-home'></i></i>หน้าแรก</a></li>
                <li><a target="_blank" href="http://www.ctnphrae.com/" class="A-hover"><i class='bx bxs-dashboard' ></i>เว็บเทคนิคคอม</a></li>
                <li><a target="_blank" href="https://www.technicphrae.ac.th/" class="A-hover"><i class='bx bxs-dashboard' ></i>เว็บเทคนิคแพร่</a></li>
                <li><a target="_blank" href="https://www.facebook.com/ctnphrae10" class="A-hover"><i class='bx bxl-facebook-square'></i>เพจเทคนิคคอม</a></li>
                <li><a target="_blank" href="https://www.facebook.com/pr.technicphrae" class="A-hover" style="margin-right: 5px;"><i class='bx bxl-facebook-square'></i>เพจเทคนิคแพร่</a></li>
            </ul>
        </div>
    </nav>
    <div class="body">
        <div class="content">
            <div class="box-content">
                   <h1 style="font-size: 40px; margin-bottom: 20px;">ระบบแบบทดสอบออนไลน์</h1>
              <div class="login login-syle">
                    <a href="login_student.php">
                        <button id="student" type="submit" onclick="student()">
                        <i class="fa-solid fa-user fontawesome"></i>Student</button>
                    </a>
                    <a href="login_teacher.php">
                        <button id="teacher" type="submit" onclick="">
                        <i class="fa-solid fa-user-tie fontawesome"></i>Teacher</button>
                    </a>
                    <a href="login_addmin.php">
                        <button id="addmin" type="submit" onclick="">
                        <i class="fa-solid fa-user-gear fontawesome"></i>Admin</button>
                    </a>
              </div>
            </div>
        </div>
    </div>


    <script src="login.js"></script>
</body>
</html>