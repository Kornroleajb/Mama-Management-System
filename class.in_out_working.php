<?php 
class in_out_working{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>in_out_working Data</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=in_out_working&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="in_out_working">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Type </th>
                                <th class="text-center"> Time </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT io.id AS id, io.type AS type, io.date_time AS time, io.status AS status, emp.name AS name, emp.sirname AS sirname FROM in_out_working AS io INNER JOIN employee AS emp ON io.emp_id = emp.id ORDER BY id DESC";
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
                                    if($cdr['type'] == 1){
                                        echo "เข้างาน";
                                    }
                                    else if($cdr['type'] == 2){
                                        echo "ออกงาน";
                                    }
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['time'];
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=in_out_working&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=in_out_working&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=in_out_working&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT io.id AS id, io.type AS type, io.date_time AS date_time, emp.name AS name, emp.sirname AS sirname FROM in_out_working AS io INNER JOIN employee AS emp ON io.emp_id = emp.id WHERE io.id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $name = $cdr['name'];
            $sirname =  $cdr['sirname'];
            $type = $cdr['type'];
            if($type == 1 ){
                $type = "เข้างาน";
            }
            else if($type == 2 ){
                $type = "ออกงาน";
            }
            $time = $cdr['date_time'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail in_out_working Data</th>
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
                                <td>ประเภท</td>
                                <td><?php echo $type ;?></td>
                            </tr>
                            <tr>
                                <td>เวลา</td>
                                <td><?php echo $time ;?></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=in_out_working&task=def","_self")' />
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
            $func = "Add Data in_out_working";
            $time = "";
            $type = "";
        }
        else{
            $func = "Edit Data in_out_working";
            $sql = "SELECT * FROM in_out_working  WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $id = $cdr['id'];
            $emp_id =$cdr['emp_id'];
            $time = $cdr['date_time'];
            $type = $cdr['type'];
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
                                            echo "<option value=".$cdrs['id']." >".$cdrs['name'],$cdrs['sirname']."</option>";
                                        }
                                    }
                                    else if($id > 0 ){
                                        echo "<select class='form-control-sm' name='employee' required>";
                                        $sql = "SELECT * FROM employee WHERE status = 1 ORDER BY CASE WHEN id = $emp_id THEN 0 ELSE 1 END, id; ";
                                        $conn = new connect();
                                        $res = $conn->query($sql);
                                        while($cdrs=$res->fetch()){
                                            echo "<option value=".$cdrs['id']." >".$cdrs['name'],$cdrs['sirname']."</option>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='in_out_working' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=in_out_working&task=def","_self")' />
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
		    $sql = "update `in_out_working` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=in_out_working&task=def");
        }
        else if($stat == 0){
            $sql = "update `in_out_working` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=in_out_working&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $emp_id = $_REQUEST['employee'];
        $date = date('Y/m/d');
        $sql = "SELECT * FROM in_out_working WHERE emp_id = '$emp_id' AND DATE(date_time) = '$date' ORDER BY id DESC LIMIT 1";
        $conn = new connect();
        $res = $conn->query($sql);
        if($res->rowcount() == 0){
            $type = 1;
        }
        else{
            $cdr = $res->fetch();
            if($cdr['type'] == 1){
                $type = 2;
            }
            else if($cdr['type'] == 2){
                $type = 1;
            }
        }
        
        if($id == 0 ){
            $sql = "INSERT INTO in_out_working (emp_id, date_time, type, status) VALUE ('$emp_id', '".date('Y/m/d H:i:s')."', '$type', '1')";
            $conn->query($sql);
            header("location:index.php?option=in_out_working&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 ){
            $sql = "UPDATE in_out_working SET emp_id = '$emp_id', date_time = '".date('Y/m/d H:i:s')."', type = '$type' WHERE id = '$id'";
            $conn->query($sql);    
            header("location:index.php?option=in_out_working&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=in_out_working&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
}

?>