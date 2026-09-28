<?php 

class users {

    function def(){
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Users</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=production&task=users&id=0&select=0","_self")' />
                        <input type="hidden" name="option" value="users">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> User Name </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT user_name, firstname, lastname, status FROM users ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['user_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['firstname'], "&nbsp", $cdr['lastname'];
                                    echo "</td>";
                                    if($cdr['status'] > 0){
                                        echo "<td class='text text-success text-center'>";
                                        echo "พร้อมใช้งาน";
                                        echo "</td>";
                                    }
                                    else{
                                        echo "<td class='text text-danger text-center'>";
                                        echo "ไม่พร้อมใช้งาน";
                                        echo "</td>";
                                        $active = "";
                                    }
                                        
                                    echo "<td>";
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=production&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=production&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=production&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                 }
                            ?>
                        </tbody>
        <?php
    }

    function edit(){
    ?>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>ลงทะเบียน</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">ชื่อ</label>
                                <input type="text" name="name" class="form-control" id="firstName" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">นามสกุล</label>
                                <input type="text" name="lastname" class="form-control" id="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">เบอร์โทร</label>
                                <input type="tel" name="phone" class="form-control" id="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">อีเมล</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" name="pass" class="form-control" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">ยืนยันรหัสผ่าน</label>
                                <input type="password" name="passconferm" class="form-control" id="confirmPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">เพศ</label>
                                <select class="form-select" name="gender" id="gender" required>
                                    <option value="" disabled selected>เลือกเพศ</option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    <option value="ไม่ระบุ">ไม่ระบุ</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="birthdate" class="form-label">วันเกิด</label>
                                <input type="date" name="birthdate" class="form-control" id="birthdate" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">ลงทะเบียน</button>
                            <input type='hidden' name='option' value='register' />
						    <input type='hidden' name='task' value='apply' />
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>มีบัญชีอยู่แล้ว? <a href="/jab/Login/index.php?option=logs&task=logs_form">เข้าสู่ระบบ</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    }
    function save(){
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $birth = $_POST['birthdate'];
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $password_1 = $_POST['passconferm'];
        $error = array();
        
        if(empty($name)){
            array_push($error, "name is required");
        }
        else if(empty($lastname)){
            array_push($error, "lastname is required");
        }
        else if(empty($phone)){
            array_push($error, "phone is required");
        }
        else if(empty($email)){
            array_push($error, "email is required");
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($error, "email is not collect");
        }
        else if(empty($birth)){
            array_push($error, "birthdate is required");
        }
        else if(empty($username)){
            array_push($error, "username is required");
        }
        else if(empty($password)){
            array_push($error, "password is required");
        }
        else if(strlen($password) > 20 || strlen($password) < 8){
            array_push($error, "password is required");
        }
        else if(empty($password_1)){
            array_push($error, "password is required");
        }
        else if($password != $password_1){
            array_push($error, "The two password not match");
        }
        else{
            $aa = 1;
            $conn = new connect();
            $conn = $conn->conn();
            $check_username = $conn->prepare("SELECT user_name FROM users WHERE user_name = :username");
            $check_username->bindParam(":username", $username);
            $check_username->execute();
            $rowd = $check_username->fetch(PDO::FETCH_ASSOC);
            if($rowd['user_name'] == $username){
                array_push($error, "The two password not match");
            } else if (count($error) == 0){
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users(username, password,  firstname, lastname, phone, email, status)
                                        VALUES(:user_name, :password, :firstname, :lastname, :phone, :email, :status)");
                $stmt->bindParam(":user_name", $username);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":firstname", $name);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":status", $aa);
                $stmt->execute();
            }
        }
    } 
}
?>