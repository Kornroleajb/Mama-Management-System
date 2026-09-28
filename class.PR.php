<?php 
class PR{
    function def(){
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Purchase Requirement</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=PR&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="PR">
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
                                 $sql = "SELECT * FROM pr ORDER BY id DESC";
                                 $conn = new connect();
                                 $access_control_list = $conn->check_access_control_list();
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
                                    
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=PR&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                        if (($access_control_list == '2') or ($access_control_list > '5')) {
                                            echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=PR&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                            echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=PR&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                        }
                                        if ($access_control_list > '3'){
                                            echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=PR&task=approve&id=".$cdr['id']."\",\"_self\")' />";
                                        }
                                    echo "</td>";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=PR&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=PR&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT pr.id AS id, pr.uid AS uid, pr.date AS date, pr.status AS status, us.firstname AS fn, us.lastname AS ln 
        FROM pr 
        INNER JOIN users AS us ON pr.uid = us.id
        WHERE pr.id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
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
                                <th colspan="2" class="text-center">Detail Data PR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เลขที่เอกสาร</td>
                                <td><?php echo $id ;?></td>
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
                                $sql = "SELECT pr.id AS id, pr.apv_uid AS apv_uid, pr.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM pr 
                                INNER JOIN users AS us ON pr.apv_uid = us.id
                                WHERE pr.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=PR&task=def","_self")' />
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
                    , `pr_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    , `pr_detail`.`price` as `price` 
                    from `product`, `pr_detail`
				    where `pr_detail`.`status` > 0
                    and `pr_detail`.`product_id` = `product`.`id`
                    and `pr_detail`.`pr_id` = '".$id."'";
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
        if($id==0){
            $func = "Add Data PR";
            $uid = $_SESSION['uid'];
            $sql = "SELECT firstname, lastname FROM users  WHERE id = ".$_SESSION['uid']." AND status = 1 ";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $date = date("Y-m-d");
        }
        else{
            $func = "Edit Data PR";
            $sql = "SELECT pr.uid AS uid, pr.date AS date, us.firstname AS firstname, us.lastname AS lastname FROM pr INNER JOIN users AS us ON pr.uid = us.id WHERE pr.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $date = $cdr['date'];
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
                                echo "<td>เลขที่เอกสาร</td>";
                                echo "<td>$id</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td>ผู้จัดทำ</td>
                                <td><?php echo $cdr['firstname'], "&nbsp", $cdr['lastname'] ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่จัดทำ</td>
                                <td><input class="form-control-sm" type="date" name="date" value="<?php echo $date ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='PR' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=PR&task=def","_self")' />
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
                                $sql = "SELECT * FROM product WHERE status = 1  and type = 1";
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
                                    echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                    echo "&nbsp";
                                    echo $cdr['unit'];
                                    echo "</td>";
                                    echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
                                    echo "<input type='hidden' name='price_".$a."' value='".$cdr['price']."'>";
                                    $a++;
                                }
                                echo "<input type='hidden' name='break' value='".$a."'>";    
                            }
                            else {
                                $a = 1;
                                $limit = 1;
                                $array_check = [0];
                                $sql = "SELECT prd.product_id AS pd_id, pd.price AS price, prd.quantity AS num, pd.name  AS name, pd.unit AS unit  FROM pr_detail AS prd INNER JOIN product AS pd ON prd.product_id = pd.id  WHERE prd.pr_id  = $id";
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
                                    array_push($array_check, $cdr['pd_id']);
                                    $a++;
                                    $limit++;
                                }
                                $placeholders = implode(",", $array_check);
                                $sql = "SELECT * FROM product WHERE id NOT IN($placeholders) AND status > 0 AND type = 1";        
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
                                    echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                    echo "&nbsp";
                                    echo $cdr['unit'];
                                    echo "</td>";
                                    echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
                                    echo "<input type='hidden' name='price_".$a."' value='".$cdr['price']."'>";
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
		    $sql = "update `pr` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active PR_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=PR&task=def');
        }
        else if($stat == 0){
            $sql = "update `pr` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active PR_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=PR&task=def');
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
            $sql = "INSERT INTO pr (uid, apv_uid, date, apv_date, status) VALUE ('".$_SESSION['uid']."', '0', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO pr_detail set pr_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', price = '".$_REQUEST['price_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=PR&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add PR_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            while($a < $limit){
                if($_REQUEST['num_'.$a] > 0){
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE pr_detail SET price = '$price', quantity = '$quantity', status = '1' WHERE pr_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE pr_detail SET price = '$price', quantity = '$quantity', status = '0' WHERE pr_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO pr_detail set pr_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', price = '".$_REQUEST['price_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=PR&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit PR_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=PR&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		    $sql = "update `pr` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Approve PR_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=PR&task=def');
    }
}

?>