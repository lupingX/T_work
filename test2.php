<!DOCTYPE html>
<html>
<head>
	<title>test2</title>
</head>
<body>
	<form  action="test2.php" method="post">
	year：<input type="text" required ="required" name="data1" />
	<br />
	<input type="submit" value="submit" />
</form>
</body>
</html>

<?php
 if( !empty($_POST) ){
 	 $content=$_POST['data1'];


 	    class Account{


 	   	var $year;
 	   	function __construct($year) {
        $this->year = $year;   //constructor!
      
    } 

    	/*
    	   get_ExpenseDay : Expenses date is 15th of each month and if this date is a weekend
		   Expenses Date will be the next Monday.

    	   get the 15th of every month, then check whether its weekend.
    	 */
		function get_ExpenseDay(){
		// echo "<br />ExpenseDay:";
			$midDay =$this->year."-01-15";
			// echo "<br />".$midDay;
			$num_midDay= strtotime($midDay);
			$oneday=3600*24;
			for($i=0;$i<12;$i++){
				$time_next_MidDay=strtotime($midDay . '+'. ($i). 'month');
				//add one month 
				$next_MidDay=date('d/m/Y', $time_next_MidDay);
				//turn str to time format
				$PredicW= date('w',$time_next_MidDay);
				//get the corresponding day in week.
				if($PredicW==6){
					$expenseDay[$i]=date('d/m/Y', $time_next_MidDay+2*$oneday);
					//if its saturday, add 2 days then.
				}
				else if($PredicW==0){
					$expenseDay[$i]=date('d/m/Y', $time_next_MidDay+1*$oneday);
					//if its sunday, add one day then
				}else{
					$expenseDay[$i]=date('d/m/Y', $time_next_MidDay);
				}
				// echo "<br />".$expenseDay[$i];
			}
			return $expenseDay;
		}	
	
		/*
			get_payrolDay: payrolDay is the last friday of every month

			get the last day of every month, then check whether its friday
		 */
		function get_payrolDay(){
			$firstDay = "01/01/".$this->year;
			$num_firstDay= strtotime($firstDay);
			$oneday=3600*24;
			for($i=0;$i<12;$i++){
				$time_lastDay=strtotime($firstDay . '+'. ($i+1). 'month -1 day');
				//(str)get the last day of every month
				$lastDay=date('d/m/Y', $time_lastDay);
				//(data format)get the last day of every month
				$PredicW= date('w',$time_lastDay);
				//get the corresponding day in week. Then do some adjustment;
				if($PredicW!=5){
					if($PredicW>5){
						$payrolDay[$i]=date('d/m/Y', $time_lastDay-($PredicW-5)*$oneday);
						//if its saturday, then minus one day
					}else{
						$payrolDay[$i]=date('d/m/Y', $time_lastDay-(7+$PredicW-5)*$oneday);
						//if its sunday to 4, then minus corresponding days;
					}
					
				}else{
					$payrolDay[$i]=$lastDay;
				}
				// echo "<br />".$payrolDay[$i];
				// $firstDay=date('01/m/Y', strtotime($firstDay . ' +'.$i+1, 'month'));
				// echo "<br />".$firstDay;
			}
			return $payrolDay;
			
		}
	}

	$account= new Account($content);
	//create a new obj
	$expenseDay=$account->get_ExpenseDay();
	//call for get_ExpenseDay method to get expense day
	$payrolDay=$account->get_payrolDay();

	//output
	echo "<br />ExpenseDate\tPayrolDate";
	for ($i=0;$i<12;$i++){
		echo "<br />".$expenseDay[$i]."\t".$payrolDay[$i];
	}
	


}
?>