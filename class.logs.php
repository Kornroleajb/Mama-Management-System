<?php 

class logs {
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Logs</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input type="hidden" name="option" value="logs">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> user Name </th>
                                <th class="text-center"> Action</th>
                                <th class="text-center"> Time </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT logs.action AS action, logs.datetime AS datetime, us.username AS username
                                        FROM logs 
                                        LEFT JOIN users AS us ON logs.uid = us.id 
                                        ORDER BY logs.id DESC";
                                $conn = new connect();
                                $a = 1;
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['username'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['action'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['datetime'];
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                 }
                            ?>
                        </tbody>
        <?php 
    }
    function logs_form(){
        if(empty($_SESSION['user'])){
            $_SESSION['user'] = '';
        }
        ?>
        <br/>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center">เข้าสู่ระบบ</h2>

            <!-- ฟอร์ม Login -->
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" name="user" class="form-control"  placeholder="กรอกชื่อผู้ใช้" value="<?php echo $_SESSION['user'] ; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" name="pass" class="form-control"  placeholder="กรอกรหัสผ่าน" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
                <input type='hidden' name='option' value='logs' />
				<input type='hidden' name='task' value='login' />
            </form>

           <?php 
           if(isset($_SESSION['error'])){
           ?>
            <div class="text-danger mt-3">
                <?php echo $_SESSION['error'] ;
                unset($_SESSION['error'] );
                unset($_SESSION['user'] ); ?>
            </div>
            <?php 
           }
            ?>
        </div>
    </div>
</div>

<?php 
    }

    function login()
	{
        $conn = new connect();
        $pdo = $conn->conn();
		$user = $_POST['user'];
        $pass = $_POST['pass'];
        $_SESSION['user'] = $user ;
        

    // เตรียมคำสั่ง SQL
        $sql = "SELECT * FROM `users` WHERE `status` = '1' AND `username` = :user ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $cdr = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบผลลัพธ์
        if($stmt->rowCount() > 0){
            if($user == $cdr['username']){
                if(password_verify($pass, $cdr['password'])){
                    $_SESSION['uid'] = $cdr['id'];
                    header('location:/project_mama/index.php?option=PR&task=def');
                    $conn = new connect();
                    $conn->save_logs("login", $_SESSION['uid']);
                }
                else {
                    $error = "รหัสผ่านไม่ถูกต้องกรุณากรอกใหม่";
                    $_SESSION['error'] = $error;
                    $conn = new connect();
                    $conn->save_logs("cannot login", $cdr['id']);
                    header('location:/project_mama/index.php?option=logs&task=logs_form');
                    
                }

            }else {
                $error = "ข้อมูลผู้ใช้ไม่ถูกต้องกรุณากรอกใหม่";
                $conn = new connect();
                $conn->save_logs("cannot login", 0);
                header('location:/project_mama/index.php?option=logs&task=logs_form');
            }
        } else {
            $error = "ไม่มีข้อมูลผู้ใช้ในระบบ";
            $_SESSION['error'] = $error;
            $conn = new connect();
            $conn->save_logs("cannot login", 0);
            header('location:/project_mama/index.php?option=logs&task=logs_form');
            
            }
        }
    
    function logout()
	{	
        $conn = new connect();
        $conn->save_logs("loguot", $_SESSION['uid']);
		session_destroy();
		header('location: index.php');
	}
		
    }

    ?>