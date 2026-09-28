<?php 
class open_batch{
    function def(){ 
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Open Batch</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=open_batch&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="open_batch">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center bg-light"> No </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM open_batch ORDER BY id DESC";
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
                                    
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=open_batch&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=open_batch&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=open_batch&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "<input class='btn btn-secondary btn-sm'type='button' value='Approve' onclick='confirm_apv(\"index.php?option=open_batch&task=approve&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "</td>";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=open_batch&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=open_batch&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT opb.id AS id, opb.uid AS uid, opb.date AS date, opb.status AS status, us.firstname AS fn, us.lastname AS ln 
        FROM open_batch AS opb
        INNER JOIN users AS us ON opb.uid = us.id
        WHERE opb.id = $id";
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
                                <th colspan="2" class="text-center">Detail Data open_batch</th>
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
                                $sql = "SELECT opb.id AS id, opb.apv_uid AS apv_uid, opb.apv_date AS apv_date, us.firstname AS fn, us.lastname AS ln 
                                FROM open_batch AS opb
                                INNER JOIN users AS us ON opb.apv_uid = us.id
                                WHERE opb.id = $id";
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
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=open_batch&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
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
                        $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name AS name, pd.unit AS unit FROM open_batch_detail AS opbd INNER JOIN product AS pd ON opbd.product_id = pd.id  WHERE opbd.batch_id  = $id AND pd.type = 1";
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
                        $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name AS name, pd.unit AS unit FROM open_batch_detail AS opbd INNER JOIN product AS pd ON opbd.product_id = pd.id  WHERE opbd.batch_id  = $id AND pd.type = 2";
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
                </from>
        </div>
        
        <?php 
    }
    function edit(){
    
    $id=$_REQUEST["id"];
        if($id==0){
            $func = "Add Data open_batch";
            $uid = $_SESSION['uid'];
            $sql = "SELECT firstname, lastname FROM users  WHERE id = ".$_SESSION['uid']." AND status = 1 ";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $date = date("Y-m-d");
        }
        else{
            $func = "Edit Data open_batch";
            $sql = "SELECT opb.uid AS uid, opb.date AS date, us.firstname AS firstname, us.lastname AS lastname FROM open_batch AS opb INNER JOIN users AS us ON opb.uid = us.id WHERE opb.id = $id";
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
								<input type='hidden' name="option" value='open_batch' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=open_batch&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    </div>
                    </div>
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
                            $sql = "SELECT * FROM product WHERE status > 0 and type = 1 ";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
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
                            $sql = "SELECT * FROM product WHERE status > 0 and type = 2 ";
                            $conn = new connect();
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
                                $a++;
                            }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<tbody>" ;
                            echo "</table>" ;
                            echo "</div>" ;
                            echo "</div>" ;
                        }
                        else {
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
                            $limit = 1;
                            $array_check = [0];
                            $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name AS name, pd.unit AS unit FROM open_batch_detail AS opbd INNER JOIN product AS pd ON opbd.product_id = pd.id  WHERE opbd.batch_id  = $id AND pd.type =1";
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
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
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
                            $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name AS name, pd.unit AS unit FROM open_batch_detail AS opbd INNER JOIN product AS pd ON opbd.product_id = pd.id  WHERE opbd.batch_id  = $id AND pd.type =2";
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
                                array_push($array_check, $cdr['pd_id']);
                                $a++;
                                $limit++;
                            }
                            $placeholders = implode(",", $array_check);
                            $sql = "SELECT * FROM product WHERE id NOT IN($placeholders) AND status > 0 AND type = 2";        
                            $res = $conn->query($sql);
                            while($cdr=$res->fetch()){
                                echo "<tr>";
                                echo "<td>";
                                echo $cdr['name'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
                                $a++;
                                }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<input type='hidden' name='limit' value='".$limit."'>";
                            echo "<tbody>" ;
                            echo "</table>" ;
                            echo "</div>" ;
                            echo "</div>" ;
                            }
                            ?>
                         
                    
                </from>
               
        </div> 
<?php   
    }
    function del(){
        $id = $_REQUEST['id'];
        $stat = $_REQUEST['stat'];
        if($stat == 1){
		    $sql = "update `open_batch` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("In-Active Batch_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=open_batch&task=def');
        }
        else if($stat == 0){
            $sql = "update `open_batch` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Active Batch_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=open_batch&task=def');
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
            $sql = "INSERT INTO open_batch (uid, apv_uid, date, apv_date, status) VALUE ('".$_SESSION['uid']."', '0', '".$_REQUEST['date']."', '0', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO open_batch_detail set batch_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=open_batch&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Add Batch_id ".$id."", $_SESSION['uid']);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $a = 1;
            while($a < $limit){
                if($_REQUEST['num_'.$a] > 0){
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE open_batch_detail SET quantity = '$quantity', status = '1' WHERE batch_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $price = $_REQUEST['price_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE open_batch_detail SET quantity = '$quantity', status = '0' WHERE batch_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO open_batch_detail set batch_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=open_batch&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
            $conn->save_logs("Edit Batch_id ".$id."", $_SESSION['uid']);
        }
        else if($chech_data_record == $break){
            header("location:index.php?option=open_batch&task=edit&id=$id");
            $conn->alert("กรอกข้อมูลอย่างน้อย 1 Record", 2);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		    $sql = "update `open_batch` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
            $conn->save_logs("Approve Batch_id ".$id."", $_SESSION['uid']);
		    header('location:index.php?option=open_batch&task=def');
    }
}

?>