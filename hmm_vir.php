<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VITERBI</title>
<style>
    body{
        
        background-color: orange;}
        table{
                border-bottom: 2px solid black;
                border-left: 2px solid black;
                    border-top: 2px solid black;
            } 
            td
{
border-right: 3px solid red;
padding: 2px;

text-align: center;
}
        
     
        
    
    
    
    
    </style>
</head>

<body>
<h1> Viterbi Algorithm </h1>
<form action="hmm_vir.php" method="get">
<input type="text" name="sample" placeholder="Enter Sample">

<input type="submit" value="submit" name="submit">

</form>


<?php
error_reporting(0);
if($_GET["submit"])
{
$sample= $_GET["sample"];

mysql_connect('localhost', 'root', '');
mysql_select_db('major');
$che= array();

$p_values_i=array(3);
$p_values_mod=array(3);
$p_values_i1=array(3);
$emission=array(3);

$max=array(3);
$transition=array(3);
$len= strlen($sample);
if($len==0){
    ?> <script>
     
     alert("No Sample Entered. Please Enter a Sample.");
     
     </script>
 <?php
 }

$p_values_i[0]= log(.33)/log(2.0);
$p_values_i[1]=log(.33)/log(2.0);
$p_values_i[2]=log(.33)/log(2.0);
/*
$p_values_i[0]= .33;
$p_values_i[1]=.33;
$p_values_i[2]=.33;
*/
for($i=0;$i<$len;$i++)
{

$query = "select * from emission where id='$sample[$i]'";
$result = mysql_query($query);


while ($row = mysql_fetch_array($result))
{

$emission[0]= log($row["alpha_count"])/log(2.0);
$emission[1]= log($row["beta_count"])/log(2.0);
$emission[2]= log($row["coil_count"])/log(2.0);
/*
$emission[0]= $row["alpha_count"];
$emission[1]= $row["beta_count"];
$emission[2]= $row["coil_count"];
*/}

if($i>0)
		for($k=0;$k<3;$k++)
		{
			
			if($k==0) $x="H";
			if($k==1)$x="B";
			if($k==2)$x="C";
			$query1 = "select * from virtra where id='$x' ";
			$result1 = mysql_query($query1);
			
			while ($row = mysql_fetch_array($result1))
			{
			
			$transition[0]= log($row["H"])/log(2.0);
			$transition[1]= log($row["B"])/log(2.0);
			$transition[2]= log($row["C"])/log(2.0);
			/*
			$transition[0]= $row["H"];
			$transition[1]= $row["B"];
			$transition[2]= $row["C"];
			*/
			}


			
			
			for($j=0;$j<3;$j++)
			{ 
			 $max[$j]=$p_values_i1[$j]+$transition[$j];
			}
		
				
					if ($max[0]>=$max[1] && $max[0]>=$max[2])
					{
					$p_values_i[$k]=$max[0];
					} 
					
					if ($max[1]>=$max[0] && $max[1]>=$max[2])
					{
					$p_values_i[$k]=$max[1];
					} 
					
					if ($max[2]>=$max[1] && $max[2]>=$max[0])
					{
					$p_values_i[$k]=$max[2];
					} 
		
		}
		
		
		for($j=0;$j<3;$j++)
			{ 
			 $p_values_i[$j]=$p_values_i[$j]+$emission[$j];
			}
			
			
		for($j=0;$j<3;$j++)
		{ 
		 $p_values_i1[$j]=$p_values_i[$j];
		$p_values_mod[$j]=pow(2,$p_values_i[$j]);
		//   $p_values_mod[$j]=$p_values_i[$j];
		}
		
		
			
		if ($p_values_mod[0]>=$p_values_mod[1] && $p_values_mod[0]>=$p_values_mod[2])
		{
		$che[$i]="H";
		} 
		
		if ($p_values_mod[1]>=$p_values_mod[0] && $p_values_mod[1]>=$p_values_mod[2])
		{
		$che[$i]="B";
		} 
		
		if ($p_values_mod[2]>=$p_values_mod[1] && $p_values_mod[2]>=$p_values_mod[0])
		{
		$che[$i]="C";
		} 
}

echo "<table>";
echo "<tr>";
echo "<td>Sample=</td>";
for($i=0;$i<$len;$i++)
    echo "<td>".$sample[$i]."</td>";
echo "</tr>";

echo "<tr>";

echo "<td>Result=</td>";
for($i=0;$i<$len;$i++)
echo "<td>".$che[$i]."</td>";

echo "</tr>";
echo "</table>";

}
?>
</body>
</html>
