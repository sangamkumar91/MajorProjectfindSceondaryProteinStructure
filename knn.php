<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>KNN</title>
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

<h1> Kth Nearest Neighbor Algorithm </h1>
        <form action="knn.php" method="get">
            <input type="text" name="sample" placeholder="Enter Sample">
			 <input type="text" name="id" placeholder="Enter Sample">

                <input type="submit" value="submit" name="submit">

                    </form>

                    

                    <?php
error_reporting(0);
if ($_GET["submit"]) {
    $sample = $_GET["sample"];
	$id= $_GET["id"];

    mysql_connect('localhost', 'root', '');
    mysql_select_db('major');

    $length;
    $db_length;
    $remainder;
    $db_remainder;
    $che2 = "";
    $che3 = "";
    $che4 = "";

    $second_res = array("H", "B", "C", "-");

    $level2 = array();
    $level2_count = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $level3 = array();
    $level3_count = array();

    $level4 = array();
    $level4_count = array();


    $x2 = 0;
    $x3 = 0;
    $x4 = 0;

    for ($i = 0; $i < 4; $i++) {

        for ($j = 0; $j < 4; $j++) {

            $level2[$x2] = $second_res[$i] . $second_res[$j];
            $x2++;


            for ($k = 0; $k < 4; $k++) {

                $level3[$x3] = $second_res[$i] . $second_res[$j] . $second_res[$k];
                $x3++;


                for ($l = 0; $l < 4; $l++) {

                    $level4[$x4] = $second_res[$i] . $second_res[$j] . $second_res[$k] . $second_res[$l];
                    $x4++;
                }
            }
        }
    }


  // print_r($level2) ;
   // echo "<br>";
  //print_r($level3) ;
   // echo "<br>";
  // print_r($level4) ;
    //echo "<br>";
    
    
    // $LEVEL2                     



    $pointer = 0;
    $length = strlen($sample);
    $remainder = $length % 2;
    $length = $length - $remainder;
    $div2;

    for ($pointer = 0; $pointer < $length; $pointer = $pointer + 2) {
         $level2_count = array();

        $div2 = $sample[$pointer] . $sample[$pointer + 1];


        $query = "select * from protein_aplusb_combined";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {

            $db_sample = $row['residue'];
            $db_che = $row['che'];
            $db_length = strlen($db_sample);
            $db_remainder = $db_length % 2;
            $db_length = $db_length - $db_remainder;


            $i = 0;
            while ($i < $db_length) {

                $db_sample_div2 = $db_sample[$i] . $db_sample[$i + 1];
                $db_che_div2 = $db_che[$i] . $db_che[$i + 1];

                if ($div2 == $db_sample_div2)
                    for ($j = 0; $level2[$j] == true; $j++) {

                        if ($level2[$j] == $db_che_div2)
                            $level2_count[$j]++;
                    }



                $i = $i + 2;
            }
        }

       // print_r($level2_count);
       //   echo "<br>";
        
        $max_count = $level2_count[0];
        $max = 0;
        for ($m = 1; $m<16; $m++) {

            if ($max_count < $level2_count[$m]) {
                $max_count = $level2_count[$m];
                $max = $m;
               // echo $level2[$max];
            }
        }
        

        $che2 = $che2 . $level2[$max];
    }

    while ($remainder != 0) {
        $che2 = $che2 . "X";
        $remainder--;
        
    }
    
    echo "<b>LEVEL2 >>> WITH HYPHEN </b> "."<br>"."<br>".$che2."<br>"."<br>";
    
    if($che2[0]== "-")
        $che2[0]="H";
    
    for($v=0; $che2[$v];$v++)
    if($che2[$v]== "-" || $che2[$v]== "X")
        $che2[$v]=$che2[$v-1]; 

    echo "<b>LEVEL2 >>> WITHOUT HYPHEN  </b> "."<br>"."<br>".$che2."<br>"."<br>";








    // LEVEL3       
    

    $pointer = 0;
    $length = strlen($sample);
    $remainder = $length % 3;
    $length = $length - $remainder;
    $div3;

    for ($pointer = 0; $pointer < $length; $pointer = $pointer + 3) {

        $level3_count = array();
        $div3 = $sample[$pointer] . $sample[$pointer + 1] . $sample[$pointer + 2];


        $query = "select * from protein_aplusb_combined";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {

            $db_sample = $row['residue'];
            $db_che = $row['che'];
            $db_length = strlen($db_sample);
            $db_remainder = $db_length % 3;
            $db_length = $db_length - $db_remainder;


            $i = 0;
            while ($i < $db_length) {

                $db_sample_div3 = $db_sample[$i] . $db_sample[$i + 1] . $db_sample[$i + 2];
                $db_che_div3 = $db_che[$i] . $db_che[$i + 1] . $db_che[$i + 2];

                if ($div3 == $db_sample_div3)
                    for ($j = 0; $level3[$j] == true; $j++) {

                        if ($level3[$j] == $db_che_div3)
                            $level3_count[$j]++;
                    }



                $i = $i + 3;
            }
        }

        $max_count = $level3_count[0];
        $max = 0;
        for ($m = 1; $m < 64; $m++) {

            if ($max_count < $level3_count[$m]) {
                $max_count = $level3_count[$m];
                $max = $m;
            }
        }

        $che3 = $che3 . $level3[$max];
    }

    while ($remainder != 0) {
        $che3 = $che3 . "X";
        $remainder--;
    }
    
    
    echo "<b>LEVEL3 >>> WITH HYPHEN  </b> "."<br>"."<br>".$che3."<br>"."<br>";

        if($che3[0]== "-")
        $che3[0]="H";
        
       for($v=0; $che3[$v];$v++)
    if($che3[$v]== "-" || $che3[$v]== "X")
        $che3[$v]=$che3[$v-1]; 
 
    echo "<b>LEVEL3 >>>  WITHOUT HYPHEN </b> "."<br>"."<br>".$che3."<br>"."<br>";
    
    
    
    
    // LEVEL4
  
    $pointer = 0;
    $length = strlen($sample);
    $remainder = $length % 4;
    $length = $length - $remainder;
    $div4;

    for ($pointer = 0; $pointer < $length; $pointer = $pointer + 4) {

        $level4_count = array();
        $div4 = $sample[$pointer] . $sample[$pointer + 1] . $sample[$pointer + 2]. $sample[$pointer + 3];


        $query = "select * from protein_aplusb_combined";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {

            $db_sample = $row['residue'];
            $db_che = $row['che'];
			$db_id= $row['id'];
            $db_length = strlen($db_sample);
            $db_remainder = $db_length % 4;
            $db_length = $db_length - $db_remainder;


             if($db_id!= $id)
			  {
					$i = 0;
					while ($i < $db_length) {
		   
					  
						$db_sample_div4 = $db_sample[$i] . $db_sample[$i + 1] . $db_sample[$i + 2]. $db_sample[$i + 3];
						$db_che_div4 = $db_che[$i] . $db_che[$i + 1] . $db_che[$i + 2]. $db_che[$i + 3];
		
						if ($div4 == $db_sample_div4)
							for ($j = 0; $level4[$j] == true; $j++) {
		
								if ($level4[$j] == $db_che_div4)
									$level4_count[$j]++;
							}
		
		
					   
						$i = $i + 4;
					}
			  }
        }

        $max_count = $level4_count[0];
        $max = 0;
        for ($m = 1; $m < 256; $m++) {

            if ($max_count < $level4_count[$m])
			 {
                $max_count = $level4_count[$m];
                $max = $m;
            }
        }
		if($max_count==0)
		$che4 = $che4 . $level4[255];
        else
        $che4 = $che4 . $level4[$max];
    }

    while ($remainder != 0) {
        $che4 = $che4 . "X";
        $remainder--;
    }
    
  
    echo "<b>LEVEL4 >>> WITH HYPHEN  </b> "."<br>"."<br>".$che4."<br>"."<br>";
    
        if($che4[0]== "-")
        $che4[0]="H";
    
       for($v=0; $che4[$v];$v++)
    if($che4[$v]== "-" || $che4[$v]== "X")
        $che4[$v]=$che4[$v-1]; 
 
    
    echo "<b>LEVEL4 >>> WITHOUT HYPHEN  </b> "."<br>"."<br>".$che4."<br>"."<br>";
    
    
    
    
    
    
    
    
    
}
?>

</body>
                    </html>