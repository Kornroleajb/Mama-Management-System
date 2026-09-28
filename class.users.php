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
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=users&task=edit&type=1","_self")' />
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
                                 $sql = "SELECT  id, username, firstname, lastname, status FROM users ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['username'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['firstname'], "&nbsp", $cdr['lastname'];
                                    echo "</td>";
                                    if($cdr['status'] > 0){
                                        echo "<td class='text text-success text-center'>";
                                        echo "พร้อมใช้งาน";
                                        echo "</td>";
                                        $active = "active";
                                    }
                                    else{
                                        echo "<td class='text text-danger text-center'>";
                                        echo "ไม่พร้อมใช้งาน";
                                        echo "</td>";
                                        $active = "";
                                    }
                                    echo "<td>";
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=users&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit Name' onclick='window.open(\"index.php?option=users&task=edit_name&id=".$cdr['id']."&type=2\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit Pass' onclick='window.open(\"index.php?option=users&task=edit_pass&id=".$cdr['id']."&type=3\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=users&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                }
                            ?>
                        </tbody>
                        </table>
        <?php
    }
    function det(){
        $uid = $_REQUEST['id'];
        $sql = "SELECT * FROM users WHERE id = $uid";
        $conn = new connect();
        $res = $conn->query($sql);
        $cdr = $res->fetch();
    ?>
    <div class="container">
        <div class ="row">
            <div class = "col-12">
                <form action='index.php' method='POST'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Data User</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td>UID</td>
                                <td><?php echo $cdr['id'];?></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้ใช้</td>
                                <td><?php echo $cdr['username'];?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $cdr['firstname'],"&nbsp",$cdr['lastname'];?></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร</td>
                                <td><?php echo $cdr['phone'];?></td>
                            </tr>
                            <tr>
                                <td>อีเมล</td>
                                <td><?php echo $cdr['email'];?></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=users&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php 
    }
    function edit(){
        $type = $_REQUEST['type'];
    ?>
    <div class="container">
        <div class ="row">
            <div class = "col-12">
                <form action='index.php' method='POST'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Add Data User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อ</td>
                                <td><input type="text" name="name" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>นามสกุล</td>
                                <td><input type="text" name="lastname" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร</td>
                                <td><input type="tel" name="phone" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>อีเมล</td>
                                <td><input type="email" name="email" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>ชื่อผู้ใช้</td>
                                <td><input type="text" name="username" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>รหัสผ่าน</td>
                                <td><input type="password" name="pass" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>ยืนยันรหัสผ่าน</td>
                                <td><input type="password" name="passconferm" class="form-control-sm" required></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
                                <input type='hidden' name='type' value='<?php echo $type; ?>' />
                                <input type='hidden' name='option' value='users' />
						        <input type='hidden' name='task' value='save' />
                                <input type='submit' class='btn btn-primary btn-sm' type='button' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=users&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php 
    }
    function edit_name(){
        $uid = $_REQUEST['id'];
        $type = $_REQUEST['type'];
        $sql = "SELECT firstname, lastname, phone, email FROM users WHERE id = $uid";
        $conn = new connect();
        $res = $conn->query($sql);
        $cdr = $res->fetch();
    ?>
    <div class="container">
        <div class ="row">
            <div class = "col-12">
                <form action='index.php' method='POST'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Edit Data User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อ</td>
                                <td><input type="text" name="name" class="form-control-sm" value="<?php echo $cdr['firstname']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>นามสกุล</td>
                                <td><input type="text" name="lastname" class="form-control-sm" value="<?php echo $cdr['lastname']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทร</td>
                                <td><input type="tel" name="phone" class="form-control-sm" value="<?php echo $cdr['phone']; ?>" required></td>
                            </tr>
                            <tr>
                                <td>อีเมล</td>
                                <td><input type="email" name="email" class="form-control-sm" value="<?php echo $cdr['email']; ?>" required></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
                                <input type='hidden' name='uid' value='<?php echo $uid; ?>' />
                                <input type='hidden' name='type' value='<?php echo $type; ?>' />
                                <input type='hidden' name='option' value='users' />
						        <input type='hidden' name='task' value='save' />
                                <input type='submit' class='btn btn-primary btn-sm' type='button' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=users&task=def","_self")' />
							</td>
						</tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
    </div>
<?php   
    }   
    function edit_pass(){
        $uid = $_REQUEST['id'];
        $type = $_REQUEST['type'];
        ?>
    <div class="container">
        <div class ="row">
            <div class = "col-12">
                <form action='index.php' method='POST'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Edit Data User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>รหัสผ่านเดิม</td>
                                <td><input type="password" name="password_old" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>รหัสผ่านใหม่</td>
                                <td><input type="password" name="pass" class="form-control-sm" required></td>
                            </tr>
                            <tr>
                                <td>ยืนยันรหัสผ่านใหม่</td>
                                <td><input type="password" name="passconferm" class="form-control-sm" required></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
                                <input type='hidden' name='uid' value='<?php echo $uid; ?>' />
                                <input type='hidden' name='type' value='<?php echo $type; ?>' />
                                <input type='hidden' name='option' value='users' />
						        <input type='hidden' name='task' value='save' />
                                <input type='submit' class='btn btn-primary btn-sm' type='button' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=users&task=def","_self")' />
							</td>
						    </tr>
                        </tbody>
                        </table>
                </form>
            </div>
        </div>
    </div>
<?php   
    }
    function save(){
        $type_save = $_REQUEST['type'];
        if($type_save == 1){
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['pass'];
            $password_1 = $_POST['passconferm'];
            $error = array();
            $conn = new connect();

            if(empty($name)){
                array_push($error, "กรุณากรอกชื่อ");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit&type=1');
            }
            else if(empty($lastname)){
                array_push($error, "กรุณากรอกนามสกุล");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(empty($phone)){
                array_push($error, "กรุณากรอกเบอร์โทร");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(empty($email)){
                array_push($error, "กรุณากรอก Email");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($error, "กรุณากรอก Email ให้ถูกต้อง");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(empty($username)){
                array_push($error, "กรุณากรอก user name");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(empty($password)){
                array_push($error, "กรุณากรอก password");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(strlen($password) > 21 || strlen($password) < 7){
                array_push($error, "กรุณากรอก password 8-20 ตัวอักษร");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if(empty($password_1)){
                array_push($error, "กรุณากรอก password");
                $conn->alert($error[0],2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else if($password != $password_1){
                array_push($error, "กรุณากรอก password ให้ตรงกัน");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edittype=1');
            }
            else{
                $aa = 1;
                $conn = new connect();
                $conn = $conn->conn();
                $check_username = $conn->prepare("SELECT username FROM users WHERE username = :username");
                $check_username->bindParam(":username", $username);
                $check_username->execute();
                $rowd = $check_username->fetch(PDO::FETCH_ASSOC);
                if($rowd['username'] == $username){
                    array_push($error, "มีชื่อผู้ใช้นี้แล้ว");
                    $conn->alert($error[0], 2);
                    header('location:index.php?option=users&task=edittype=1');
                }
                else if (count($error) == 0){
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(username, password, firstname, lastname, email, phone, status)
                                            VALUES(:username, :password, :firstname, :lastname, :email, :phone, :status)");
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":firstname", $name);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":status", $aa);
                    $stmt->execute();
                    $conn = new connect();
                    $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
                    header('location:index.php?option=users&task=def');
                }
            }
        }
        else if($type_save == 2){
            $uid = $_REQUEST['uid'];
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $error = array();
            $conn = new connect();
            

            if(empty($name)){
                array_push($error, "กรุณากรอกชื่อ");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_name&id='.$uid.'&type=2');
            }
            else if(empty($lastname)){
                array_push($error, "กรุณากรอกนามสกุล");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_name&id='.$uid.'&type=2');
            }
            else if(empty($phone)){
                array_push($error, "กรุณากรอกเบอร์โทร");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_name&id='.$uid.'&type=2');
            }
            else if(empty($email)){
                array_push($error, "กรุณากรอก Email");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_name&id='.$uid.'&type=2');
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($error, "กรุณากรอก Email ให้ถูกต้อง");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_name&id='.$uid.'&type=2');
            }
            else{
                $conn = $conn->conn();
                if (count($error) == 0){
                    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, WHERE id = :id");
                    $stmt->bindParam(":id", $uid);
                    $stmt->bindParam(":firstname", $name);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->execute();
                    $conn = new connect();
                    $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
                    header('location:index.php?option=users&task=def');
                }
            }
        }
        else if($type_save == 3){
            $uid = $_REQUEST['uid'];
            $password_old = $_POST['password_old'];
            $password = $_POST['pass'];
            $password_1 = $_POST['passconferm'];
            $error = array();
            $conn = new connect();

            
            if(empty($password_old)){
                array_push($error, "กรุณากรอก password เดิม");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_pass&id='.$uid.'&type=3');
            }
            else if(empty($password)){
                array_push($error, "กรุณากรอก password");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_pass&id='.$uid.'&type=3');
            }
            else if(strlen($password) > 21 || strlen($password) < 7){
                array_push($error, "กรุณากรอก password 8-20 ตัวอักษร");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_pass&id='.$uid.'&type=3');
            }
            else if(empty($password_1)){
                array_push($error, "กรุณากรอก password");
                $conn->alert($error[0],2);
                header('location:index.php?option=users&task=edit_pass&id='.$uid.'&type=3');
            }
            else if($password != $password_1){
                array_push($error, "กรุณากรอก password ให้ตรงกัน");
                $conn->alert($error[0], 2);
                header('location:index.php?option=users&task=edit_pass&id='.$uid.'&type=3');
            }
            else{
                $conn = new connect();
                $conn = $conn->conn();
                $check_password = $conn->prepare("SELECT password FROM users WHERE id = :id");
                $check_password->bindParam(":id", $uid);
                $check_password->execute();
                $rowd = $check_password->fetch(PDO::FETCH_ASSOC);
                if (count($error) == 0){
                    if(password_verify($password_old, $rowd['password'])){
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
                        $stmt->bindParam(":id", $uid);
                        $stmt->bindParam(":password", $passwordHash);
                        $stmt->execute();
                        $conn = new connect();
                        $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
                        header('location:index.php?option=users&task=def');
                    }
                    else{
                        array_push($error, "กรุณากรอก password ให้ตรง password เดิม");
                        $conn = new connect();
                        $conn->alert($error[0], 2);
                        header('location:index.php?option=users&task=edit_pass&id='.$uid.'&type=3');
                    }
                }
            }
        }
    }   
}   
?>  