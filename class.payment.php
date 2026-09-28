<?php 
class payment{
    function def(){
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Payment</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input type="hidden" name="option" value="payment">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Type </th>
                                <th class="text-center"> Supplier </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Value </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT payment.id AS id, payment.date AS date, sp.name AS supplier, payment.status AS status, payment.type AS type, payment.value AS value FROM payment LEFT JOIN supplier_data AS sp ON payment.supplier_id = sp.id ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    if($cdr['type'] == 1){
                                        echo "<td class='text text-center'>";
                                        echo "PO";
                                        echo "</td>";
                                    }
                                    else if($cdr['type'] == 2){
                                        echo "<td class='text text-center'>";
                                        echo "Pay Salary";
                                        echo "</td>";
                                    }
                                    echo "<td>";
                                    echo $cdr['supplier'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['date'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo number_format($cdr['value'], 2);
                                    echo "</td>";
                                    if($cdr['status']==2){
                                        echo "<td class='text text-success text-center'>";
                                        echo "อนุมัติแล้ว";
                                        echo "</td>";
                                    }
                                    else if($cdr['status']==1){
                                        echo "<td class='text text-warning text-center'>";
                                        echo "รอการอนุมัติจ่ายเงิน";
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=payment&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=payment&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=payment&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=payment&task=approve&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "</td>";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=payment&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=payment&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT payment.id AS id, payment.uid AS uid, payment.date AS date, payment.status AS status, us.firstname AS fn, us.lastname AS ln, sp.name AS ns, payment.ref_id AS ref_id, payment.type AS type, payment.value AS value
                FROM payment
                INNER JOIN users AS us ON payment.uid = us.id
                LEFT JOIN supplier_data AS sp ON payment.supplier_id = sp.id
                WHERE payment.id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $ref_id = $cdr['ref_id'];
            $type = $cdr['type'];
            $supplier = $cdr['ns'];
            $uid = $cdr["uid"];
            $date = $cdr['date'];
            $fsname = $cdr['fn'];
            $lsname = $cdr['ln'];
            $stat = $cdr['status'];
            $value = $cdr['value'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Data payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เลขที่เอกสาร</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสารสั่งซื้อ</td>
                                <td><?php echo $ref_id ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดซื้อ</td>
                                <td><?php echo $supplier ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้จัดทำ</td>
                                <td><?php echo $fsname, "&nbsp", $lsname  ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่จัดทำ</td>
                                <td><?php echo $date ;?></td>
                            </tr>
                            <tr>
                                <td>มูลค่า</td>
                                <td><?php echo number_format($value, 2) ;?></td>
                            </tr>
                            <?php 
                            if($stat == 2){
                                $sql = "SELECT payment.id AS id, payment.apv_uid AS apv_uid, payment.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM payment 
                                INNER JOIN users AS us ON payment.apv_uid = us.id
                                WHERE payment.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=payment&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <?php 
                    if($type == 1){
                    ?>
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
                    , `receive_order_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    , `receive_order_detail`.`price` as `price` 
                    from `product`, `receive_order_detail`
				    where `receive_order_detail`.`status` > 0
                    and `receive_order_detail`.`product_id` = `product`.`id`
                    and `receive_order_detail`.`receive_id` = '".$ref_id."'";
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
                    <?php 
                    }
                    ?>
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
            $sql = "SELECT po.id AS id, po.date AS date FROM po WHERE NOT EXISTS (SELECT 1 FROM payment AS pm WHERE pm.po_id = po.id) AND status = 2 ORDER BY id DESC";
            $conn = new connect();
            $res = $conn->query($sql);
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col-12'>";
            echo "<h1>Select PR Creat to payment</h1>";
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
                echo '<input class="btn btn-success btn-sm" type="button" value="Select" onclick="window.open(\'index.php?option=payment&task=edit&id=0&select=1&po_id=' . $cdr['id'] . '\', \'_self\')" />';
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";      
        }
        else if($id == 0 && $select == 1){
            $func = "Add payment data";
            $po_id = $_REQUEST['po_id'];
            $date = date("Y-m-d");
            $sql = "SELECT firstname, lastname FROM users WHERE id = ".$_SESSION['uid']."";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $sql = "SELECT supplier_id FROM po WHERE id = '$po_id'";
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $sp_id = $cdr['supplier_id'];
        }
        else{
            $func = "Edit Data payment";
            $sql = "SELECT payment.ref_id AS po_id, payment.uid AS uid, payment.date AS date, payment.value AS value, us.firstname AS firstname, us.lastname AS lastname, sp.name AS name FROM payment INNER JOIN users AS us ON payment.uid = us.id LEFT JOIN supplier_data AS sp ON payment.supplier_id = sp.id WHERE payment.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch(); 
            $date = $cdr['date'];
            $sp_name = $cdr['name'];
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $po_id = $cdr['po_id'];
            $value =$cdr['value'];
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
                                <td><?php echo $sp_name ;?></td>
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
                                <td>มูลค่า</td>
                                <td><input class="form-control-sm" type="number" name="date" value="<?php echo $value ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='payment' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id ;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=payment&task=def","_self")' />
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
                        if($id == 0){
                            $a = 1;
                            $sql = "SELECT pod.product_id AS pd_id, pod.price AS price, pod.quantity AS num, pd.name  AS name, pd.unit AS unit FROM po_detail AS pod INNER JOIN product AS pd ON pod.product_id = pd.id  WHERE pod.po_id  = $po_id AND pod.status = 1";
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
                            $total = 0;
                            $sql = "select `product`.`name` as name
                    , `product`.`id` as stid
                    , `receive_order_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    , `receive_order_detail`.`price` as `price` 
                    from `product`, `receive_order_detail`
				    where `receive_order_detail`.`status` > 0
                    and `receive_order_detail`.`product_id` = `product`.`id`
                    and `receive_order_detail`.`receive_id` = '".$po_id."'";
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
                        }
                        ?>
                        <tr>
                                <td colspan="4" class="text-start"> Total Net</td>
                                <td colspan="4" class="text-end"><?php echo number_format($total,2); ?></td>
                            </tr>
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
		    $sql = "update `payment` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active Payment_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=payment&task=def');
        }
        else if($stat == 0){
            $sql = "update `payment` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active Payment_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=payment&task=def');
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $break = $_REQUEST['break'];
        $limit = $_REQUEST['limit'];
        $supplier = $_REQUEST['supplier'];
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
            $sql = "INSERT INTO payment (po_id, supplier_id, uid, apv_uid, date, apv_date, status) VALUE ('".$_REQUEST['po_id']."','".$_REQUEST['supplier']."', '".$_SESSION['uid']."', '0', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO payment_detail set payment_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', price = '".$_REQUEST['price_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=payment&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add Payment_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            $sql = "UPDATE payment SET supplier_id = '$supplier' WHERE id = $id";
            $conn->query($sql);
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE payment_detail SET price = '$price', quantity = '$quantity', status = '1' WHERE payment_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE payment_detail SET price = '$price', quantity = '$quantity', status = '0' WHERE payment_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            header("location:index.php?option=payment&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit Payment_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=payment&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		    $sql = "update `payment` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Approve Payment_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=payment&task=def');
    }
}

?>