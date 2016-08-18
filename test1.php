<!DOCTYPE html>
<html>
<head>
	<title>test1</title>
</head>
<body>
	<form  action="test1.php" method="post">
	search：<input type="text"  name="data1" />
	<br />
	<input type="submit" value="submit" />
	</form>
</body>
</html>

<?php
// check whether data transmitted
 if( !empty($_POST) ){

$mysqliObj =  new mysqli("localhost", "root", "");	//log in to the database
$mysqliObj->query("set name utf8");
$mysqliObj->query("CRAATE DATABASE db1");//create the needed db
$mysqliObj->query("use db1");
$sql1 = "show databases;";

$result = $mysqliObj->query($sql1);
if($result === false){
	echo "Connection Failed："  .  mysql_error();
}
else{
	//test whether this connection is started
	echo "Connection Succeed ：";

	while ( $rec = $result->fetch_row()) {
	
	// echo "<br />".$rec[0];
	}
	$sql1 = "create table tab1(id int auto_increment primary key,
								FileName varchar(100) unique key,
								folder_id int);";
	$sql2 = "create table tab2(id int auto_increment primary key,
							 folder varchar(100) unique key);";
	$mysqliObj->query($sql1);	
	$mysqliObj->query($sql2);
	//create 2 tables for saving data				 
}


	$file_system = array(
							'Documents' => array(
													'Images' => array(
																		'Image1.jpg',
																		'Image2.jpg',
																		'Image3.jpg'
													), 
													'Works' => array(
																		'Letter.doc',
																		'Accountant' => array(
																								'Accounting.xls',
																								'AnnualReport.xls'
																		)
													)
							),
							'Program Files' => array(
														'Skype' => array(
																			'Skype.exe',
																			'Readme.txt'
														),
														'Mysql' => array(
																			'Mysql.exe',
																			'Mysql.com'
														)
							)


	);

/*
this function is for saving the file_system into database by using iterative method
 */
function get_array_elems($arrResult, $where="C:\\\\"){
	global $mysqliObj;
 	while(list($key,$value)=each($arrResult)){
    	if (is_array($value)){
      	get_array_elems($value, $where."$key\\\\");
    }
    	else {
      	for ($i=0; $i<count($value);$i++){
      $sql3="INSERT INTO `tab2`( `folder`) VALUES ('$where')";
      // insert into the tab2 first cause we need this id for saving tab1;
      $mysqliObj->query($sql3);
      $sql4= "SELECT `id` FROM `tab2` WHERE folder='$where'";
      //find needed id
      $result = $mysqliObj->query($sql4);

      $rec = $result->fetch_row();
      // echo "<BR>\n".$rec[0];
      $sql5= "INSERT INTO `tab1`(`FileName`, `folder_id`) VALUES ('$value',' $rec[0]')";
      //then insert into tab1
      $mysqliObj->query($sql5);
      // $sql4= "INSERT INTO `tab1`(`FileName`, `folder_id`) VALUES ([value-1],[value-2],[value-3])"
      	}
    }
 }
}
function search_Sql($content){
	$edit_content = '%'.$content.'%';
	//use Ambiguous way for selecting, thats way adding %
	// echo $edit_content;
	global $mysqliObj;
	$sql = "SELECT `tab2`.`folder` FROM `tab2` WHERE `tab2`.`folder` LIKE '$edit_content' ";
	$i=0;
	if($result = $mysqliObj->query($sql)){		
		while ( $rec = $result->fetch_row()) {
			$Result_sql[$i]=$rec[0];
			echo "<BR>\n".$Result_sql[$i];
			$i++;
			
		}
	}//firstly, find in tab2 to get folder



	$sql = "SELECT `tab1`.`FileName`, `tab2`.`folder` FROM `tab1` LEFT JOIN `tab2` on `tab1`.`folder_id`=`tab2`.`id` WHERE `tab1`.`FileName` Like '$edit_content' ";
	// use Join to match fold_in(tab1) and id(tab2) 
	if($result = $mysqliObj->query($sql)){		
		while ( $rec = $result->fetch_row()) {
			$Result_sql[$i]=$rec[1].$rec[0];
			echo "<BR>\n".$Result_sql[$i];
			$i++;
			
		}
	}
	//then, find in tab1 to get folder and file

}

get_array_elems($file_system);

$content=$_POST['data1'];
	 // print_r($_POST);
	 // echo $content;
search_Sql($content);
$mysqliObj->close();//close this connection with database
	}
?>




