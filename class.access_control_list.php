<?php 
class access_control_list{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Access</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input type="hidden" name="option" value="user_group">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM user_group ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['name'];
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=access_control_list&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Access' onclick='window.open(\"index.php?option=access_control_list&task=access&id=".$cdr['id']."\",\"_self\")' />";
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
        $id=$_REQUEST["id"];
        $sql = "SELECT * FROM user_group WHERE id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $name = $cdr['name'];
            $detail = $cdr['detail'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail User Group Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $name ;?></td>
                            </tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=access_control_list&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">Application</th>
                                <th colspan="1" class="text-center">Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql ="SELECT * FROM access_control_list WHERE ug_id = $id AND status > 0";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            if($res->rowcount() < 1){
                                $sql = "SELECT * FROM application WHERE status > 0";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cdr['name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo "No Access";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                
                            }
                            else {
                                $array_check = [0];
                                $sql = "SELECT app.name AS nameapp, app.id AS app_id, accl.accl AS accl FROM access_control_list AS accl INNER JOIN application AS app ON accl.appid = app.id  WHERE accl.ug_id  = $id AND accl.status > 0";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cdr['nameapp'];
                                    echo "</td>";
                                    echo "<td>";
                                    $aa = $conn->get_app_control($cdr['accl']);
                                    echo  $aa[$cdr['accl']] ;
                                    echo "</td>";
                                    array_push($array_check, $cdr['app_id']);
                                }
                                $placeholders = implode(",", $array_check);
                                $sql = "SELECT * FROM application WHERE id NOT IN($placeholders) AND status > 0";        
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cdr['name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo "NO Access";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                               
                            }
                            ?>
                         
                        </tbody>
                    </table>
                    <form>
                </div>
            </div>
        </div>
        <?php 
    }
    function access(){
        $id=$_REQUEST["id"];
        $sql ="SELECT * FROM user_group WHERE id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        $cdr = $res->fetch();

        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Access User Group </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อ group</td>
                                <td><?php echo $cdr['name'] ;?></td>
                            </tr>
							<td colspan='2' class='text-center'>
                            <input type='hidden' name="option" value='access_control_list' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=access_control_list&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">Application</th>
                                <th colspan="1" class="text-center">Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql ="SELECT * FROM access_control_list WHERE ug_id = $id AND status > 0";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            if($res->rowcount() < 1){
                                $a = 1;
                                $sql = "SELECT * FROM application WHERE status = 1";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cdr['name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='access_".$a."' required>";
                                    $aa = $conn->get_app_control(0);
                                    foreach ($aa as $acc => $text) {
                                        echo "<option value='" . $acc . "'>" . $text . "</option>";
                                    }
                                    echo "<select>";
                                    echo "</td>";
                                    echo "<input type='hidden' name='app_".$a."' value='".$cdr['id']."'>";
                                    $a++;
                                }
                                echo "<input type='hidden' name='break' value='".$a."'>";
                            }
                            else {
                                $a = 1;
                                $limit = 1;
                                $array_check = [0];
                                $sql = "SELECT app.name AS nameapp, app.id AS app_id, accl.accl AS accl FROM access_control_list AS accl INNER JOIN application AS app ON accl.appid = app.id  WHERE accl.ug_id  = $id AND accl.status > 0";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cdr['nameapp'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='access_".$a."' required>";
                                    $aa = $conn->get_app_control($cdr['accl']);
                                    foreach ($aa as $acc => $text) {
                                        echo "<option value='" . $acc . "'>" . $text . "</option>";
                                    }
                                    echo "<select>";
                                    echo "</td>";
                                    echo "<input type='hidden' name='app_".$a."' value='".$cdr['app_id']."'>";
                                    array_push($array_check, $cdr['app_id']);
                                    $a++;
                                    $limit++;
                                }
                                $placeholders = implode(",", $array_check);
                                $sql = "SELECT * FROM application WHERE id NOT IN($placeholders) AND status > 0";        
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cdr['name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<select class='form-control-sm' name='access_".$a."' required>";
                                    $aa = $conn->get_app_control(0);
                                    foreach ($aa as $acc => $text) {
                                        echo "<option value='" . $acc . "'>" . $text . "</option>";
                                    }
                                    echo "<select>";
                                    echo "</td>";
                                    echo "<input type='hidden' name='app_".$a."' value='".$cdr['id']."'>";
                                    $a++;
                                }
                                echo "<input type='hidden' name='break' value='".$a."'>";
                                echo "<input type='hidden' name='limit' value='".$limit."'>";
                            }
                            ?>
                         
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
		    $sql = "update `access_control_list` set `status` = '0'  where `ug_id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=access_control_list&task=def");
        }
        else if($stat == 0){
            $sql = "update `access_control_list` set `status` = '1'  where `ug_id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=access_control_list&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $break = $_REQUEST['break'];
        $limit = $_REQUEST['limit'];
        $a = 1;
        $conn = new connect();

        if($id > 0){
            $a = 1;
            while($a < $limit){
                $app = $_REQUEST['app_'.$a];
                $accl = $_REQUEST['access_'.$a];
                $sql = "UPDATE access_control_list SET accl = '$accl' WHERE ug_id = '$id' AND appid = '$app' AND status > 0";
                $conn->query($sql);
                $a++;
            }        
            while($a < $break){
                $app = $_REQUEST['app_'.$a];
                $accl = $_REQUEST['access_'.$a];
                $sql = "INSERT INTO access_control_list (ug_id, appid, accl, status) VALUE ('$id', '$app', '$accl', '1')";
                $conn->query($sql);
                
                $a++;
            }
            header("location:index.php?option=access_control_list&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=access_control_list&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
}

?>