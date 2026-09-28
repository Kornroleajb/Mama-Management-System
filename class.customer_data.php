<?php 
class customer_data{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Customer Data</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=customer_data&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="customer_data">
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
                                 $sql = "SELECT * FROM customer_data ORDER BY id DESC";
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=customer_data&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=customer_data&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=customer_data&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                 }
                            ?>
                        </tbody>
        <?php 
    }
    function det(){
        $id=$_REQUEST["id"];
        $sql = "SELECT * FROM customer_data WHERE id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $name = $cdr['name'];
            $address = $cdr['address'];
            $tel = $cdr['tel'];
            $tex_number = $cdr['tex_number'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Customer Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $name ;?></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><?php echo $address ;?></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทรติดต่อ</td>
                                <td><?php echo $tel ;?></td>
                            </tr>
                            <tr>
                                <td>เลขประจำตัวผู้เสียภาษี</td>
                                <td><?php echo $tex_number ;?></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=customer_data&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <form>
                </div>
            </div>
        </div>
        <?php 
    }
    function edit(){
        $id=$_REQUEST["id"];
        if($id==0){
            $func = "Add Data Customer";
            $id = "";
            $name = "";
            $address = "";
            $tel = "";
            $tex_number = "";
        }
        else{
            $func = "Edit Data Customer";
            $sql = "SELECT * FROM customer_data WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $id = $cdr['id'];
            $name = $cdr['name'];
            $address = $cdr['address'];
            $tel = $cdr['tel'];
            $tex_number = $cdr['tex_number'];
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
                                echo "<td>id</td>";
                                echo "<td> $id </td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td>ชื่อ</td>
                                <td><input class="form-control-sm" name="customer" type="text" placeholder="ใส่ชื่อลูกค้า" maxlength="100" value="<?php echo $name ?>" required></td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td><input class="form-control" type="text" name="address" placeholder="ใส่ที่อยู่" maxlength="255" value="<?php echo $address ;?>" required></td>
                            </tr>
                            <tr>
                                <td>เบอร์โทรติดต่อ</td>
                                <td><input class="form-control-sm" type="tel" id="phone" name="tel" placeholder="ใส่เบอร์ติดต่อ" maxlength="10" value="<?php echo $tel;?>" pattern="[0-9]{10}" title="เบอร์โทร 10 หลัก" required></td>
                            </tr>
                            <tr>
                                <td>เลขประจำตัวผู้เสียภาษี</td>
                                <td><input class="form-control-sm" type="tel"  name="tex" placeholder="ใส่เลขประจำตัวผู้เสียภาษี" maxlength="13" value="<?php echo $tex_number;?>" pattern="^\d{10}(\d{3})?$" title="เลขประจำตัวผู้เสียภาษี  10 หรือ 13 หลัก" required></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='customer_data' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=customer_data&task=def","_self")' />
							</td>
						</tr>
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
		    $sql = "update `customer_data` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=customer_data&task=def");
        }
        else if($stat == 0){
            $sql = "update `customer_data` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=customer_data&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $name = $_REQUEST['customer'];
        $address = $_REQUEST['address'];
        $tel = $_REQUEST['tel'];
        $tex_number = $_REQUEST['tex'];
        $conn = new connect();
        if($id == 0 ){
            $sql = "INSERT INTO customer_data (name, address, tel, tex_number, status) VALUE ('$name', '$address', '$tel',  '$tex_number', '1')";
            $conn->query($sql);
            header("location:index.php?option=customer_data&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 ){
            $sql = "UPDATE customer_data SET name = '$name', address = '$address', tel = '$tel', tex_number = '$tex_number' WHERE id = '$id'";
            $conn->query($sql);    
            header("location:index.php?option=customer_data&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=customer_data&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
}

?>