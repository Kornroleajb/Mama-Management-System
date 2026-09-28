<?php 
class leaved{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>leaved Data</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=leaved&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="leaved">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Type </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT leaved.id AS id, leaved.lve_date AS lve_date, leaved.status AS status, emp.name AS name, emp.sirname AS sirname, leaved_type.type AS type FROM leaved INNER JOIN employee AS emp ON leaved.emp_id = emp.id INNER JOIN leaved_type ON leaved.lve_type = leaved_type.id  ORDER BY id DESC";
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
                                    echo "<td class='text text-center'>";
                                    echo $cdr['type'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['lve_date'];
                                    echo "</td>";
                                    if($cdr['status'] == 1 ){
                                        echo "<td class='text text-warning text-center'>";
                                        echo "รอการอนุมัติ";
                                        echo "</td>";
                                        $active = "active";
                                    }
                                    else if($cdr['status'] == 2 ){
                                        echo "<td class='text text-success text-center'>";
                                        echo "อนุมัติแล้ว";
                                        echo "</td>";
                                        $active = "";
                                    }
                                    else{
                                        echo "<td class='text text-danger text-center'>";
                                        echo "ไม่พร้อมใช้งาน";
                                        echo "</td>";
                                        $active = "";
                                    }
                                    echo "<td>";
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=leaved&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] < 2){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=leaved&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=leaved&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                        if($cdr['status'] > 0){
                                            echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=leaved&task=approve&id=".$cdr['id']."\",\"_self\")' />";
                                        }
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                    $a++;
                                 }
                            ?>
                        </tbody>
        <?php 
    }
    function det(){
        $id=$_REQUEST["id"];
        $sql = "SELECT leaved.id AS id, leaved.lve_date AS lve_date, leaved.status AS status, leaved.due_date AS due_date, leaved.lve_req AS lve_req, emp.name AS name, emp.sirname AS sirname, leaved_type.type AS type FROM leaved INNER JOIN employee AS emp ON leaved.emp_id = emp.id INNER JOIN leaved_type ON leaved.lve_type = leaved_type.id LEFT JOIN leaved_require ON leaved.lve_req = leaved_require.id WHERE leaved.id = '$id'";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $name = $cdr['name'];
            $sirname =  $cdr['sirname'];
            $lve_date = $cdr['lve_date'];
            $due_date = $cdr['due_date'];
            $type = $cdr['type'];
            $lve_req = $cdr['lve_req'];
            $status = $cdr['status'];

        }
        $sql = "SELECT * FROM leaved_require WHERE id = $lve_req";
        $res = $conn->query($sql);
        $cdr=$res->fetch();
        $require = $cdr['require'];
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail leaved Data</th>
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
                                <td>ประเภทการลา</td>
                                <td><?php echo $type ;?></td>
                            </tr>
                            <tr>
                                <td>ลาแบบ</td>
                                <td><?php echo $require ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่ลา</td>
                                <td><?php echo $lve_date ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่กลับ</td>
                                <td><?php echo $due_date ;?></td>
                            </tr>
                            <?php 
                            if($status == 2){
                                $sql = "SELECT us.firstname AS fn, us.lastname AS ln, leaved.apv_date AS apv_date FROM leaved INNER JOIN users AS us ON leaved.apv_uid = us.id WHERE leaved.id = $id";
                                $res = $conn->query($sql);
                                $cdr = $res->fetch();
                                ?>
                            <tr>
                                <td>ผู้อนุมัติ</td>
                                <td><?php echo $cdr['fn'],"&nbsp",$cdr['ln'] ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่อนุมัติ</td>
                                <td><?php echo $cdr['apv_date'] ;?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=leaved&task=def","_self")' />
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
        if($id==0){
            $func = "Add Data leaved";
        }
        else{
            $func = "Edit Data leaved";
            $sql = "SELECT * FROM leaved WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $id = $cdr['id'];
            $emp_id = $cdr['emp_id'];
            $lve_type = $cdr['lve_type'];
            $lve_req = $cdr['lve_req'];
            $lve_date = $cdr['lve_date'];
            $due_date = $cdr['due_date'];
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
                                <td>พนักงาน</td>
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
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>ประเภทการลา</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='lve_type' required>";
                                    echo "<option value='' disabled selected>เลือกประเภทการลา</option>";
                                    $sql = "SELECT * FROM leaved_type WHERE status = 1";
                                    $conn = new connect();
                                    $res = $conn->query($sql);
                                    while($cdr=$res->fetch()){
                                        echo "<option value=".$cdr['id']." >".$cdr['type']."</option>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>ลาแบบ</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='lve_require' required>";
                                    echo "<option value='' disabled selected>ลาแบบ</option>";
                                    $sql = "SELECT * FROM leaved_require WHERE status = 1";
                                    $conn = new connect();
                                    $res = $conn->query($sql);
                                    while($cdr=$res->fetch()){
                                        echo "<option value=".$cdr['id']." >".$cdr['require']."</option>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                else if($id > 0 ){
                                    echo "<select class='form-control-sm' name='employee' required>";
                                    $sql = "SELECT * FROM employee WHERE status = 1 ORDER BY CASE WHEN id = $emp_id THEN 0 ELSE 1 END, id;";
                                    $conn = new connect();
                                    $res = $conn->query($sql);
                                    while($cdrs=$res->fetch()){
                                        echo "<option value=".$cdrs['id']." >".$cdrs['name'], "&nbsp", $cdrs['sirname']."</option>";
                                    }
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>ประเภทการลา</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='lve_type' required>";
                                    
                                    $sql = "SELECT * FROM leaved_type WHERE status = 1 ORDER BY CASE WHEN id = $lve_type THEN 0 ELSE 1 END, id;";
                                    $conn = new connect();
                                    $res = $conn->query($sql);
                                    while($cdr=$res->fetch()){
                                        echo "<option value=".$cdr['id']." >".$cdr['type']."</option>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>ลาแบบ</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='lve_require' required>"; 
                                    $sql = "SELECT * FROM leaved_require WHERE status = 1 ORDER BY CASE WHEN id = $lve_req THEN 0 ELSE 1 END, id;";
                                    $conn = new connect();
                                    $res = $conn->query($sql);
                                    while($cdr=$res->fetch()){
                                        echo "<option value=".$cdr['id']." >".$cdr['require']."</option>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            <tr>
                                <td>วันที่ลา</td>
                                <td><input class="form-control-sm" name="lve_date" type="date" value="<?php echo $lve_date ; ?>" required></td>
                            </tr>
                            <tr>
                                <td>วันที่กลับ</td>
                                <td><input class="form-control-sm" name="due_date" type="date" value="<?php echo $due_date ; ?>"></td>
                            </tr>

                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='leaved' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=leaved&task=def","_self")' />
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
		    $sql = "update `leaved` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=leaved&task=def");
        }
        else if($stat == 0){
            $sql = "update `leaved` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=leaved&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $emp_id = $_REQUEST['employee'];
        $lve_type = $_REQUEST['lve_type'];
        $lve_req = $_REQUEST['lve_require'];
        $lve_date = $_REQUEST['lve_date'];
        $due_date = $_REQUEST['due_date'];
        $conn = new connect();
        if($id == 0 ){
            $sql = "INSERT INTO leaved (emp_id, lve_type, lve_req, lve_date, due_date, status) VALUE ('$emp_id', '$lve_type', '$lve_req', '$lve_date', '$due_date', 1)";
            $conn->query($sql);
            header("location:index.php?option=leaved&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 ){
            $sql = "UPDATE leaved SET emp_id = '$emp_id', lve_type = '$lve_type', lve_req = '$lve_req', lve_date = '$lve_date', due_date = '$due_date' WHERE id = '$id'";
            $conn->query($sql);    
            header("location:index.php?option=leaved&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=leaved&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		$sql = "update `leaved` set `apv_uid` = '".$_SESSION['uid']."', `status` = '2', `apv_date` = '".date('Y/m/d')."'  where `id` = '".$id."'";
		$conn = new connect();
		$conn->query($sql);
        $conn->save_logs("Approve Leaved ".$id."", $_SESSION['uid']);
		header('location:index.php?option=leaved&task=def');
    }
}

?>