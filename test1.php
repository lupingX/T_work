
<?php
$mysqliObj =  new mysqli("localhost", "root", "",'db1');	//连接数据库系统


$mysqliObj->query("set name utf8");
$mysqliObj->query("use db1");
$sql1 = "show databases;";

$result = $mysqliObj->query($sql1);
if($result === false){
	echo "Failure："  .  mysql_error();
}
else{
	//此时，$result就是“结果集”（数据集）；
	echo "Success：";

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


function get_array_elems($arrResult, $where="C: "){
	global $mysqliObj;
 	while(list($key,$value)=each($arrResult)){
    	if (is_array($value)){
      	get_array_elems($value, $where."$key ");
    }
    	else {
      	for ($i=0; $i<count($value);$i++){
      	// echo $where.$value."<BR>\n";
      // inset sql by using $where and $value
      // $a= $where;
      // echo $a;
      $sql3="INSERT INTO `tab2`( `folder`) VALUES ('$where')";
      $mysqliObj->query($sql3);
      $sql4= "SELECT `id` FROM `tab2` WHERE folder='$where'";
      $result = $mysqliObj->query($sql4);

      $rec = $result->fetch_row();
      // echo "<BR>\n".$rec[0];
      $sql5= "INSERT INTO `tab1`(`FileName`, `folder_id`) VALUES ('$value',' $rec[0]')";
      $mysqliObj->query($sql5);
      // $sql4= "INSERT INTO `tab1`(`FileName`, `folder_id`) VALUES ([value-1],[value-2],[value-3])"
      	}
    }
 }
}
function search_Sql($content){
	$edit_content = '%'.$content.'%';
	// echo $edit_content;
	global $mysqliObj;
	$sql = "SELECT `tab1`.`FileName`, `tab2`.`folder` FROM `tab1` LEFT JOIN `tab2` on `tab1`.`folder_id`=`tab2`.`id` WHERE `tab1`.`FileName` Like '$edit_content' ";
	$i=0;
	if($result = $mysqliObj->query($sql)){		
		while ( $rec = $result->fetch_row()) {
			$Result_sql[$i]=$rec[1].$rec[0];
			echo "<BR>\n".$Result_sql[$i];
			$i++;
			
		}
	}
	$sql = "SELECT `tab2`.`folder` FROM `tab2` WHERE `tab2`.`folder` LIKE '$edit_content' ";
	if($result = $mysqliObj->query($sql)){		
		while ( $rec = $result->fetch_row()) {
			$Result_sql[$i]=$rec[0];
			echo "<BR>\n".$Result_sql[$i];
			$i++;
			
		}
	}

}
 // get_array_elems($file_system);
	// $sql3="INSERT INTO `tab2`( `folder`) VALUES ($where)";
 //      $result = $mysqliObj->query($sql1);
 $content=$_POST['data1'];
 print_r($_POST);
 echo $content;
 search_Sql($content);
?>