<?php

	// $now=time();//获取当前时间的时间戳;
// ;

	// $now="2011-08-09"; 
	// echo $now;
	// $date_str=date('w',strtotime($now));
	// echo "<br />".$date_str;
	// $year="2012";
	// $year_start = $year. "-01-01"; 
	// $year_end = $year. "-01-02";
	// echo "<br />".$year_end.$year_start;
	// $startday =strtotime($year_start);
	// $endday =strtotime($year_end);
	// echo  "<br />".$startday;
	// $oneDay = 24*3600;
	// echo  "<br />".($endday-$startday);
	// while($startday < $endday){
	// 	break;
	// 	$startday = $startday+$oneDay;
	// }
	// $payrolDay = get_payrolDay(2016);
	$expenseDay=get_ExpenseDay(2015);
	// foreach ($payrolDay as $va) {
	// 	echo  "<br />".$va;
	// }
	$firstDay="01/01/2015";
	$time_lastDay=strtotime($firstDay . '+'. (1). 'month -1 day');
	echo $time_lastDay;
	$midDay ="01/05/2015";
	$time_next_MidDay=strtotime($midDay.'+1 month +1 day');
	echo $time_next_MidDay;
	// print_r($payrolDay);
	// 
	// echo "<br />".date('w',strtotime("2016-01-03"));
	// $firstDay = "2006-01-01";
	// echo "<br />".$firstDay;
	// echo "<br />".strtotime($firstDay);
	// $str = strtotime($firstDay . ' +1 month -1 day');
	// // $firstDay = date('Y-m-d',$str);
	// // $lastDay=date('Y-m-d', $str);
	// echo "<br />".$str;
	// // $firstDay=date('01/m/Y', strtotime($firstDay . ' +1 month'));
	// $lastDay=date('Y-m-d', strtotime($firstDay . ' +1 month -1 day'));
	// echo "<br />".$lastDay;
	// // $firstDay=date('01/m/Y', strtotime($firstDay . ' +2 month'));
	// $lastDay=date('Y-m-d', strtotime($firstDay . ' +1 month -1 day'));
	// echo "<br />".$lastDay;
	// // $firstDay=date('01/m/Y', strtotime($firstDay . ' +3 month'));
	// $lastDay=date('Y-m-d', strtotime($firstDay . ' +1 month -1 day'));
	// echo "<br />".$lastDay;
	function get_payrolDay($year){
		$firstDay = "01/01/".$year;
		$num_firstDay= strtotime($firstDay);
		$oneday=3600*24;
		for($i=0;$i<12;$i++){
			$time_lastDay=strtotime($firstDay . '+'. ($i+1). 'month -1 day');
			$lastDay=date('d/m/Y', $time_lastDay);
			// echo "<br />".$lastDay;
			
			// $time_lastDay= strtotime($lastDay);
			// echo "<br />".$time_lastDay;
			$PredicW= date('w',$time_lastDay);
			// $PredicW= date('N',strtotime($firstDay . '+'. ($i+1). 'month -1 day'));
			echo "<br />".$PredicW;
			if($PredicW!=5){
				if($PredicW>5){
					$payrolDay[$i]=date('d/m/Y', $time_lastDay-($PredicW-5)*$oneday);

				}else{
					$payrolDay[$i]=date('d/m/Y', $time_lastDay-(7+$PredicW-5)*$oneday);
				}
				
			}else{
				$payrolDay[$i]=$lastDay;
			}
			echo "<br />".$payrolDay[$i];
			// $firstDay=date('01/m/Y', strtotime($firstDay . ' +'.$i+1, 'month'));
			// echo "<br />".$firstDay;
		}
		return $payrolDay;
		
	}


	function get_ExpenseDay($year){
		$midDay =$year."-01-15";
		echo "<br />".$midDay;
		$num_midDay= strtotime($midDay);
		$oneday=3600*24;
		for($i=0;$i<12;$i++){
			$time_next_MidDay=strtotime($midDay . '+'. ($i). 'month');
			// echo "<br />".$time_next_MidDay;
			$next_MidDay=date('d/m/Y', $time_next_MidDay);
			 // echo "<br />".$next_MidDay;
			
			// $time_lastDay= strtotime($lastDay);
			// echo "<br />".$time_lastDay;
			$PredicW= date('w',$time_next_MidDay);
			echo "<br />".$PredicW;
			if($PredicW==6){
				$expenseDay[$i]=date('d/m/Y', $time_next_MidDay+2*$oneday);
				echo "<br />".$PredicW;
			}
			else if($PredicW==0){
				$expenseDay[$i]=date('d/m/Y', $time_next_MidDay+1*$oneday);
			}else{
				$expenseDay[$i]=date('d/m/Y', $time_next_MidDay);
			}
			echo "<br />".$expenseDay[$i];
		}
		return $expenseDay;
	}
?>