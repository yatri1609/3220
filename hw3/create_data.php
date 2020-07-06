<html>

        <head>
                <title>Reading a file using PHP</title>
        </head>
                <link rel ="stylesheet" type="text/css" href="styling.css">
        <body>
        
                <?PHP

                        // Reading the files with appropriate deliminators      
                        $l_name = file("last_names.txt");

                        $f_name = file_get_contents("first_names.csv");
                        $firstname = explode(",", $f_name);

                        $sname = file_get_contents("street_names.txt");
                        $street_n = explode(":", $sname);

                        $stype = file_get_contents("street_types.txt");
                        $street_t = explode(";", $stype);

                        $domain = file_get_contents("domains.txt");
                        $array = preg_split('/(?<=.[a-z]{3}\b)./', $domain);
                        $domain_array = [];
                        for($j = 0; $j < 15 ; $j+=2){
                                $dom = $array[$j] . "." . $array[$j+1];
                                array_push($domain_array, $dom);
                        }
                        
                ?>
                <!--- column for first name --->
                <div class = "pre">
                        <div class = "column">
                                <?php 
                                        echo "<h3> First Name: </h3>";
                                        echo "<pre>".print_r($firstname)."</pre>"; 
                                ?>
                        </div>
                        <div class = "column">
                                        <!--- column for last name --->
                                <?php 
                                        echo "<h3> Last Name: </h3>";
                                        echo "<pre>".print_r($l_name)."</pre>";
                                ?>
                        </div>
                        <div class = "column">
                                        <!--- column for Street name --->
                                <?php 
                                        echo "<h3> Street Name: </h3>";
                                        echo "<pre>".print_r($street_n)."</pre>";                         
                                ?>
                        </div>
                                
                        <div class = "column">
                                        <!--- column for Street Type --->
                                <?php 
                                        echo "<h3> Street Type: </h3>";
                                        echo "<pre>".print_r($street_t)."</pre>"; 
                                ?>
                        </div>
                </div>
                
                <div class = "table_column">
                <table align="center">
                        <tr>
                                <td> First name: </td>
                                <td> Last name: </td>
                                <td> Address: </td>
                                <td> Email: </td>
                        </tr>
                
                        <?php 
                        error_reporting(E_ERROR | E_WARNING | E_PARSE);
                        // errors are annoying and tacky. Line 98 was used from Post Affiliate Pro
                        // https://support.qualityunit.com/471229-How-to-turn-off-PHP-notices#:~:text=To%20turn%20this%20off%2C%20you,(E_ERROR%20%7C%20E_WARNING%20%7C%20E_PARSE)%3B
                        $fileArray = array();
                        
                                for($i = 0; $i < 25; $i++)
                                {

                                        $last_name = $l_name[array_rand($l_name)];
                                        $first_name = $firstname[array_rand($firstname)];
                                        $street_name = $street_n[array_rand($street_n)];
                                        $street_type = $street_t[array_rand($street_t)];
                                        $email = $last_name.".".$first_name;
                                        $full_domain = $email."@".$domain_array[array_rand($domain_array)];

                                        echo "<td> $first_name </td>";
                                        echo "<td> $last_name </td>";
                                        $randomNumber = rand(0,300);
                                        $theAddress = $randomNumber." ".$street_name." ".$street_type;
                                        echo "<td> $theAddress </td>";
                                        echo "<td> $full_domain <td>";
                                        echo "<tr></tr>";

                                        $data = $first_name.":".$last_name.":".$theAddress.":".$full_domain. "\n";
                                        $string = str_replace(array("\n","\r",PHP_EOL), '', $data);
                                        $fp = fopen('customer.txt', 'a');
                                        fwrite($fp, $string);
                                        fwrite($fp,"\n");
                                }


                        fclose($fp);
                        
                        ?>
                
                
                </table>
        
                </div>

        </body>
</html>
