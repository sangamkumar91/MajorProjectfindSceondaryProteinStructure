<html>
    <body>
        <form action="chou_1.php" method="get">
            <input type="text" name="sample" placeholder="Enter Sample String">
            <input type="submit" name="structure">
        </form>
    </body>
</html>

<?php
error_reporting(0);

mysql_connect('localhost', 'root', '');
mysql_select_db('major');

if (isset($_GET["structure"])) {

    $sample = $_GET["sample"];
    echo "<b>Sample:</b>".$sample;
    echo "<br><br><br><br>";
    $len= strlen($sample);

    $ini_window = array();
    $ext_window = array();

    $helix = array();
    $beta = array();
    $t = array();
    $i = 0;
    $j = 0;
    $count = 0;
    $pointer = 0;


//HELIX




        while ($sample[$pointer + 5]) {
            $count = 0;
           // echo "Pointer: ".$pointer."<br>";
         //   echo "Firstloop";


            $pointer = $j;
            for ($i = 0; $i < 6; $i++) {

                $ini_window[$i] = $sample[$j];

                $j++;
            }

            for ($i = 0; $i < 6; $i++) {

                $residue = $ini_window[$i];
              //  echo $residue."<br>";
                
                $prop_string= "SELECT * FROM  `data` where amino='$residue'";
                
                $result = mysql_query($prop_string);

                while ($row = mysql_fetch_array($result)) {

                
                $p_alpha = $row["p_alpha"];
                
                }
                $p_alpha= $p_alpha;

                if ($p_alpha >= 100) {
                    $count++;
                }
            }

            if ($count >= 4) {
                for ($i = $pointer; $i < $j; $i++) {
                  //  echo "Check";

                    $helix[$i] = "H";
                }
                $pointer = $j;
                
 while ($sample[$pointer + 3] && $sample[$pointer]) {
             //  echo "Second loop";
            $pointer = $j;
            $count = 0;

            for ($i = 0; $i < 4; $i++) {

                $ext_window[$i] = $sample[$j];

                $j++;
            }


            for ($i = 0; $i < 4; $i++) {

                $residue = $ext_window[$i];

               $prop_string= "SELECT * FROM  `data` where amino='$residue'";
                
                $result = mysql_query($prop_string);

                while ($row = mysql_fetch_array($result)) {

                
                $p_alpha = $row["p_alpha"];
                
                }
                $p_alpha= $p_alpha;


                if ($p_alpha < 100) {
                    $count++;
                }
            }



            if ($count != 4) {

                $helix[$pointer] = "H";
                $pointer++;
                $j = $pointer;
            } else {


                $helix[$pointer] = "-";
                $pointer++;
                $j = $pointer;
                break;
            }
        } 
                
                
                
            }
            
            else {


                $helix[$pointer] = "-";
                $pointer++;
                $j = $pointer;
            }
        }

    

    $end = $helix[$pointer - 1];

    while ($sample[$pointer]) {
        $helix[$pointer] = $end;

        $pointer++;
    }

    
     
     // Beta
     
     
     $ini_window1 = array();
    $ext_window1 = array();


    $beta = array();
    $t = array();
    $i = 0;
    $j = 0;
    $count = 0;
    $pointer = 0;
     
     
     while ($sample[$pointer + 4]) {
            $count = 0;
         //   echo "Pointer: ".$pointer."<br>";
         //   echo "Firstloop";


            $pointer = $j;
            for ($i = 0; $i < 5; $i++) {

                $ini_window1[$i] = $sample[$j];

                $j++;
            }

            for ($i = 0; $i < 5; $i++) {

                $residue = $ini_window1[$i];
              //  echo $residue."<br>";
                
                $prop_string= "SELECT * FROM  `data` where amino='$residue'";
                
                $result = mysql_query($prop_string);

                while ($row = mysql_fetch_array($result)) {

                
                $p_beta = $row["p_beta"];
                
                }
                $p_beta= $p_beta;

                if ($p_beta >= 105) {
                    $count++;
                   // echo $count;
                }
            }

            if ($count >= 3) {
                for ($i = $pointer; $i < $j; $i++) {
                  //  echo "Check";

                    $beta[$i] = "E";
                }
                $pointer = $j;
                
 while ($sample[$pointer + 3] && $sample[$pointer]) {
              // echo "Second loop";
            $pointer = $j;
            $count = 0;

            for ($i = 0; $i < 4; $i++) {

                $ext_window1[$i] = $sample[$j];

                $j++;
            }

 
            $sum = 0;
            for ($i = 0; $i < 4; $i++) {

                $residue = $ext_window1[$i];

               $prop_string= "SELECT * FROM  `data` where amino='$residue'";
                
                $result = mysql_query($prop_string);

                while ($row = mysql_fetch_array($result)) {

                
                $p_beta = $row["p_beta"];
                
                }
                
                $p_beta= $p_beta;

                $sum = $sum + $p_beta;
           
                }
            $sum = $sum / 4;
          //  echo $sum."<br>";

            if ($sum >= 95) {

                $beta[$pointer] = "E";
                $pointer++;
                $j = $pointer;
            } else {


                $beta[$pointer] = "-";
                $pointer++;
                $j = $pointer;
                break;
            }
        } 
                
                
                
            }
            
            else {


                $beta[$pointer] = "-";
                $pointer++;
                $j = $pointer;
            }
        }

    

    $end = $beta[$pointer - 1];

    while ($sample[$pointer]) {
        $beta[$pointer] = $end;

        $pointer++;
    }
    
    
    
    //Turn
    
    
    
    
    
       
    $turn = array();
    $i = 0;
    $j = 0;
    $count=0;
    
    
    
    
      for ($i = 0; $i < $len; $i++) {
          $count=0;

                $residue = $sample[$i];

                $prop_string= "SELECT * FROM  `data` where amino='$residue'";
                
                $result = mysql_query($prop_string);

                while ($row = mysql_fetch_array($result)) {

                $p_alpha=$row["p_alpha"];
                $p_beta=$row["p_beta"];
                $p_turn=$row["p_turn"];
                $fi0 = $row["fi0"];
                $fi1 = $row["fi1"];
                $fi2 = $row["fi2"];
                $fi3 = $row["fi3"];
                
                }
               
                
                $product= $fi0*$fi1*$fi2*$fi3;
                $p_turn_1= $p_turn/100;
                
            
                if ($product > 0.000075)
                    $count++;
                //if($p_turn_1>1)
                  //  $count++;
                if($p_turn>$p_alpha && $p_turn>$p_beta)
                    $count++;
                
                
                if($count==2)
                   {
                    $turn[$i]="T";
                }
                else
                    {
                    $turn[$i]="-";
                    }
                      
                            
                       
                    
                        }
                
                
            
    
    
    
    
    
    
    
    //Output

     ?>
        <style>
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
     <table>
         <tr>
           <?php
          echo "<td><b>SAMPLE</b></td>";    
            $i=0;
     while($sample[$i]){
         
        echo "<td>".$sample[$i]."</td>";
        $i++;
         
     }
           
           ?>
         </tr>    
         
         
          <tr>
           <?php
        echo "<td><b>HELIX</b></td>";      
            $i=0;
     while($helix[$i]){
         
        echo "<td>".$helix[$i]."</td>";
        $i++;
         
     }
           
           ?>
         </tr> 
          <tr>
           <?php
        echo "<td><b>BETA</b></td>";      
            $i=0;
     while($beta[$i]){
         
        echo "<td>".$beta[$i]."</td>";
        $i++;
         
     }
           
           ?>
         </tr> 
         
          <tr>
           <?php
        echo "<td><b>TURN</b></td>";      
            $i=0;
     while($turn[$i]){
         
        echo "<td>".$turn[$i]."</td>";
        $i++;
         
     }
           
           ?>
         </tr> 
         
     </table>

   
     
     <?php
     
     $combined;
     
     for($i=0;$i<$len;$i++)
     {
         $combined=$combined.$helix[$i];
         
     }
      for($i=0;$i<$len;$i++)
     {
         $combined=$combined.$beta[$i];
         
     }
      for($i=0;$i<$len;$i++)
     {
         $combined=$combined.$turn[$i];
         
     }
     
     
     ?>
        <p id="demo">Click the button to get the combined output.</p>
        <form>
            <input type="hidden" id="combined" name="combined" value="<?php echo $combined ?>">
            <input type="button" name="Get Combined" value="Get Combined" onclick=combine()>
            
            </form>

        <script>
            
            
           function combine(){
            var combined= document.getElementById("combined").value;
            
           
            document.getElementById("demo").innerHTML= combined;
            
            }
            </script>
        
        <?php
    
}
?>
