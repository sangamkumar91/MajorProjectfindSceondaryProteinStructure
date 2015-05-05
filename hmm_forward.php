<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HMM_Forward</title>
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
 <h1> Hidden Markov Model Forward Algorithm </h1>
<form action="hmm_forward.php" method="get">
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

$f_values= array();

$f_rear=1;

$f_front= array(3);

$sum=1;
$emissive= array(3) ;
$transmissive =0;
 $len= strlen($sample);
 if($len==0){
    ?> <script>
     
     alert("No Sample Entered. Please Enter a Sample.");
     
     </script>
 <?php
 }
 

for($i=0;$i<$len;$i++)
{

$query = "select * from emission_aplusb_combined where id='$sample[$i]'";
$result = mysql_query($query);


while ($row = mysql_fetch_array($result))
{

$emissive[0]= $row["alpha_count"];
$emissive[1]= $row["beta_count"];
$emissive[2]= $row["coil_count"];

}

for($j=0;$j<3;$j++)
{

$f_front[$j]= $emissive[$j]* $sum;

}

if ($f_front[0]>=$f_front[1] && $f_front[0]>=$f_front[2])
{
$f_values[$i]=$f_front[0];
$che[$i]="H";

} 

if ($f_front[1]>=$f_front[0] && $f_front[1]>=$f_front[2])
{
$f_values[$i]=$f_front[1];
$che[$i]="B";

} 

if ($f_front[2]>=$f_front[1] && $f_front[2]>=$f_front[0])
{
$f_values[$i]=$f_front[2];
$che[$i]="C";

} 

if($sample[$i+1]==true)
{
$query_1 = "select * from transmission_aplusb_combined where id='$sample[$i]'";
$string= $sample[$i+1];

$result_1 = mysql_query($query_1);

while ($row_1 = mysql_fetch_array($result))
{

$trasmissive=$row_1[$string];
}



$sum= $sum+ $f_values[$i]*$tranmissive;
}
}
echo "<table>";
echo "<tr>";
echo "<td>Sample=</td>";
for($i=0;$i<$len;$i++)
{
    echo "<td>".$sample[$i]."</td>";


}
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