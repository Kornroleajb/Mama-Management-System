<?php 
class product{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Product</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=product&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="product">
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
                                 $sql = "SELECT * FROM product ORDER BY id DESC";
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
                                    if($cdr['type'] == 1 ){
                                        echo "<td class='text text-center'>";
                                        echo "วัตถุดิบ";
                                        echo "</td>";
                                        $active = "active";
                                    }
                                    else{
                                        echo "<td class='text text-center'>";
                                        echo "สินค้า";
                                        echo "</td>";
                                        $active = "";
                                    }
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=product&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=product&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=product&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT * FROM product WHERE id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $name = $cdr['name'];
            if($cdr['type'] == 1){
                $type = "วัตถุดิบ";
            }
            else{
                $type = "สินค้า";
            }
            $price = $cdr['price'];
            $unit = $cdr['unit'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td><?php echo $id ;?></td>
                            </tr>
                            <tr>
                                <td>ประเภท</td>
                                <td><?php echo $type ;?></td>
                            </tr>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $name ;?></td>
                            </tr>
                            <tr>
                                <td>ราคา</td>
                                <td><?php echo number_format($price,2) ;?></td>
                            </tr>
                            <tr>
                                <td>หน่วยนับ</td>
                                <td><?php echo $unit ;?></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=product&task=def","_self")' />
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
            $func = "Add Data Product";
            $name = "";
            $price = "";
            $unit = "";
        }
        else{
            $func = "Edit Data Product";
            $sql = "SELECT * FROM product WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $id = $cdr['id'];
            $name = $cdr['name'];
            $price = $cdr['price'];
            $unit = $cdr['unit'];
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
                                <td>ประเภทสินค้า</td>
                                <td>   
                                    <select class="form-control-sm" name="type" required>
                                        <option value="" disabled selected>เลือกประเภทสินค้า</option>
                                        <option value="1" >วัตถุดิบ</option>
                                        <option value="2" >สินค้า</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>ชื่อสินค้า</td>
                                <td><input class="form-control-sm" name="product" type="text" placeholder="ใส่ชื่อสินค้า" maxlength="100" value="<?php echo $name ?>" required></td>
                            </tr>
                            <tr>
                                <td>ราคา</td>
                                <td><input class="form-control-sm" type="number" name="price" placeholder="ใส่ราคา" step="0.01" min="0" max="9999999999.99" value="<?php echo $price ;?>" required></td>
                            </tr>
                            <tr>
                                <td>หน่วยนับ</td>
                                <td><input class="form-control-sm" type="text"  name="unit" placeholder="ใส่หน่วยนับ" maxlength="20" value="<?php echo $unit;?>" ></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='product' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=product&task=def","_self")' />
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
		    $sql = "update `product` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=product&task=def");
        }
        else if($stat == 0){
            $sql = "update `product` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=product&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $name = $_REQUEST['product'];
        $type = $_REQUEST['type'];
        $price = $_REQUEST['price'];
        $unit = $_REQUEST['unit'];
        $conn = new connect();
        if($id == 0 ){
            $sql = "INSERT INTO product (type, name, price, unit, status) VALUE ('$type','$name', '$price', '$unit', '1')";
            $conn->query($sql);
            header("location:index.php?option=product&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 ){
            $sql = "UPDATE product SET type ='$type', name = '$name', price = '$price', unit = '$unit' WHERE id = '$id'";
            $conn->query($sql);    
            header("location:index.php?option=product&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=product&task=def");
            $conn->alert("มีข้อผิดพลาดโปรดกรอกข้อมูลใหม่", 2);
        }
    }
}

?>