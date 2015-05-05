<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('major');
//$char1 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');
//$char2 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');
$char1= array('H','B','C');
$char2= array('H','B','C');
 //for ($temp1 = 0; $temp1 <20; $temp1++)
  for ($temp1 = 0; $temp1 <3; $temp1++)
 {$sum=0;
      for ($temp = 0; $temp < 3; $temp++)
	  {
	        $c=0;
			
			$query = "select * from protein_aplusb_combined";
			$result = mysql_query($query);
			while ($row = mysql_fetch_array($result)) {
			
			$sample = $row['residue'];
			$che= $row['che'];
			$length = strlen($sample);
			
			for($i=1;$i<$length;$i++)
			{
			
		//	if($sample[$i-1]=="$char1[$temp1]" && $sample[$i]=="$char2[$temp]")
			if($che[$i-1]=="$char1[$temp1]" && $che[$i]=="$char2[$temp]")
			$c++;
			}
			
			}
		    echo $char1[$temp1]."  ";
			echo $char2[$temp]."   ";
			echo $c."     ";
		
			$sum=$sum+$c;
			echo $sum;
         	echo "<br />";
	
			   $querytoUpdate="update vittra set `$char2[$temp]`= '$c' where `id`='$char1[$temp1]'";
		       $result1 = mysql_query($querytoUpdate);
						
						
		}
  }
	
					


?>