<?php 
class user_group{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>User Group Data</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input class="btn btn-info btn-sm" type="button" value="Add" onclick='window.open("index.php?option=user_group&task=edit&id=0","_self")' />
                        <input type="hidden" name="option" value="user_group">
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
                                 $sql = "SELECT * FROM user_group ORDER BY id DESC";
                                 $conn = new connect();
                                 $a = 1;
                                 $res = $conn->query($sql);
                                 while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $a ;
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=user_group&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='Edit' onclick='window.open(\"index.php?option=user_group&task=edit&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-danger btn-sm $active' type='button' value='active' onclick='confirm_del(\"index.php?option=user_group&task=del&id=".$cdr['id']."&stat=".$cdr['status']."\",\"_self\")' />";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                 }
                            ?>
                        </tbody>
                    </table>
        <?php 
    }
    function det(){
        $id=$_REQUEST["id"];
        $sql = "SELECT * FROM user_group WHERE id = $id ";
        $conn = new connect();
        $res = $conn->query($sql);
        while($cdr=$res->fetch()){
            $id = $cdr["id"];
            $name = $cdr['name'];
            $detail = $cdr['detail'];
        }
        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Detail User Group Data</th>
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
                                <td>รายละเอียด</td>
                                <td><?php echo $detail ;?></td>
                            </tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=user_group&task=def","_self")' />
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
            $func = "Add Data user_group";
            $id = "";
            $name = "";
            $detail = "";
        }
        else{
            $func = "Edit Data user_group";
            $sql = "SELECT * FROM user_group WHERE id = $id";
            $conn = new connect();
            $res = $conn->query($sql);
            $cdr=$res->fetch();
            $id = $cdr['id'];
            $name = $cdr['name'];
            $detail = $cdr['detail'];
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
                                <td><input class="form-control-sm" name="name" type="text" placeholder="ใส่ชื่อ user_group" maxlength="50" value="<?php echo $name ?>" required></td>
                            </tr>
                            <tr>
                                <td>รายละเอียด</td>
                                <td><input class="form-control" type="text" name="detail" placeholder="ใส่ที่รายละเอียด" maxlength="50" value="<?php echo $detail ;?>"></td>
                            </tr>
                            <tr>
							<td colspan='2' class='text-center'>
								<input type='hidden' name="option" value='user_group' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=user_group&task=def","_self")' />
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
		    $sql = "update `user_group` set `status` = '0' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=user_group&task=def");
        }
        else if($stat == 0){
            $sql = "update `user_group` set `status` = '1' where `id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=user_group&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $detail = $_REQUEST['detail'];
        $conn = new connect();

        if($id == 0 ){
            $sql = "INSERT INTO user_group (name, detail, status) VALUE ('$name', '$detail', '1')";
            $conn->query($sql);
            header("location:index.php?option=user_group&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else if($id > 0){
            $a = 1;
            $sql = "UPDATE user_group SET name = '$name', detail = '$detail', status = '1' WHERE id = '$id'";
            $conn->query($sql);
            header("location:index.php?option=user_group&task=def");
            $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        }
        else{
            header("location:index.php?option=user_group&task=def");
            $conn->alert("มีข้อผิดพลาดโปรกรอกข้อมูลใหม่", 2);
        }
    }
}

?>