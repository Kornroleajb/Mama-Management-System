<?php 
class delivery{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Delivery</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=delivery&task=edit&id=0&select=0","_self")' />
                        <input type="hidden" name="option" value="delivery">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Customer </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT dvr.id AS id, dvr.date AS date, cm.name AS customer, dvr.status AS status FROM delivery AS dvr INNER JOIN customer_data AS cm ON dvr.customer_id = cm.id ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['customer'];
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
                                        echo "รอการอนุมัติการจ่ายเงิน";
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=delivery&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=delivery&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=delivery&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=delivery&task=approve&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "</td>";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=delivery&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=delivery&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT delivery.id AS id, delivery.uid AS uid, delivery.date AS date, delivery.status AS status, us.firstname AS fn, us.lastname AS ln, cm.name AS nc, delivery.po_id AS po_id 
        FROM delivery
        INNER JOIN users AS us ON delivery.uid = us.id
        INNER JOIN customer_data AS cm ON delivery.customer_id = cm.id
        WHERE delivery.id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $po_id = $cdr['po_id'];
            $customer = $cdr['nc'];
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
                                <th colspan="2" class="text-center">Detail Data delivery</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เลขที่เอกสาร</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสารสั่งซื้อ</td>
                                <td><?php echo $po_id ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดซื้อ</td>
                                <td><?php echo $customer ;?></td>
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
                                $sql = "SELECT delivery.id AS id, delivery.apv_uid AS apv_uid, delivery.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM delivery 
                                INNER JOIN users AS us ON delivery.apv_uid = us.id
                                WHERE delivery.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=delivery&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">id</th>
                                <th colspan="1" class="text-center">name</th>
                                <th colspan="1" class="text-center">price</th>
                                <th colspan="1" class="text-center">quantity</th>
                                <th colspan="1" class="text-center">total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $a = 1;
                            $total = 0;
                            $sql = "select `product`.`name` as name
                    , `product`.`id` as stid
                    , `delivery_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    , `delivery_detail`.`price` as `price` 
                    from `product`, `delivery_detail`
				    where `delivery_detail`.`status` > 0
                    and `delivery_detail`.`product_id` = `product`.`id`
                    and `delivery_detail`.`dvr_id` = '".$id."'";
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
                                echo "<td class='text-center'>";
                                echo $cdr['price'];
                                echo "</td>";
                                echo "<td class='text-end'>";
                                echo $cdr['num'];
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<td class='text-end'>";
                                echo number_format($cdr['num'] * $cdr['price'],2) ;
                                echo "</td>";
                                echo "</tr>";
                                $a++;
                                $total += $cdr['num'] * $cdr['price'] ;
                                }
                            ?>
                            <tr>
                                <td colspan="4" class="text-start"> Total Net</td>
                                <td colspan="4" class="text-end"><?php echo number_format($total,2); ?></td>
                            </tr>
                            
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
        if($id == 0){
            $select = $_REQUEST['select'];
        }
        if($id == 0 && $select == 0){
            $sql = "SELECT po.id AS id, po.date AS date FROM purchase_order AS po WHERE NOT EXISTS (SELECT 1 FROM delivery AS dvr WHERE dvr.po_id = po.id) AND status = 2 ORDER BY id DESC";
            $conn = new connect();
            $res = $conn->query($sql);
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col-12'>";
            echo "<h1>Select PR Creat to delivery</h1>";
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
                echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=delivery&task=edit&id=0&select=1&po_id=' . $cdr['id'] . '\', \'_self\')" />';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";      
        }
        else if($id == 0 && $select == 1){
            $func = "Add delivery data";
            $po_id = $_REQUEST['po_id'];
            $date = date("Y-m-d");
            $sql = "SELECT firstname, lastname FROM users WHERE id = ".$_SESSION['uid']."";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $sql = "SELECT customer_id FROM purchase_order WHERE id = '$po_id'";
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $cm_id = $cdr['customer_id'];
        }
        else{
            $func = "Edit Data delivery";
            $sql = "SELECT delivery.po_id AS po_id, delivery.uid AS uid, delivery.date AS date, us.firstname AS firstname, us.lastname AS lastname, cm.id AS cm_id FROM delivery INNER JOIN users AS us ON delivery.uid = us.id INNER JOIN customer_data AS cm ON delivery.customer_id = cm.id WHERE delivery.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch(); 
            $date = $cdr['date'];
            $cm_id = $cdr['cm_id'];
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $po_id = $cdr['po_id'];
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
                                <td>เลขที่เอกสารสั่งซื้อ</td>
                                <td><?php echo $po_id ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดซื้อ</td>
                                <td>
                                <?php
                               
                                    echo "<select class='form-control-sm' name='customer' required>";
                                    $sql = "SELECT * FROM customer_data WHERE status = 1 ORDER BY CASE WHEN id = $cm_id THEN 0 ELSE 1 END, id; ";
                                    $conn = new connect();
                                    $res = $conn->query($sql);
                                    while($cdrs=$res->fetch()){
                                        echo "<option value=".$cdrs['id']." >".$cdrs['name']."</option>";
                                    }
                                
                                ?>

                                </td>
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
								<input type='hidden' name="option" value='delivery' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id ;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=delivery&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">id</th>
                                <th colspan="1" class="text-center">name</th>
                                <th colspan="1" class="text-center">price</th>
                                <th colspan="1" class="text-center">quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($id == 0){
                            $a = 1;
                            $sql = "SELECT pod.product_id AS pd_id, pod.price AS price, pod.quantity AS num, pd.name  AS name, pd.unit AS unit FROM purchase_order_detail AS pod INNER JOIN product AS pd ON pod.product_id = pd.id  WHERE pod.pur_ord_id  = $po_id AND pod.status = 1";
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
                                echo $cdr['price'];
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
                            echo "<input type='hidden' name='po_id' value='".$po_id."'>";
                        }
                        else if($id > 0){
                            $a = 1;
                            $sql = "SELECT dvd.product_id AS pd_id, dvd.price AS price, dvd.quantity AS num, pd.name  AS name, pd.unit AS unit  FROM delivery_detail AS dvd INNER JOIN product AS pd ON dvd.product_id = pd.id  WHERE dvd.dvr_id  = $id ";
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
                                echo $cdr['price'];
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
                            echo "<input type='hidden' name='po_id' value='".$po_id."'>";
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
		    $sql = "update `delivery` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active Delivery_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=delivery&task=def');
        }
        else if($stat == 0){
            $sql = "update `delivery` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active Delivery_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=delivery&task=def');
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $break = $_REQUEST['break'];
        $limit = $_REQUEST['limit'];
        $supplier = $_REQUEST['customer'];
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
            $sql = "INSERT INTO delivery (po_id, customer_id, uid, apv_uid, date, apv_date, status) VALUE ('".$_REQUEST['po_id']."','".$_REQUEST['customer']."', '".$_SESSION['uid']."', '0', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO delivery_detail set dvr_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', price = '".$_REQUEST['price_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=delivery&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add Delivery_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            $sql = "UPDATE delivery SET supplier_id = '$supplier' WHERE id = $id";
            $conn->query($sql);
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE delivery_detail SET price = '$price', quantity = '$quantity', status = '1' WHERE delivery_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE delivery_detail SET price = '$price', quantity = '$quantity', status = '0' WHERE delivery_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            header("location:index.php?option=delivery&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit Delivery_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=delivery&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		    $sql = "update `delivery` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Approve Delivery_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=delivery&task=def');
    }
}

?>