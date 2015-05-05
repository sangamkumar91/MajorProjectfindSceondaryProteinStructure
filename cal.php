<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('major');
$char2 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');
$char1 = array('alpha_count', 'beta_count', 'coil_count');

for ($temp = 0; $temp < 20; $temp++)
{
 $e=0;
 for ($temp1 = 0; $temp1 < 3; $temp1++)
 {
            $query="select * from protensity_aplusb_combined where r_name='$char2[$temp]'";
			$result=mysql_query($query);
			$value=mysql_result($result,0,"$char1[$temp1]");
		    $e = $e+$value;
 }
 for ($temp1 = 0; $temp1 < 3; $temp1++)
 {
            $query="select * from protensity_aplusb_combined where r_name='$char2[$temp]'";
			$result=mysql_query($query);
			$value=mysql_result($result,0,"$char1[$temp1]");
		    $value = $value/$e;
			$query4="update emission_aplusb_combined set $char1[$temp1]=$value where id='$char2[$temp]'";
			$reult4=mysql_query($query4);
 }
 
 
 
 echo "<br>";
echo $e;
}
?>