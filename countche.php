<?php
error_reporting(0);
$char1 = array('E', 'M', 'A', 'L', 'K', 'F', 'Q', 'W', 'I', 'V', 'D', 'H', 'R', 'T', 'S', 'C', 'Y', 'N', 'P', 'G');

$char2 = array('H', 'B', 'C');

$counter_helix = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$counter_beta = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$counter_coil = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$p_helix = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$p_beta = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$p_coil = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$counter_residue = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
$total_helix = 0;
$total_beta = 0;
$total_coil = 0;
$total_residue = 0;

mysql_connect('localhost', 'root', '');
mysql_select_db('major');

$query = "select * from protein";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {

    $sample = $row['residue'];
    $che = $row['che'];
    $sample_id = $row['id'];

    $length = strlen($sample);
    $length1 = strlen($che);
    if ($length != $length1) {
        echo "ID=" . $row['id'] . " <br>  Sr.No=" . $row['sr'] . "Length Incorrect";
        ?>

        <script>

            alert("Enter Same length")

        </script>

        <?php

    } else {

        $enter_length = "UPDATE  `major`.`protein` SET  `length` =  '$length' WHERE  `protein`.`id` ='$sample_id'";
        mysql_query($enter_length);

        for ($temp1 = 0; $temp1 < 3; $temp1++)
            for ($temp = 0; $temp < 20; $temp++)
                for ($temp2 = 0; $temp2 < $length; $temp2++) {
                    if ($sample[$temp2] == $char1[$temp]){


                        $counter_residue[$temp]++;

                        if ($che[$temp2] == $char2[$temp1]) {
                            if ($temp1 == 0) {
                                $counter_helix[$temp]++;
                                $total_helix++;
                            }
                            if ($temp1 == 1) {
                                $counter_beta[$temp]++;
                                $total_beta++;
                            }
                            if ($temp1 == 2) {
                                $counter_coil[$temp]++;
                                $total_coil++;
                            }
                        }
                    }
                }
    }
}


for ($temp = 0; $temp < 20; $temp++) {

    $counter_residue[$temp] = $counter_residue[$temp] / 3;
}


$enter_c = "UPDATE  `major`.`che` SET  `total` =  '$total_coil' WHERE  `che`.`name` ='c'";
mysql_query($enter_c);

$enter_h = "UPDATE  `major`.`che` SET  `total` =  '$total_helix' WHERE  `che`.`name` ='h'";
mysql_query($enter_h);

$enter_e = "UPDATE  `major`.`che` SET  `total` =  '$total_beta' WHERE  `che`.`name` ='b'";
mysql_query($enter_e);

$sum_query = "SELECT SUM(length) FROM protein";
$result_sum = mysql_query($sum_query);



while ($row_sum = mysql_fetch_array($result_sum)) {

    $total_residue = $row_sum['SUM(length)'];
}

for ($temp = 0; $temp < 20; $temp++) {
    if ($counter_residue[$temp] != 0 && $total_helix != 0) {
        $p_helix[$temp] = (($counter_helix[$temp] / $counter_residue[$temp]) / ($total_helix / $total_residue));
    }


    if ($counter_residue[$temp] != 0 && $total_beta != 0) {
        $p_beta[$temp] = (($counter_beta[$temp] / $counter_residue[$temp]) / ($total_beta / $total_residue));
    }


    if ($counter_residue[$temp] != 0 && $total_coil != 0) {
        $p_coil[$temp] = (($counter_coil[$temp] / $counter_residue[$temp]) / ($total_coil / $total_residue));
    }
}

for ($temp = 0; $temp < 20; $temp++) {

    $final_query = "UPDATE  `major`.`protensity` SET  `alpha_count` =  '$counter_helix[$temp]',
`beta_count` =  '$counter_beta[$temp]',
`coil_count` =  '$counter_coil[$temp]',
`total` =  '$counter_residue[$temp]',
`p_alpha` =  '$p_helix[$temp]',
`p_beta` =  '$p_beta[$temp]',
`p_coil` =  '$p_coil[$temp]' WHERE  `protensity`.`r_name` ='$char1[$temp]'";
    mysql_query($final_query);
}


$display= "SELECT * FROM  `protensity`";

$result_display = mysql_query($display);
?>
        <style>
            
            table, td
{
border: 2px solid black;
padding: 15px;
}
        </style>
        <table   >
            
            <tr  >
                <td><b>Residue_id</b></td>
                <td><b>Residue_name</b></td>
                <td><b>P ALPHA</b></td>
                <td><b>P Beta</b></td>
                <td><b>P Coil</b></td>
            </tr>
   
            <?php


while ($row_display = mysql_fetch_array($result_display)) {

    ?>
        
        
            
            <tr>
                <td><?php echo $row_display['r_id'] ?></td>
                <td><?php echo $row_display['r_name'] ?></td>
                <td><?php echo $row_display['p_alpha'] ?></td>
                <td><?php echo $row_display['p_beta'] ?></td>
                <td><?php echo $row_display['p_coil'] ?></td>
            </tr>
        
        <?php
    
    
}


?>
</table>
