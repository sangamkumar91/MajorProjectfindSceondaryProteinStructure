<?php



mysql_connect('localhost', 'root', '');
mysql_select_db('major');

$query= "select coil_count,r_id from vir";
$result= mysql_query($query);
$rows=mysql_num_rows($result);

while ($i<$rows) 
{
$thisre=mysql_result($result,$i,"coil_count");
$thisrid=mysql_result($result,$i,"r_id");
$thisre=$thisre/781;

$query1="update vir set coil_count=$thisre where r_id='$thisrid'";
$res=mysql_query($query1);
$i++;
    
}
echo $con++;
?>