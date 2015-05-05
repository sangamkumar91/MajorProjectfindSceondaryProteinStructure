<?php
$seq= $_POST["seq"];

$arr1 = str_split($seq);

$length= count($arr1);

$alphaarr= array();
$betaarr= array();
$turnarr= array();
$alphaout= array();
for($i=0;$i<$length; $i++)
{
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
	

							
	?>
  <table>
         <tr>
           <?php
          echo "<td><b>SAMPLE</b></td>";    
            $i=0;
     while($i<$length){
         
        echo "<td>".$arr1[$i]."</td>";
        $i++;
         
     }
           
           ?>
         </tr>    
         
         
          <tr>
           <?php
        echo "<td><b>HELIX</b></td>";      
            $i=0;
     while($i<$length){
         
        echo "<td>     ".$alphaarr[$i]."     </td>";
        $i++;
         
     }
           
           ?>
         </tr> 
          <tr>
           <?php
        echo "<td><b>BETA</b></td>";      
            $i=0;
     while($i<$length){
         
        echo "<td>     ".$betaarr[$i]."      </td>";
        $i++;
         
     }
           
           ?>
         </tr> 
         
          <tr>
           <?php
     /*   echo "<td><b>TURN</b></td>";      
            $i=0;
     while($i<$length){
         
        echo "<td>      ".$turnarr[$i]."        </td>";
        $i++;
         
     }
           
      */     ?>
         </tr> 
         
     </table>

   