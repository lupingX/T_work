<?php
$mysqliObj =  new mysqli("localhost", "root", "",'db1');	//连接数据库系统


$mysqliObj->query("set name utf8");
$sql1 = "show databases;";
$result = $mysqliObj->query($sql1);
if($result === false){
	echo "执行失败，请参考："  .  mysql_error();
}
else{
	//此时，$result就是“结果集”（数据集）；
	echo "执行成功！数据如下：";
	$rec = $result->fetch_row();
	echo "<br />";
	//echo $result;
	// while( $rec = mysql_fetch_array( $result )){
	// //mysql_fetch_array()会取出该结果集中的“一行数据”，并取得该行数据后赋值给$rec；
	// //此$rec就是一个数组，其下标就是字段名；
	// //在此while循环中，mysql_fetch_array()会一次次（一行行）取出结果集中的所有数据；
	// //然后，在这里就可以处理该数组$rec了：
		// echo "<br />f1：" . $rec[0];
	// 	echo "————f2：" . $rec['name'];
	// 	echo "————f3：" . $rec['age'];
	// }
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


function get_array_elems($arrResult, $where="C:\ "){
 while(list($key,$value)=each($arrResult)){
    if (is_array($value)){
      get_array_elems($value, $where."$key\ ");
    }
    else {
      for ($i=0; $i<count($value);$i++){
      echo $where.$value."<BR>\n";
      // inset sql by using $where and $value
      // $a= $where;
      // echo $a;
      
      }
    }
 }
}
 get_array_elems($file_system);

?>