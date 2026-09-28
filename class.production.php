<?php 
class production{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Production</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=production&task=edit&id=0&select=0","_self")' />
                        <input type="hidden" name="option" value="production">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM production ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['date'];
                                    echo "</td>";
                                    if($cdr['status']==2){
                                        echo "<td class='text text-success text-center'>";
                                        echo "อนุมัติแล้ว";
                                        echo "</td>";
                                    }
                                    else if($cdr['status']==1){
                                        echo "<td class='text text-warning text-center'>";
                                        echo "รอการอนุมัติ";
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=production&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=production&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='Active' onclick='confirm_del(\"index.php?option=production&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=production&task=approve&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "</td>";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=production&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=production&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                        echo "</td>";
                                        }
                                    if($cdr['status'] > 1){
                                        echo "<input class='btn btn-danger btn-sm' type='button' value='Lost' onclick='window.open(\"index.php?option=production&task=lost&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-success btn-sm' type='button' value='Product' onclick='window.open(\"index.php?option=production&task=product&id=".$cdr['id']."\",\"_self\")' />";
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
        $sql = "SELECT pdt.id AS id, pdt.uid AS uid, pdt.date AS date, pdt.status AS status, us.firstname AS fn, us.lastname AS ln, pdt.op_batch_id AS op_batch_id 
        FROM production AS pdt
        INNER JOIN users AS us ON pdt.uid = us.id
        WHERE pdt.id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $op_batch_id = $cdr['op_batch_id'];
            $uid = $cdr["uid"];
            $date = $cdr['date'];
            $fsname = $cdr['fn'];
            $lsname = $cdr['ln'];
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
                                <th colspan="2" class="text-center">Detail Data Production</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เลขที่เอกสาร</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสาร batch</td>
                                <td><?php echo $op_batch_id ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดทำ</td>
                                <td><?php echo $fsname, "&nbsp", $lsname  ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่จัดทำ</td>
                                <td><?php echo $date ;?></td>
                            </tr>
                            <?php 
                            if($stat == 2){
                                $sql = "SELECT pdt.id AS id, pdt.apv_uid AS apv_uid, pdt.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM production AS pdt
                                INNER JOIN users AS us ON pdt.apv_uid = us.id
                                WHERE pdt.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=production&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    <?php
                        echo '<div class="row">';
                        echo '<div class="col-md-6 ">';
                        echo '<table class= "table table-bordered table-striped ">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th colspan="1" class="text-center">name</th>';
                        echo '<th colspan="1" class="text-center">quantity</th>';
                        echo "</tr>" ;
                        echo "</thead>" ;
                        echo "<tbody>" ;
                        $sql = "SELECT pdtd.product_id AS pd_id, pdtd.quantity AS num, pd.name AS name, pd.unit AS unit FROM production_detail AS pdtd INNER JOIN product AS pd ON pdtd.product_id = pd.id  WHERE pdtd.pdt_id = $id AND pd.type = 1";
                        $conn = new connect();
                        $res = $conn->query($sql);
                        while($cdr=$res->fetch()){
                            echo "<tr>";
                            echo "<td>";
                            echo $cdr['name'];
                            echo "</td>";
                            echo "<td>";
                            echo $cdr['num'];
                            echo "&nbsp";
                            echo $cdr['unit'];
                            echo "</td>";
                        }
                        echo "<tbody>" ;
                        echo "</table>" ;
                        echo "</div>" ;
                        echo '<div class="col-md-6 ">';
                        echo '<table class= "table table-bordered table-striped ">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th colspan="1" class="text-center">name</th>';
                        echo '<th colspan="1" class="text-center">quantity</th>';
                        echo "</tr>" ;
                        echo "</thead>" ;
                        echo "<tbody>" ;
                        $sql = "SELECT pdtd.product_id AS pd_id, pdtd.quantity AS num, pd.name AS name, pd.unit AS unit FROM production_detail AS pdtd INNER JOIN product AS pd ON pdtd.product_id = pd.id  WHERE pdtd.pdt_id = $id AND pd.type = 2";
                        $conn = new connect();
                        $res = $conn->query($sql);
                        while($cdr=$res->fetch()){
                            echo "<tr>";
                            echo "<td>";
                            echo $cdr['name'];
                            echo "</td>";
                            echo "<td>";
                            echo $cdr['num'];
                            echo "&nbsp";
                            echo $cdr['unit'];
                            echo "</td>";
                        }
                        echo "<tbody>" ;
                        echo "</table>" ;
                        echo "</div>" ;
                        echo "</div>" ;
                    ?>
                        </tbody>
                    </table>
                </from>
        <?php 
    }
    function edit(){
        $id=$_REQUEST["id"];
        if($id == 0){
            $select = $_REQUEST['select'];
        }
        if($id == 0 && $select == 0){
            $sql = "SELECT opb.id AS id, opb.date AS date FROM open_batch AS opb WHERE NOT EXISTS (SELECT 1 FROM production AS pdt WHERE pdt.op_batch_id = opb.id) AND status = 2 ORDER BY id DESC";
            $conn = new connect();
            $res = $conn->query($sql);
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col-12'>";
            echo "<h1>Select Open Batch Creat to Production</h1>";
            echo "<table id='datatable' class='table table-bordered table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='text-center'> No </th>";
            echo "<th class='text-center'> Date </th>";
            echo "<th class='text-center'> Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($cdr = $res->fetch()){
                echo "<tr>";
                echo "<td>";
                echo $cdr['id'];
                echo "</td>";
                echo "<td>";
                echo $cdr['date'];
                echo "</td>";
                echo "<td>";
                echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=production&task=edit&id=0&select=1&op_batch_id=' . $cdr['id'] . '\', \'_self\')" />';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";      
        }
        else if($id == 0 && $select == 1){
            $func = "Add Purchase Sale Order data";
            $op_batch_id = $_REQUEST['op_batch_id'];
            $date = date("Y-m-d");
            $sql = "SELECT firstname, lastname FROM users WHERE id = ".$_SESSION['uid']."";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
        }
        else{
            $func = "Edit Data Purchase Sale Order";
            $sql = "SELECT pdt.op_batch_id AS op_batch_id, pdt.uid AS uid, pdt.date AS date, us.firstname AS firstname, us.lastname AS lastname FROM production AS pdt INNER JOIN users AS us ON pdt.uid = us.id WHERE pdt.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch(); 
            $date = $cdr['date'];
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $op_batch_id = $cdr['op_batch_id'];
        }
        if($id > 0 or $select == 1){
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
                                echo "<td>เลขที่เอกสาร</td>";
                                echo "<td>$id</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td>เลขที่เอกสาร Batch</td>
                                <td><?php echo $op_batch_id ;?></td>
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
								<input type='hidden' name="option" value='production' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id ;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=production&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    
                        <?php 
                        if($id == 0){
                            echo '<div class="row">';
                            echo '<div class="col-md-6 ">';
                            echo '<table class= "table table-bordered table-striped ">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th colspan="1" class="text-center">name</th>';
                            echo '<th colspan="1" class="text-center">quantity</th>';
                            echo "</tr>" ;
                            echo "</thead>" ;
                            echo "<tbody>" ;
                            $a = 1;
                            $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name AS name, pd.unit AS unit FROM open_batch_detail AS opbd INNER JOIN product AS pd ON opbd.product_id = pd.id WHERE opbd.batch_id = $op_batch_id AND pd.type = 1";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='".$cdr['num']."' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['pd_id']."'>";
                                $a++;
                            }
                            echo "<tbody>" ;
                            echo "</table>" ;
                            echo "</div>" ;
                            echo '<div class="col-md-6 ">';
                            echo '<table class= "table table-bordered table-striped ">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th colspan="1" class="text-center">name</th>';
                            echo '<th colspan="1" class="text-center">quantity</th>';
                            echo "</tr>" ;
                            echo "</thead>" ;
                            echo "<tbody>" ;
                            $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name AS name, pd.unit AS unit FROM open_batch_detail AS opbd INNER JOIN product AS pd ON opbd.product_id = pd.id  WHERE opbd.batch_id = $op_batch_id AND pd.type = 2";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='".$cdr['num']."' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['pd_id']."'>";
                                $a++;
                            }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<input type='hidden' name='op_batch_id' value='".$op_batch_id."'>";
                            echo "<tbody>" ;
                            echo "</table>" ;
                            echo "</div>" ;
                            echo "</div>" ;
                            
                        }
                        else if($id > 0){
                            echo '<div class="row">';
                            echo '<div class="col-md-6 ">';
                            echo '<table class= "table table-bordered table-striped ">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th colspan="1" class="text-center">name</th>';
                            echo '<th colspan="1" class="text-center">quantity</th>';
                            echo "</tr>" ;
                            echo "</thead>" ;
                            echo "<tbody>" ;
                            $a = 1;
                            $sql = "SELECT pdtd.product_id AS pd_id, pdtd.quantity AS num, pd.name AS name, pd.unit AS unit FROM production_detail AS pdtd INNER JOIN product AS pd ON pdtd.product_id = pd.id  WHERE pdtd.pdt_id = $id AND pd.type = 1";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='".$cdr['num']."' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['pd_id']."'>";
                                $a++;
                            }
                            echo "<tbody>" ;
                            echo "</table>" ;
                            echo "</div>" ;
                            echo '<div class="col-md-6 ">';
                            echo '<table class= "table table-bordered table-striped ">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th colspan="1" class="text-center">name</th>';
                            echo '<th colspan="1" class="text-center">quantity</th>';
                            echo "</tr>" ;
                            echo "</thead>" ;
                            echo "<tbody>" ;
                            $sql = "SELECT pdtd.product_id AS pd_id, pdtd.quantity AS num, pd.name AS name, pd.unit AS unit FROM production_detail AS pdtd INNER JOIN product AS pd ON pdtd.product_id = pd.id  WHERE pdtd.pdt_id = $id AND pd.type = 2";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='".$cdr['num']."' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['pd_id']."'>";
                                $a++;
                            }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<input type='hidden' name='op_batch_id' value='".$op_batch_id."'>";
                            echo "<tbody>" ;
                            echo "</table>" ;
                            echo "</div>" ;
                            echo "</div>" ;
                        }
                        ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
                    
        <?php
        }
        ?>
        
<?php   
    }
    function del(){
        $id = $_REQUEST['id'];
        $stat = $_REQUEST['stat'];
        if($stat == 1){
		    $sql = "update `production` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active Production_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=production&task=def');
        }
        else if($stat == 0){
            $sql = "update `production` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active Production_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=production&task=def');
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $break = $_REQUEST['break'];
        $limit = $_REQUEST['limit'];
        $chech_data_record = 1;
        $a = 1;
        $conn = new connect();
        
        while($a < $break){
            if($_REQUEST['num_'.$a] == 0){
                $chech_data_record++;
            }
            $a++;
        }
        if($id == 0 && $chech_data_record <> $break){
            $sql = "INSERT INTO production (op_batch_id, uid, apv_uid, date, apv_date, status) VALUE ('".$_REQUEST['op_batch_id']."', '".$_SESSION['uid']."', '0', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO production_detail set pdt_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=production&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add Production_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE production_detail SET quantity = '$quantity', status = '1' WHERE pdt_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE production_detail SET quantity = '$quantity', status = '0' WHERE pdt_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            header("location:index.php?option=production&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit Production_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=production&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		    $sql = "update `production` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Approve Production_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=production&task=def');
    }
    function lost(){
        $id = $_REQUEST['id'];
		    $sql = "SELECT * FROM production_lost WHERE pdt_id = '$id'";
		    $conn = new connect();
		    $res = $conn->query($sql);
            $cdr = $res->fetch();
            if($res->rowcount() < 1){
                header('location:index.php?option=production_lost&task=edit&id=0&pdt_id='.$id.'');
            }
            else{
                $loss_id = $cdr['id'];
                header('location:index.php?option=production_lost&task=edit&id='.$loss_id.'&pdt_id='.$id.'');
            }
		    
    }
    function product(){
        $id = $_REQUEST['id'];
		    $sql = "SELECT * FROM production_result WHERE pdt_id = '$id'";
		    $conn = new connect();
		    $res = $conn->query($sql);
            $cdr = $res->fetch();
            if($res->rowcount() < 1){
                header('location:index.php?option=production_result&task=edit&id=0&pdt_id='.$id.'');
            }
            else{
                $result_id = $cdr['id'];
                header('location:index.php?option=production_result&task=edit&id='.$result_id.'&pdt_id='.$id.'');
            }
		    
    }
}

?>