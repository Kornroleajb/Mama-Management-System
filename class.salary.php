<?php 
class salary{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Salary Employee Data</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=salary&task=edit&id=0","_self")' />
                        <input class="btn btn-info btn-sm" type="button" value="Paysalary" onclick='window.open("index.php?option=salary&task=paysalary","_self")' />
                        <input type="hidden" name="option" value="salary">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> date </th>
                                <th class="text-center"> Salary </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT salary.id AS id, salary.date AS date, salary.salary AS salary, salary.status AS status, emp.name AS name, emp.sirname AS sirname FROM salary INNER JOIN employee AS emp ON salary.emp_id = emp.id ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['name'], "&nbsp", $cdr['sirname'];
                                    echo "</td>";
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['date'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo number_format($cdr['salary'], 2);
                                    echo "</td>";
                                    
                                    if($cdr['status'] == 1 ){
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=salary&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=salary&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=salary&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=salary&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=salary&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                        }
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                
                                 }
                            ?>
                        </tbody>
        <?php 
    }
    function det(){
        $id=$_REQUEST["id"];
        $sql = "SELECT salary.id AS id, salary.date AS date, salary.salary AS salary, salary.status AS status, us.firstname AS us_name, us.lastname AS us_lastname, emp.name AS name, emp.sirname AS sirname FROM salary INNER JOIN employee AS emp ON salary.emp_id = emp.id INNER JOIN users AS us ON salary.uid = us.id WHERE salary.id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $name = $cdr['name'];
            $sirname =  $cdr['sirname'];
            $us_name = $cdr['us_name'];
            $us_lastname = $cdr['us_lastname'];
            $salary = $cdr['salary'];
            $date = $cdr['date'];
            $stat = $cdr['status'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail salary Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $name, "&nbsp", $sirname ;?></td>
                            </tr>
                            <tr>
                                <td>เงินเดือน</td>
                                <td><?php echo number_format($salary, 2) ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดทำ</td>
                                <td><?php echo $us_name, "&nbsp", $us_lastname ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่จัดทำ</td>
                                <td><?php echo $date ;?></td>
                            </tr>
                            <?php 
                            if($stat == 2){
                                $sql = "SELECT salary.id AS id, salary.apv_uid AS apv_uid, salary.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM salary 
                                INNER JOIN users AS us ON salary.apv_uid = us.id
                                WHERE salary.id = $id";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                $cdr=$res->fetch();
                                echo "<tr>";
                                echo "<td>";
                                echo  "ผู้อนุมัติ";
                                echo "</td>";
                                echo "<td>";
                                echo  $cdr['fn'],"&nbsp",$cdr['ln'];
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>";
                                echo  "วันที่อนุมัติ";
                                echo "</td>";
                                echo "<td>";
                                echo  $cdr['apv_date'];
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=salary&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <form>
                </div>
            </div>
        </div>
        <?php 
    }
    function edit(){
        $id=$_REQUEST["id"];
        if($id == 0){
            $func = "Add Data salary";
            $sql = "SELECT firstname, lastname FROM users WHERE id = ".$_SESSION['uid']." AND status > 0";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $salary = "";
            $date = date("Y-m-d");
        }
        else{
            $func = "Edit Data salary";
            $sql = "SELECT salary.id AS id, salary.emp_id AS emp_id, salary.date AS date, salary.salary AS salary, us.firstname AS firstname, us.lastname AS lastname FROM salary INNER JOIN users AS us ON salary.uid = us.id WHERE salary.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $id = $cdr['id'];
            $emp_id =$cdr['emp_id'];
            $date = $cdr['date'];
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $salary = $cdr['salary'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center"><?php echo $func; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($id > 0){
                                echo "<tr>";
                                echo "<td>id</td>";
                                echo "<td> $id </td>";
                                echo "</tr>";
                            }
                            ?>
                            
                            <tr>
                                <td>ชื่อพนักงาน</td>
                                <td>
                                    <?php 
                                    if($id == 0 ){
                                        echo "<select class='form-control-sm' name='employee' required>";
                                        echo "<option value='' disabled selected>เลือกพนักงาน</option>";
                                        $sql = "SELECT * FROM employee WHERE status = 1";
                                        $conn = new connect();
                                        $res = $conn->query($sql);
                                        while($cdrs=$res->fetch()){
                                            echo "<option value=".$cdrs['id']." >".$cdrs['name'], "&nbsp", $cdrs['sirname']."</option>";
                                        }
                                    }
                                    else if($id > 0 ){
                                        echo "<select class='form-control-sm' name='employee' required>";
                                        $sql = "SELECT * FROM employee WHERE status = 1 ORDER BY CASE WHEN id = $emp_id THEN 0 ELSE 1 END, id; ";
                                        $conn = new connect();
                                        $res = $conn->query($sql);
                                        while($cdrs=$res->fetch()){
                                            echo "<option value=".$cdrs['id']." >".$cdrs['name'], "&nbsp", $cdrs['sirname']."</option>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>เงินเดือน</td>
                                <td><input class="form-control-sm" name="salary" type="number"  min="0" max="9999999999.99" placeholder="ใส่เงินเดือน" value ="<?php echo $salary;?>"></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดทำ</td>
                                <td><?php echo $firstname, "&nbsp", $lastname ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่จัดทำ</td>
                                <td><input class="form-control-sm" type="date" name="date" value="<?php echo $date ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='salary' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=salary&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                </from>
                </div>
            </div>
        </div> 
<?php   
    }
    function del(){
        $id = $_REQUEST['id'];
        $stat = $_REQUEST['stat'];
        if($stat == 1){
		    $sql = "update `salary` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=salary&task=def");
        }
        else if($stat == 0){
            $sql = "update `salary` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=salary&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $emp_id = $_REQUEST['employee'];
        $salary = $_REQUEST['salary'];
        
        $conn = new connect();
        if($id == 0 ){
            $sql = "INSERT INTO salary (emp_id, uid, apv_uid, date, apv_date, salary, status) VALUE ('$emp_id', '".$_SESSION['uid']."', '0', '".date('Y/m/d')."', '0', '$salary', '1')";
            $conn->query($sql);
            header("location:index.php?option=salary&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 ){
            $sql = "UPDATE salary SET emp_id = '$emp_id', salary = '$salary' WHERE id = '$id'";
            $conn->query($sql);    
            header("location:index.php?option=salary&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=salary&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
    function savepaysalary(){
        $value = $_REQUEST['value'];
		$sql = "INSERT INTO payment (ref_id, type, supplier_id, uid, apv_uid, date, apv_date, value, status) VALUE ('0', '2', '0', '".$_SESSION['uid']."', '0', '".date('Y/m/d')."', '0', '".$value."', '1') ";
		$conn = new connect();
		$conn->query($sql);
		header('location:index.php?option=salary&task=def');
        $conn->alert("ส่งข้อมูลเงินเดือนไปที่ Payment สำเร็จ", 1);
    }
    function paysalary(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Pay Salary Employee</h1>
                <form action="index.php" method="get">
                    <input type="hidden" name="option" value="salary">
                    <input type="hidden" name="task" value="savepaysalary" >
                </div>
                    <table class="table table-bordered table-striped mt-2" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Salary </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT salary.id AS id, salary.date AS date, salary.salary AS salary, salary.status AS status, emp.name AS name, emp.sirname AS sirname FROM salary INNER JOIN employee AS emp ON salary.emp_id = emp.id WHERE salary.status > 0 ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $total = 0;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['name'], "&nbsp", $cdr['sirname'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo number_format($cdr['salary'], 2);
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                    $total +=$cdr['salary'];
                                 }
                                 echo "<tr>";
                                 echo "<td colspan='2' >Total</td>";
                                 echo "<td colspan='1'>";
                                 echo number_format($total, 2);
                                 echo "</td>";
                                 echo "</tr>";
                                 echo "<input type='hidden' name='value' value='".$total."'>";
                            ?>
                            <tr>
							    <td colspan='3' class='text-center'>
                                    <input class="btn btn-primary btn-sm" type="submit" value="Approve" />
								    <input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=salary&task=def","_self")' />
							    </td>
						    </tr>
                        </tbody>
                        </from>
                       
        <?php 
    }
}

?>