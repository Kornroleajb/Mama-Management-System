<?php 
class requisition{
    function def(){
        $type = $_REQUEST['type'];
        if($type == 1){
            $type =  "WHERE type = 1";
            $add = "1";
        }
        else if($type == 2){
            $type =  "WHERE type = 2";
            $add = "2";
        }
        else{
            $type =  "";
            $add = "3";
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Requisition</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <?php 
                        if($add <> 3){
                        ?>
                            <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=requisition&task=edit&id=0&select=0&type=<?php echo $add ;?>","_self")' />
                        <?php 
                        }
                        ?>
                        <input type="hidden" name="option" value="requisition">
                        <input type="hidden" name="task" value="def" >
                        
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Type </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM requisition $type ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    if($cdr['type'] == 1){
                                        echo "Sale" ;
                                    }
                                    else if($cdr['type'] == 2){
                                        echo "Production" ;
                                    }
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=requisition&task=det&id=".$cdr['id']."&type=".$add."\",\"_self\")' />";
                                    
                                    if($add <> 3){
                                        if($cdr['status'] == 1){
                                            echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=requisition&task=edit&id=".$cdr['id']."&type=".$add."\",\"_self\")' />";
                                            echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=requisition&task=del&id=".$cdr['id']."&stat=".$cdr['status']."&type=".$add."\",\"_self\")' />";
                                            echo "</td>"; 
                                        }
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=requisition&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=requisition&task=del&id=".$cdr['id']."&stat=".$cdr['status']."&type=".$add."\",\"_self\")' />";
                                        echo "</td>";
                                        }
                                    if($add == 3){
                                        if($cdr['status'] == 1){
                                            echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=requisition&task=approve&id=".$cdr['id']."&type=".$add."\",\"_self\")' />";
                                            echo "</td>";
                                        }
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
        $type = $_REQUEST['type'];
        $sql = "SELECT requisition.id AS id, requisition.uid AS uid, requisition.date AS date, requisition.status AS status, us.firstname AS fn, us.lastname AS ln, requisition.ref_id AS ref_id, requisition.type AS type 
                FROM requisition
                INNER JOIN users AS us ON requisition.uid = us.id
                WHERE requisition.id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $ref_id = $cdr['ref_id'];
            $uid = $cdr["uid"];
            $date = $cdr['date'];
            $fsname = $cdr['fn'];
            $lsname = $cdr['ln'];
            $stat = $cdr['status'];
            if($cdr['type'] == 1){
                $text = "Sale";
            }
            else if($cdr['type'] == 2){
                $text = "Production";
            }
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Data Requisition</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เลขที่เอกสาร</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสารอ้างอิ้ง</td>
                                <td><?php echo $ref_id ;?></td>
                            </tr>
                            <tr>
                                <td>ประเภท</td>
                                <td><?php echo $text ;?></td>
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
                            if($stat > 1){
                                $sql = "SELECT requisition.id AS id, requisition.apv_uid AS apv_uid, requisition.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM requisition 
                                INNER JOIN users AS us ON requisition.apv_uid = us.id
                                WHERE requisition.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=requisition&task=def&type=<?php echo $type ; ?>","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">id</th>
                                <th colspan="1" class="text-center">name</th>
                                <th colspan="1" class="text-center">quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $a = 1;
                            $total = 0;
                            $sql = "select `product`.`name` as name
                    , `product`.`id` as stid
                    , `requisition_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    from `product`, `requisition_detail`
				    where `requisition_detail`.`status` > 0
                    and `requisition_detail`.`product_id` = `product`.`id`
                    and `requisition_detail`.`req_id` = '".$id."'";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td class='text-center'>";
                                echo $a;
                                echo "</td>";
                                echo "<td class='text-center'>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td class='text-end'>";
                                echo $cdr['num'];
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                
                                echo "</tr>";
                                $a++;
                                
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
    function edit(){
        $id=$_REQUEST["id"];
        $type = $_REQUEST['type'];

        if($id == 0){
            $select = $_REQUEST['select'];
        }
        if($id == 0 && $select == 0){
            if($type == 1){
                $sql = "SELECT os.id AS id, os.date AS date FROM purchase_order AS os WHERE NOT EXISTS (SELECT 1 FROM requisition AS req WHERE req.ref_id = os.id AND req.type = 1) AND status = 2 ORDER BY id DESC";
                $conn = new connect();
                $res = $conn->query($sql);
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-12'>";
                echo "<h1>Select Purchase Order Creat to Requisition</h1>";
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
                    echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=requisition&task=edit&id=0&select=1&type=1&ref_id=' . $cdr['id'] . '\', \'_self\')" />';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            else if($type == 2){
                $sql = "SELECT pdt.id AS id, pdt.date AS date FROM production AS pdt WHERE NOT EXISTS (SELECT 1 FROM requisition AS ro WHERE ro.ref_id = pdt.id AND ro.type = 2) AND status = 2 ORDER BY id DESC";
                $conn = new connect();
                $res = $conn->query($sql);
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-12'>";
                echo "<h1>Select Production   Creat to requisition</h1>";
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
                    echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=requisition&task=edit&id=0&select=1&type=2&ref_id=' . $cdr['id'] . '\', \'_self\')" />';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        }
        else if($id == 0 && $select == 1){
            $func = "Add Requisition data";
            $sql = "SELECT firstname, lastname FROM users WHERE id = ".$_SESSION['uid']."";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $date = date("Y-m-d");
            $ref_id = $_REQUEST['ref_id'];
        }
        else{
            $func = "Edit Data Requisition";
            $sql = "SELECT requisition.ref_id AS ref_id, requisition.uid AS uid, requisition.type AS type, requisition.date AS date, us.firstname AS firstname, us.lastname AS lastname FROM requisition INNER JOIN users AS us ON requisition.uid = us.id WHERE requisition.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch(); 
            $date = $cdr['date'];
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $ref_id = $cdr['ref_id'];
            $type = $cdr['type'];
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
                                <td>เลขที่เอกสารอ้างอิ้ง</td>
                                <td><?php echo $ref_id ;?></td>
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
                                <input type='hidden' name="type" value='<?php echo $type ;?>' />
								<input type='hidden' name="option" value='requisition' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id ;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=requisition&task=def&type=<?php echo $type ;?>","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">id</th>
                                <th colspan="1" class="text-center">Name</th>
                                <th colspan="1" class="text-center">quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($id == 0){
                            $a = 1;
                            if($type == 1){
                                $sql = "SELECT pod.product_id AS pd_id, pod.quantity AS num, pd.name  AS name, pd.unit AS unit FROM purchase_order_detail AS pod INNER JOIN product AS pd ON pod.product_id = pd.id  WHERE pod.pur_ord_id = $ref_id AND pod.status > 0";
                            }
                            else if($type == 2){
                                $sql = "SELECT pdtr_d.product_id AS pd_id, pdtr_d.pdt_num AS num, pd.name  AS name, pd.unit AS unit FROM production_result_detail AS pdtr_d INNER JOIN product AS pd ON pdtr_d.product_id = pd.id  WHERE pdtr_d.pdr_id  = (SELECT id FROM production_result WHERE pdt_id = $ref_id) AND pdtr_d.status > 0";
                            }
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td>";
                                echo $a;
                                echo "</td>";
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
                            echo "<input type='hidden' name='ref_id' value='".$ref_id."'>";
                        }
                        else if($id > 0){
                            $a = 1;
                            $sql = "SELECT red.product_id AS pd_id, red.quantity AS num, pd.name  AS name, pd.unit AS unit  FROM requisition_detail AS red INNER JOIN product AS pd ON red.product_id = pd.id  WHERE red.req_id  = $id ";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td>";
                                echo $a;
                                echo "</td>";
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
                            echo "<input type='hidden' name='ref_id' value='".$ref_id."'>";
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
        $type = $_REQUEST['type'];
        if($stat == 1){
		    $sql = "update `requisition` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active requisition_id ".$id."", $_SESSION['uid']);
		    header("location:index.php?option=requisition&task=def&type=$type");
        }
        else if($stat == 0){
            $sql = "update `requisition` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active requisition_id ".$id."", $_SESSION['uid']);
		    header("location:index.php?option=requisition&task=def&type=$type");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $break = $_REQUEST['break'];
        $ref_id = $_REQUEST['ref_id'];
        $type = $_REQUEST['type'];
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
            $sql = "INSERT INTO requisition (ref_id, uid, apv_uid, type, date, apv_date, status) VALUE ('".$_REQUEST['ref_id']."', '".$_SESSION['uid']."', '0', '".$type."', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO requisition_detail set req_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=requisition&task=def&type=$type");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add Requisition_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE requisition_detail SET price = '$price', quantity = '$quantity', status = '1' WHERE requisition_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE requisition_detail SET price = '$price', quantity = '$quantity', status = '0' WHERE requisition_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            header("location:index.php?option=requisition&task=def&type=$type");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit requisition_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=requisition&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
        $type = $_REQUEST['type'];
		$sql = "update `requisition` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		$conn = new connect();
		$conn->query($sql);
        $conn->save_logs("Approve requisition_id ".$id."", $_SESSION['uid']);
		header("location:index.php?option=requisition&task=def&type=$type");
    }
}

?>