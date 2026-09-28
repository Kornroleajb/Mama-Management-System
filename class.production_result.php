<?php 
class production_result{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Result Production</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input type="hidden" name="option" value="production_result">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Ference </th>
                                <th class="text-center"> Date </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM production_result ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['pdt_id'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['date'];
                                    echo "</td>";
                                    if($cdr['status']==1){
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=production_result&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=production_result&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm'$active' type='button' value='active' onclick='confirm_del(\"index.php?option=production_result&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "</td>";
                                    }
                                    if($cdr['status'] == 0){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=production_result&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm'$active' type='button' value='active' onclick='confirm_del(\"index.php?option=production_result&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT pdtr.id AS id, pdtr.uid AS uid, pdtr.date AS date, pdtr.status AS status, us.firstname AS fn, us.lastname AS ln, pdtr.pdt_id AS pdt_id 
                FROM production_result AS pdtr
                INNER JOIN users AS us ON pdtr.uid = us.id
                WHERE pdtr.id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $pdt_id = $cdr['pdt_id'];
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
                                <th colspan="2" class="text-center">Detail Data Production Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>เลขที่เอกสาร</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>เลขที่เอกสารการผลิต</td>
                                <td><?php echo $pdt_id ;?></td>
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
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=production_result&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">id</th>
                                <th colspan="1" class="text-center">name</th>
                                <th colspan="1" class="text-center">product</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $a = 1;
                            $sql = "SELECT product.name AS name, product.id AS stid, production_result_detail.pdt_num AS num, product.unit AS unit
                                    FROM product
                                    INNER JOIN production_result_detail ON production_result_detail.product_id = product.id
                                    WHERE production_result_detail.status > 0 AND production_result_detail.pdr_id = $id";
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
        if($id == 0 ){
            $func = "Add Result Production";
            $pdt_id = $_REQUEST['pdt_id'];
            $date = date("Y-m-d");
            $sql = "SELECT firstname, lastname FROM users WHERE id = ".$_SESSION['uid']."";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch();
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
        }
        else{
            $func = "Edit Result Production";
            $sql = "SELECT pdtl.pdt_id AS pdt_id, pdtl.uid AS uid, pdtl.date AS date, us.firstname AS firstname, us.lastname AS lastname 
                    FROM production_result AS pdtl 
                    INNER JOIN users AS us ON pdtl.uid = us.id 
                    WHERE pdtl.id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr = $res->fetch(); 
            $date = $cdr['date'];
            $firstname = $cdr['firstname'];
            $lastname = $cdr['lastname'];
            $pdt_id = $cdr['pdt_id'];
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
                                echo "<td> $id </td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td>เลขที่สารการผลิต</td>
                                <td><?php echo $pdt_id ;?></td>
                            </tr>
                            <tr>
                                <td>ผู้บันทึกผลผลิต</td>
                                <td><?php echo $firstname, "&nbsp", $lastname ;?></td>
                            </tr>
                            <tr>
                                <td>วันที่จัดทำ</td>
                                <td><input class="form-control-sm" type="date" name="date" value="<?php echo $date ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='production_result' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id ;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=production&task=def","_self")' />
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
                                <th colspan="1" class="text-center">result</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if($id == 0){
                            $a = 1;
                            $sql = "SELECT opbd.product_id AS pd_id, opbd.quantity AS num, pd.name  AS name, pd.unit AS unit 
                                    FROM production_detail AS opbd 
                                    INNER JOIN product AS pd ON opbd.product_id = pd.id  
                                    WHERE opbd.pdt_id  = $pdt_id AND opbd.status = 1";
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
                                echo $cdr['num'];
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<td class='text text-center'>";
                                echo "<input class='form-control-sm' type='number' name='pdt_num_".$a."' value='0' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['pd_id']."'>";
                                $a++;
                            }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<input type='hidden' name='pdt_id' value='".$pdt_id."'>";
                        }
                        else if($id > 0){
                            $a = 1;
                            $sql = "SELECT pdtr_d.product_id AS pd_id, pdtr_d.pdt_num AS pdt_num, pd.name AS name, pd.unit AS unit, pdtd.quantity AS num 
                                    FROM production_result_detail AS pdtr_d 
                                    INNER JOIN product AS pd ON pdtr_d.product_id = pd.id 
                                    INNER JOIN production_detail AS pdtd ON pdtr_d.product_id = pdtd.product_id 
                                    WHERE pdtr_d.pdr_id = $id AND pdtd.pdt_id = $pdt_id";
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
                                echo $cdr['num'];
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<td class='text text-center'>";
                                echo "<input class='form-control-sm' type='number' name='pdt_num_".$a."' value='".$cdr['pdt_num']."' Min='0'>";
                                echo "&nbsp";
                                echo $cdr['unit'];
                                echo "</td>";
                                echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['pd_id']."'>";
                                $a++;
                            }
                            echo "<input type='hidden' name='break' value='".$a."'>";
                            echo "<input type='hidden' name='pdt_id' value='".$pdt_id."'>";
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
    function del(){
        $id = $_REQUEST['id'];
        $stat = $_REQUEST['stat'];
        if($stat == 1){
		    $sql = "update `production_result` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header('location:index.php?option=production_result&task=def');
        }
        else if($stat == 0){
            $sql = "update `production_result` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header('location:index.php?option=production_result&task=def');
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $date = $_REQUEST['date'];
        $break = $_REQUEST['break'];
        $a = 1;
        $conn = new connect();
        
        if($id == 0){
            $sql = "INSERT INTO production_result (pdt_id, uid, date, status) 
                    VALUE ('".$_REQUEST['pdt_id']."', '".$_SESSION['uid']."', '".$_REQUEST['date']."', '1')";
            $id = $conn->query_lastid($sql);
            
            $a = 1;
            while($a < $break){
                $sql = "INSERT INTO production_result_detail set pdr_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', pdt_num = '".$_REQUEST['pdt_num_'.$a]."', status = '1'";
                $conn->query($sql);
                $a++;
            }
            header("location:index.php?option=production&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0){
            $a = 1;
            while($a < $break){
                $pdt_num = $_REQUEST['pdt_num_'.$a];
                $idprd = $_REQUEST['idprd_'.$a];
                $sql = "UPDATE production_result_detail SET pdt_num = '$pdt_num', status = '1' WHERE pdr_id = '$id' AND product_id = '$idprd'";
                $conn->query($sql);

                $a++;
            }        
            header("location:index.php?option=production&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=production&task=def");
            $conn->alert("มีข้อพิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
    
}

?>