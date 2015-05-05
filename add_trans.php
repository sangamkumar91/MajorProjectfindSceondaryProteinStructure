<?php 
mysql_connect('localhost', 'root', '');
mysql_select_db('major');
//$char1 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');
//$char2 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');
$char1= array('H','B','C');
$char2= array('H','B','C');
$char3= array(3);

      for ($temp = 0; $temp < 3; $temp++)
	  {
	       $e=0;
		  // $query = "select * from transmission_aplusb_combined where `id`='$char1[$temp]'";
		     $query = "select * from vittra where `id`='$char1[$temp]'";
           $result = mysql_query($query);
		   while ($row = mysql_fetch_array($result)) 
		   {
		   
		   		for ($temp1 = 0; $temp1 < 3; $temp1++)
 				{
         
					$thisvalue=mysql_result($result,0,"$char2[$temp1]");
					$e = $e+$thisvalue;
					$char3[$temp]=$e;
			    }
			}
			echo $char1[$temp]."   ";
			echo $e;
			echo "<br>";
		}
		print_r($char3);


// divide to get the value of id = 1

  //   for ($temp = 0; $temp < 20; $temp++)
	 for ($temp = 0; $temp < 3; $temp++)
	  {
	      
		   $query = "select * from vittra where `id`='$char1[$temp]'";
           $result = mysql_query($query);
		   while ($row = mysql_fetch_array($result)) 
		   {
		   
		   		for ($temp1 = 0; $temp1 < 3; $temp1++)
 				{
         
					$thisvalue=mysql_result($result,0,"$char2[$temp1]");
					$thisvalue = $thisvalue/$char3[$temp1];
				    $query4="update vittra set $char2[$temp1]=$thisvalue where id='$char1[$temp]'";
			        $reult4=mysql_query($query4);						
			    }
			}
			
		}
		

		
		
		
		
?>