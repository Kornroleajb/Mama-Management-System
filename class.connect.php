<?php

class connect
{
    function conn()
    {
        $host = 'localhost';
        $dbname = 'project_mama';
        $user = 'root';
        $pass ="";
        $conn = new PDO 
        ("mysql:host=$host;dbname=$dbname","$user","$pass");
        $conn->exec("set names utf8");
        return $conn;
    }

    function query($sql)
    {
        $conn = $this->conn();
        $res = $conn->prepare($sql);          
        $res->execute();
        return $res;
    }

    function query_lastid($sql)
	{
        $conn = $this->conn(); //เรียกใช้ฟังก์ชันใน class
        $res = $conn->prepare($sql);
        $res->execute();
        return $conn->lastInsertId();
	}
	
	function save_logs($text, $uid)
    {
        $date = date("Y-m-d-H-i-s");
        $sql = "INSERT INTO logs set uid = '$uid', action = '$text', datetime = '$date'";
		$this->query($sql);
    }

    function alert($text, $type_alert)
    {
       $_SESSION['alert'] = $text;
       if($type_alert == 1){
            $_SESSION['type'] = "success";
       }
       else if($type_alert == 2){
        $_SESSION['type'] = "danger";
        }
    }

    function check_access_control_list()
	{
		if (isset($_REQUEST['option']))
		{
			$option = $_REQUEST['option'];
		}
		else
		{
			$option = "logs";
		}
		$sql = "select max(`access_control_list`.`accl`) as `mca` from `application`, `access_control_list`, `user_in_group` where `application`.`name` = '".$option."' and `access_control_list`.`status` = '1' and `user_in_group`.`status` = '1' and `access_control_list`.`appid` = `application`.`id` and `access_control_list`.`ug_id` = `user_in_group`.`ug_id` and `user_in_group`.`uid` = '".$_SESSION['uid']."'";
		$res = $this->query($sql);
		while ($cdr = $res->fetch())
		{
			$access_control_list = $cdr['mca'];
		}
		return $access_control_list;
	}

    function get_app_control($id)
	{
		if ($id == 0)
		{
			$aa = array(0 => "No Access", 1 => "Read", 2 => "Write", 3 => "Read + Write", 4 => "Approve", 5 => "Read + Approve", 6 => "Write + Approve", 7 => "Full Access");
		}
		elseif ($id == 1)
		{
			$aa = array(1 => "Read", 0 => "No Access", 2 => "Write", 3 => "Read + Write", 4 => "Approve", 5 => "Read + Approve", 6 => "Write + Approve", 7 => "Full Access");
		}
		elseif ($id == 2)
		{
			$aa = array(2 => "Write", 0 => "No Access", 1 => "Read", 3 => "Read + Write", 4 => "Approve", 5 => "Read + Approve", 6 => "Write + Approve", 7 => "Full Access");
		}
		elseif ($id == 3)
		{
			$aa = array(3 => "Read + Write", 0 => "No Access", 1 => "Read", 2 => "Write", 4 => "Approve", 5 => "Read + Approve", 6 => "Write + Approve", 7 => "Full Access");
		}
		elseif ($id == 4)
		{
			$aa = array(4 => "Approve", 0 => "No Access", 1 => "Read", 2 => "Write", 3 => "Read + Write",  5 => "Read + Approve", 6 => "Write + Approve", 7 => "Full Access");
		}
		elseif ($id == 5)
		{
			$aa = array(5 => "Read + Approve", 0 => "No Access", 1 => "Read", 2 => "Write", 3 => "Read + Write", 4 => "Approve", 6 => "Write + Approve", 7 => "Full Access");
		}
		elseif ($id == 6)
		{
			$aa = array(6 => "Write", 0 => "No Access", 1 => "Read", 2 => "Write", 3 => "Read + Write", 4 => "Approve", 5 => "Read + Approve + Approve", 7 => "Full Access");
		}
		elseif ($id == 7)
		{
			$aa = array(7 => "Full Access", 0 => "No Access", 1 => "Read", 2 => "Write", 3 => "Read + Write", 4 => "Approve", 5 => "Read + Approve", 6 => "Write + Approve");
		}
		return $aa;
	}

}

?>