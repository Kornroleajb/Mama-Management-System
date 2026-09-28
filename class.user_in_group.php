<?php 
class user_in_group{
    function def(){
        ?>
        
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <h1>User In Group</h1>
                <form action="index.php" method="get">
                        <input name="searcher">
                        <input class="btn btn-secondary btn-sm" type="submit" value="Search">
                        <input type="hidden" name="option" value="user_in_group">
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
                                 $sql = "SELECT * FROM user_group WHERE status > 0 ORDER BY id DESC";
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
						            echo "<input class='btn btn-primary btn-sm' type='button' value='Detail' onclick='window.open(\"index.php?option=user_in_group&task=det&id=".$cdr['id']."\",\"_self\")' />";
                                    echo "<input class='btn btn-warning btn-sm' type='button' value='edit' onclick='window.open(\"index.php?option=user_in_group&task=edit&id=".$cdr['id']."\",\"_self\")' />";
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
                                <th colspan="2" class="text-center">Detail User In Group Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อ</td>
                                <td><?php echo $name ;?></td>
                            </tr>
							<td colspan='2' class='text-center'>
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=user_in_group&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="1" class="text-center">No</th>
                                <th colspan="1" class="text-center">Users</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $a = 1;
                                $sql = "SELECT us.username AS users FROM users AS us INNER JOIN user_in_group AS uig ON us.id = uig.uid WHERE uig.status > 0 AND uig.ug_id = $id";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td class='text text-center'>";
                                    echo $a;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $cdr['users'];
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                                }
                                
                            
                            ?>
                         
                        </tbody>
                    </table>
                    <form>
                </div>
            </div>
        </div>
        <?php 
    }
    function edit(){
        $id = $_REQUEST["id"];
        $sql = "SELECT * FROM user_group WHERE id = $id";
        $conn = new connect();
        $res = $conn->query($sql);
        $cdr = $res->fetch();

        ?>
        <div class="container">
            <div class ="row">
                <div class = "col-12">
                <form action='index.php' method='get'>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center"> User In Group </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ชื่อ group</td>
                                <td><?php echo $cdr['name'] ;?></td>
                            </tr>
							<td colspan='2' class='text-center'>
                            <input type='hidden' name="option" value='user_in_group' />
								<input type='hidden' name="task" value='save' />
								<input type='hidden' name="id" value='<?php echo $id;?>' />
								<input class='btn btn-primary btn-sm' type='submit' value='Save' />
								<input class='btn btn-secondary btn-sm' type='button' value='Back' onclick='window.open("index.php?option=user_in_group&task=def","_self")' />
							</td>
						</tr>
                        </tbody>
                    </table>
                    <table class= "table table-bordered table-striped">
                        <thead>
                            <tr>
							    <th class='text-center'> Check </th>
							    <th class='text-center'> Username </th>
							    <th class='text-center'> Name </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT *, (SELECT COUNT(id) FROM user_in_group AS uig WHERE ug_id = $id AND uid = us.id AND uig.status > 0 ) AS cc FROM users AS us WHERE status > 0 ";
                                $conn = new connect();
                                $res = $conn->query($sql);
                                while($cdr=$res->fetch()){
                                    echo "<tr>";
                                    echo "<td class='text-center' >";
							        if ($cdr['cc'] == 1)
							        {
							        	echo "<input class='form-check-input' type='checkbox' name='uig[]' value='".$cdr['id']."' checked />";
							        }
							        else
							        {
							        	echo "<input class='form-check-input' type='checkbox' name='uig[]' value='".$cdr['id']."' />";
							        }
                                    echo "</td>";
                                    echo "<td class='text-center'>";
                                    echo $cdr['username'];
                                    echo "</td>";
                                    echo "<td class='text-center'>";
                                    echo $cdr['firstname'], "&nbsp", $cdr['lastname'];
                                    echo "</td>";
                                    echo "</tr>";
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
		    $sql = "update `access_control_list` set `status` = '0'  where `ug_id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=access_control_list&task=def");
        }
        else if($stat == 0){
            $sql = "update `access_control_list` set `status` = '1'  where `ug_id` = '".$id."'";
		    $conn = new connect();
		    $conn->query($sql);
		    header("location:index.php?option=access_control_list&task=def");
        }
    }

    function save(){
        $id = $_REQUEST['id'];
        $conn = new connect();
        $sql = "UPDATE user_in_group SET status = 0 WHERE ug_id = '$id' ";
		$conn->query($sql);   
        foreach($_REQUEST['uig'] as $uid){
            $sql = "INSERT INTO  user_in_group (uid, ug_id, status) VALUE($uid, $id, 1)";
            $conn->query($sql);  
        }      
        header("location:index.php?option=user_in_group&task=def");
        $conn->alert("บันทึกข้อมูลสำเร็จ", 1);
        
    }
}

?>