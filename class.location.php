<?php 
class location{
    function def(){ 
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>location</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=location&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="location">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Type </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM location ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['name'];
                                    echo "</td>";
                                    if($cdr['type'] == 1){
                                        echo "<td>";
                                        echo "โกดังวัตถุดิบ";
                                        echo "</td>";
                                    }
                                    else if($cdr['type'] == 2){
                                        echo "<td>";
                                        echo "โกดังสินค้า";
                                        echo "</td>";
                                    }
                                    if($cdr['status'] == 1){
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=location&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    if($cdr['status'] == 1){
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=location&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=location&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "</td>";
                                    }
                                    if($cdr['status'] < 1){
                                        echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=location&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                        echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=location&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT * FROM location WHERE id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $name = $cdr['name'];
            
            if($cdr['type'] == 1){
                $type = "โกดังวัตถุดิบ";
            }
            else if($cdr['type'] == 2){
                $type = "โกดังสินค้า";
            }
            $address = $cdr['address'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Data location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>หมายเลขโกดัง</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $name ;?></td>
                            </tr>
                            <tr>
                                <td>ประเภท</td>
                                <td><?php echo $type ;?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><?php echo $address ;?></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=location&task=def","_self")' />
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
                                <th colspan="1" class="text-center">detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $a = 1;
                            $sql = "select `product`.`name` as name
                    , `product`.`id` as stid
                    , `location_product_detail`.`quantity` as `num`
                    , `product`.`unit` as `unit` 
                    , `location_product_detail`.`detail` as `detail` 
                    from `product`, `location_product_detail`
				    where `location_product_detail`.`status` > 0
                    and `location_product_detail`.`product_id` = `product`.`id`
                    and `location_product_detail`.`location_id` = '".$id."'";
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
                                echo "<td class='text-end'>";
                                echo $cdr['detail'];
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
        if($id==0){
            $func = "Add Data location";
            $name ="";
            $address="";
        }
        else{
            $func = "Edit Data location";
            $sql = "SELECT * FROM location WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $name = $cdr['name'];
            $type = $cdr['type'];
            $address = $cdr['address'];

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
                                echo "<td>หมายเลขโกดัง</td>";
                                echo "<td>$id</td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td>ชื่อโกดัง</td>
                                <td><input class="form-control-sm" type="text" name="name" value="<?php echo $name ;?>"></td>
                            </tr>
                            <tr>
                                <td>ชื่อโกดัง</td>
                                <td> <select class='form-control-sm' name='type' required>
                                        <option value='' disabled selected>เลือกประเภท</option>
                                        <option value="1" >โกดังวัตถุดิบ</option>
                                        <option value="2" >โกดังสินค้า</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><input class="form-control" type="text" name="address" value="<?php echo $address ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='location' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=location&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <?php 
                    if($id > 0 ) {
                        ?>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">id</th>
                                <th colspan="1" class="text-center">name</th>
                                <th colspan="1" class="text-center">quantity</th>
                                <th colspan="1" class="text-center">detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $a = 1;
                                $limit = 1;
                                $array_check = [0];
                                $sql = "SELECT quod.product_id AS pd_id, quod.quantity AS num, quod.detail AS detail, pd.name AS name, pd.unit AS unit FROM location_product_detail AS quod INNER JOIN product AS pd ON quod.product_id = pd.id  WHERE quod.location_id  = '$id' AND quod.status > 0";
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
                                    echo "<td>";
                                    echo "<input type='text' name='detail_".$a."' value='".$cdr['detail']."'>";
                                    echo "</td>";
                                    array_push($array_check, $cdr['pd_id']);
                                    $a++;
                                    $limit++;
                                }
                                $placeholders = implode(",", $array_check);
                                $sql = "SELECT * FROM product WHERE id NOT IN($placeholders) AND status > 0 AND type = $type";
                                $res = $conn->query($sql);
                                while($cdr = $res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<input class='form-control-sm' type='number' name='num_".$a."' value='0' Min='0'>";
                                    echo "&nbsp";
                                    echo $cdr['unit'];
                                    echo "</td>";
                                    echo "<input type='hidden' name='idprd_".$a."' value='".$cdr['id']."'>";
                                    echo "<td>";
                                    echo "<input type='text' name='detail_".$a."' value=''>";
                                    echo "</td>";
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
		    $sql = "update `location` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header('location:index.php?option=location&task=def');
        }
        else if($stat == 0){
            $sql = "update `location` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header('location:index.php?option=location&task=def');
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $type = $_REQUEST['type'];
        $address = $_REQUEST['address'];
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
        if($id == 0){
            $sql = "INSERT INTO location (type, name, address, status) VALUE ('$type', '$name', '$address', '1')";
            $conn->query($sql);
            header("location:index.php?option=location&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 && $chech_data_record <> $break){
            $sql = "UPDATE location SET type = '$type', name = '$name',  address = '$address', status = '1' WHERE id = '$id'";
            $conn->query($sql);
            $a = 1;
            while($a < $limit){
                if($_REQUEST['num_'.$a] > 0){
                    $detail = $_REQUEST['detail_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE location_product_detail SET  quantity = '$quantity', detail = '$detail', status = '1' WHERE location_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                else{
                    $detail = $_REQUEST['detail_'.$a];
                    $quantity = $_REQUEST['num_'.$a];
                    $idprd = $_REQUEST['idprd_'.$a];
                    $sql = "UPDATE location_product_detail SET quantity = '$quantity', detail = '$detail', status = '0' WHERE location_id = '$id' AND product_id = '$idprd'";
                    $conn->query($sql);
                }
                $a++;
            }        
            while($a < $break){
                if($_REQUEST['num_'.$a] > 0){
                    $sql = "INSERT INTO location_product_detail set location_id = '$id', product_id = '".$_REQUEST['idprd_'.$a]."', quantity = '".$_REQUEST['num_'.$a]."', detail = '".$_REQUEST['detail_'.$a]."', status = '1'";
                    $conn->query($sql);
                }
                $a++;
            }
            header("location:index.php?option=location&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
    }
    function approve(){
        $id = $_REQUEST['id'];
		    $sql = "update `location` set `apv_uid` = '".$_SESSION['uid']."', `apv_date` = '".date('Y/m/d')."', `status` = '2' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header('location:index.php?option=location&task=def');
    }
}

?>