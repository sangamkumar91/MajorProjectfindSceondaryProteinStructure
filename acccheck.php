<?php
    $first=$_POST["first"];
	$second=$_POST["second"]; 
	
	$arr1 = str_split($first);
	$arr2 = str_split($second);

    $length = strlen($first);
    $length1 = strlen($second);
	
    if ($length != $length1) {
        echo "ID=" . $row['id'] . " <br>  Sr.No=" . $row['sr'] . "Length Incorrect";
        ?>

        <script>

            alert("Enter Same length")

        </script>

        <?php

    } else {
	$c=0;
			for($i=0;$i<$length;$i++)
			{				
			if($arr1[$i]==$arr2[$i] && $arr1[$i]!='-' )
				{
					$c++;
				}
			}
			$k=0;
			for($i=0;$i<$length;$i++)
			{				
			if($arr1[$i]!='-' )
				{
					$k++;
				}
			}		
$ratio=$c/$k;
 $acc =$ratio*100;
 echo $acc;
}
?>