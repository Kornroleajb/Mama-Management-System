<?php 
class accounting_type{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>Accounting Type</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=accounting_type&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="accounting_type">
                        <input type="hidden" name="task" value="def" >
                    </from>
                </div>
                    <table id="datatable" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center"> No </th>
                                <th class="text-center"> Type </th>
                                <th class="text-center"> Root </th>
                                <th class="text-center"> Order </th>
                                <th class="text-center"> Name </th>
                                <th class="text-center"> Status</th>
                                <th class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sql = "SELECT * FROM accounting_type ";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['type'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['root'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
                                    echo $cdr['ord'];
                                    echo "</td>";
                                    echo "<td class='text text-center'>";
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=accounting_type&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=accounting_type&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=accounting_type&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
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
        $sql = "SELECT * FROM accounting_type WHERE id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $type = $cdr['type'];
            $root = $cdr['root'];
            $ord = $cdr['ord'];
            $name = $cdr['name'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail Accounting Type Data</th>
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
                                <td>root</td>
                                <td><?php echo $root ;?></td>
                            </tr>
                            <tr>
                                <td>order</td>
                                <td><?php echo $ord ;?></td>
                            </tr>
                            <tr>
                                <td>ชื่่อประเภทบัญชี</td>
                                <td><?php echo $name ;?></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=accounting_type&task=def","_self")' />
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
            $func = "Add Data Accounting Type";
            $type = "1";
            $root = "";
            $ord = "";
            $name = "";
        }
        else{
            $func = "Edit Data accounting_type";
            $sql = "SELECT * FROM accounting_type WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $id = $cdr['id'];
            $type = $cdr['type'];
            $root = $cdr['root'];
            $ord = $cdr['ord'];
            $name = $cdr['name'];
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
                            echo "<tr>";
                            echo "<td>ประเภท</td>";
                            echo "<td>";
                            echo "<select name='type'>";
                            $a = 1;
							while ($a < 6)
							{
								if ($a == $type) 
								{
									echo "<option value=".$a." selected>".$a."</option>";
								}
								else
								{
									echo "<option value='".$a."'>".$a."</option>";
								}
                                $a++;
							}
					
							echo "</select>";
                            echo "</td>";
                            echo "</tr>";
                            ?>
                            
                            <tr>
                                <td>root</td>
                                <td><input class="form-control-sm" name="root" type="text" placeholder="ใส่root" maxlength="50" value="<?php echo $root ?>" ></td>
                            </tr>
                            <tr>
                                <td>order</td>
                                <td><input class="form-control-sm" name="ord" type="text" placeholder="ใส่order" value="<?php echo $ord ?>"></td>
                            </tr>
                            <tr>
                                <td>ชื่่อประเภทบัญชี</td>
                                <td><input class="form-control-sm" type="text" name="name" placeholder="ใส่ชื่่อประเภทบัญชี" value="<?php echo $name ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='accounting_type' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=accounting_type&task=def","_self")' />
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
		    $sql = "update `accounting_type` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=accounting_type&task=def");
        }
        else if($stat == 0){
            $sql = "update `accounting_type` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=accounting_type&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $type = $_REQUEST['type'];
        $root = $_REQUEST['root'];
        $order = $_REQUEST['ord'];
        $name = $_REQUEST['name'];
        
        $conn = new connect();
        if($id == 0 ){
            $sql = "INSERT INTO accounting_type (type, root, ord, name, status) VALUE ('$type', '$root', '$order', '$name', '1')";
            $conn->query($sql);
            header("location:index.php?option=accounting_type&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0 ){
            $sql = "UPDATE accounting_type SET type = '$type', root = '$root', ord = '$order', name = '$name' WHERE id = '$id'";
            $conn->query($sql);    
            header("location:index.php?option=accounting_type&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=accounting_type&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
}

?>