<?php 
class receive_order{
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
                <h1>Receive Order</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=receive_order&task=edit&id=0&select=0&type=<?php echo $add ;?>","_self")' />
                        <input type="hidden" name="option" value="receive_order">
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
                                 $sql = "SELECT * FROM receive_order $type ORDER BY id DESC";
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
                                        echo "Purchase" ;
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=receive_order&task=det&id=".$cdr['id']."&type=".$add."\",\"_self\")' />";
                                    if($type <> null){
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=receive_order&task=edit&id=".$cdr['id']."&type=".$add."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=receive_order&task=del&id=".$cdr['id']."&stat=".$cdr['status']."&type=".$add."\",\"_self\")' />";
                                    echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=receive_order&task=approve&id=".$cdr['id']."&type=".$add."\",\"_self\")' />";
                                    echo "</td>"; 
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=receive_order&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=receive_order&task=del&id=".$cdr['id']."&stat=".$cdr['status']."&type=".$add."\",\"_self\")' />";
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
        $sql = "SELECT receive_order.id AS id, receive_order.uid AS uid, receive_order.date AS date, receive_order.status AS status, us.firstname AS fn, us.lastname AS ln, receive_order.ref_id AS ref_id, receive_order.type AS type 
                FROM receive_order
                INNER JOIN users AS us ON receive_order.uid = us.id
                WHERE receive_order.id = $id";
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
                $text = "Purchase";
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
                                <th colspan="2" class="text-center">Detail Data Receive Order</th>
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
                                $sql = "SELECT receive_order.id AS id, receive_order.apv_uid AS apv_uid, receive_order.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM receive_order 
                                INNER JOIN users AS us ON receive_order.apv_uid = us.id
                                WHERE receive_order.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=receive_order&task=def&type=<?php echo $type ; ?>","_self")' />
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
                    , `receive_order_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    from `product`, `receive_order_detail`
				    where `receive_order_detail`.`status` > 0
                    and `receive_order_detail`.`product_id` = `product`.`id`
                    and `receive_order_detail`.`receive_id` = '".$id."'";
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
                $sql = "SELECT po.id AS id, po.date AS date FROM po WHERE NOT EXISTS (SELECT 1 FROM receive_order AS ro WHERE ro.ref_id = po.id AND ro.type = 1) AND status = 2 ORDER BY id DESC";
                $conn = new connect();
                $res = $conn->query($sql);
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-12'>";
                echo "<h1>Select PO Creat to Receive Order</h1>";
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
                    echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=receive_order&task=edit&id=0&select=1&type=1&ref_id=' . $cdr['id'] . '\', \'_self\')" />';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            else if($type == 2){
                $sql = "SELECT pdt.id AS id, pdt.date AS date FROM production AS pdt WHERE NOT EXISTS (SELECT 1 FROM receive_order AS ro WHERE ro.ref_id = pdt.id AND ro.type = 2) AND status = 2 ORDER BY id DESC";
                $conn = new connect();
                $res = $conn->query($sql);
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-12'>";
                echo "<h1>Select Production   Creat to receive_order</h1>";
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
                    echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=receive_order&task=edit&id=0&select=1&type=2&ref_id=' . $cdr['id'] . '\', \'_self\')" />';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        }
        else if($id == 0 && $select == 1){
            $func = "Add receive_order data";
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
            $func = "Edit Data Receive Order";
            $sql = "SELECT receive_order.ref_id AS ref_id, receive_order.uid AS uid, receive_order.type AS type, receive_order.date AS date, us.firstname AS firstname, us.lastname AS lastname FROM receive_order INNER JOIN users AS us ON receive_order.uid = us.id WHERE receive_order.id = $id";
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
								<input type='hidden' name="option" value='receive_order' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id ;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=receive_order&task=def&type=<?php echo $type ;?>","_self")' />
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
                                $sql = "SELECT pod.product_id AS pd_id, pod.quantity AS num, pod.price AS price, pd.name  AS name, pd.unit AS unit FROM po_detail AS pod INNER JOIN product AS pd ON pod.product_id = pd.id  WHERE pod.po_id = $ref_id AND pod.status > 0";
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
                                echo "<input type='hidden' name='price_".$a."' value='".$cdr['price']."'>";
                                $a++;
                            }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<input type='hidden' name='ref_id' value='".$ref_id."'>";
                        }
                        else if($id > 0){
                            $a = 1;
                            $sql = "SELECT rod.product_id AS pd_id, rod.quantity AS num, pd.name  AS name, pd.unit AS unit  FROM receive_order_detail AS rod INNER JOIN product AS pd ON rod.product_id = pd.id  WHERE rod.receive_id  = $id ";
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
		    $sql = "update `receive_order` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active receive_order_id ".$id."", $_SESSION['uid']);
		    header("location:index.php?option=receive_order&task=def&type=$type");
        }
        else if($stat == 0){
            $sql = "update `receive_order` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active receive_order_id ".$id."", $_SESSION['uid']);
		    header("location:index.php?option=receive_order&task=def&type=$type");
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
            $sql = "INSERT INTO receive_order (ref_id, uid, apv_uid, type, date, apv_date, status) VALUE ('".$_REQUEST['ref_id']."', '".$_SESSION['uid']."', '0', '".$type."', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO receive_order_detail set receive_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', price ='".$_REQUEST['price_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=receive_order&task=def&type=$type");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add receive_order_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE receive_order_detail SET price = '$price', quantity = '$quantity', status = '1' WHERE receive_order_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE receive_order_detail SET price = '$price', quantity = '$quantity', status = '0' WHERE receive_order_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            header("location:index.php?option=receive_order&task=def&type=$type");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit receive_order_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=receive_order&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
        $type = $_REQUEST['type'];
		$sql = "update `receive_order` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		$conn = new connect();
		$conn->query($sql);
        $conn->save_logs("Approve receive_order_id ".$id."", $_SESSION['uid']);
        $sql = "SELECT *, (SELECT SUM(quantity * price ) FROM receive_order_detail WHERE receive_id = $id) AS value FROM receive_order WHERE id = $id";
		$conn = new connect();
		$res = $conn->query($sql);
        $cdr = $res->fetch();
        $supplier = $cdr['supplier_id'];
        $value = $cdr['value'];
        if($cdr['type'] == 1){
            $sql = "INSERT INTO payment (ref_id, type, supplier_id, uid, apv_uid, date, apv_date, value, status) VALUE ('".$id."', '1', '".$supplier."', '".$_SESSION['uid']."', '0', '".date('Y/m/d')."', '0', '".$value."', '1') ";
            $conn = new connect();
            $conn->query($sql);
        }
		header("location:index.php?option=receive_order&task=def&type=$type");
    }
}

?>