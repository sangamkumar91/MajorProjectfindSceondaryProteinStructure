<?php mysql_connect('localhost', 'root', '');
mysql_select_db('major');
$char1 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');
$query = "select * from protein";
$result = mysql_query($query);$con=0;
for ($temp1 = 0; $temp1 < 20; $temp1++)
 {
 $con=0;
 
while ($row = mysql_fetch_array($result)) {

    $sample = $row['residue'];
    $che = $row['che'];
    $sample_id = $row['id'];
	
	$length = strlen($sample);
	
	for ($temp2 = 0; $temp2 < $length; $temp2++) 
	{
         if ($sample[$temp2] == "$char1[$temp1]" && $che[$temp2]== 'C')
		 $con++;
	}
	
	
	}
	echo $con;
	echo "<br>";
	
	
	}
	?>