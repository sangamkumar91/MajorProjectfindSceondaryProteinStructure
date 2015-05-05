<?php
$seq= $_POST["seq"];
echo $seq;
$arr1 = str_split($seq);
print_r($arr1);
$length= count($arr1);
echo $length;
$alphaarr= array();
$betaarr= array();
$turnarr= array();
$alphaout= array();
for($i=0;$i<$length; $i++)
{
	//echo "<br>";
//	echo $arr1[$i];
		


$host='127.0.0.1';
$us='root';
$ps='';
$connect=mysql_connect($host,$us,$ps);
					 
						if($connect)
						{	
							$db='project';
							mysql_select_db($db);
							
							$query4alpha="select * from data where amino='$arr1[$i]'";
							$result4alpha = MYSQL_QUERY($query4alpha);
							$alpha= MYSQL_RESULT($result4alpha,0,"alpha");
							$beta= MYSQL_RESULT($result4alpha,0,"beta");
							$turn= MYSQL_RESULT($result4alpha,0,"turn");
						}
						
						
						$alphaarr[]= $alpha;
						$betaarr[]=$beta;
						$turnarr[]=$turn;
							
	}	
	
	echo "<br/><br/><br/>";
	print_r($alphaarr);
	echo "<br/><br/><br/>";
		print_r($betaarr);	
		echo "<br/><br/><br/>";
		print_r($turnarr);		
/*			
$c=0;
$i=0;
$k=0;
	while($i<1)
	{    	
		for($j=$i;$j<6 ; $j++)
		{
			if($alphaarr[$j]>100)
			{
				$c++;
				echo $c;
				echo $alphaarr[$j];
				
			}
		}
		
		echo $j;
	
		if($c>4)
		{
			$c=0;
			$k=0;
			while($k!=4)
			{   
				if($alphaarr[$j]<100)
				{
							$k++;
							if($alphaarr[$j+1]<100)
							{
									$k++;
									if($alphaarr[$j+2]<100)
									{
											$k++;
												  if($alphaarr[$j+3]<100)
												  {
													$k++;
													if($k==4)
													{
														for($l=$i;$l<$j;$l++)
															$alphaout[$l]='H';
															
															continue;
													}
												  }
												  else
												  {
													$k=0;
													$j++;
													continue;
												  }
									}
									else
									{
										$k=0;
										$j++;
										
										continue;
									}
							  }
							  else
							  {
								$k=0;
								$j++;
								
								continue;
							  }
				  }
				   else
				  {
					$k=0;
					$j++;
					continue;
				  }
				  
			}echo "the value of j is ".$j;
			echo "<br>";
			$i=$j-1;
			$c=0;
			echo "the value of i is ".$i;
		}
		else
		{
			$i=$j-1;
			$c=0;
		echo "the value of i is ".$i;
		}
			
		}
		
		print_r($alphaout);	
		
		*/					
?>