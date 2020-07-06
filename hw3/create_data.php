<html>

   <head>
      <title>Reading a file using PHP</title>
   </head>
   <link rel ="stylesheet" type="text/css" href="styling.css">
   <body>
      
   <?PHP

        // Reading the files with appropriate deliminators
       // $l_name is the array 
        $l_name = file("last_names.txt");
        $last_name = $l_name[array_rand($l_name)];
       //echo count($l_name);

        $f_name = file_get_contents("first_names.csv");
       // firstname is the array
        $firstname = explode(",", $f_name);
       
        $first_name = $firstname[array_rand($firstname)];
       echo " hello: ".count($firstname). "<br>";
       $number = count($firstname); // number = 25

       // street_n is the array
        $sname = file_get_contents("street_names.txt");
        $street_n = explode(":", $sname);
        $street_name = $street_n[array_rand($street_n)];
       echo "street names: ".count($street_n);

        $stype = file_get_contents("street_types.txt");
        $street_t = explode(";", $stype);
        $street_type = $street_t[array_rand($street_t)];
        echo "street type number:". count($street_t);

        $email = $last_name.".".$first_name;
        $domain = file_get_contents("domains.txt");
        $array = preg_split('/(?<=.[a-z]{3}\b)./', $domain);
        $domain_array = [];
        for($j = 0; $j < 15 ; $j+=2){
                $dom = $array[$j] . "." . $array[$j+1];
                array_push($domain_array, $dom);
        }
        
        $full_domain = $email."@".$domain_array[array_rand($domain_array)];
        echo $full_domain;

    ?>
     <!--- column for first name --->
     <div class = "column">
     <?php 
   echo "<h3> first name: </h3>";
       for($i = 0; $i < $number; $i++)
       {
           //echo " $i:$firstname[$i] <br>";
          echo "<pre>".print_r($firstname[$i])."</pre>"; 
       }
       
       ?>
       </div>
       <div class = "column">
        <!--- column for last name --->
     <?php 
   echo "<h3> last name: </h3>";
       for($i = 0; $i < count($l_name); $i++)
       {
           //echo " $i:$firstname[$i] <br>";
          echo "<pre>".print_r($l_name[$i])."</pre>"; 
       }
       
       ?>
       </div>
       <div class = "column">
        <!--- column for Street name --->
     <?php 
   echo "<h3> Street name: </h3>";
       for($i = 0; $i < count($street_n); $i++)
       {
           //echo " $i:$firstname[$i] <br>";
          echo "<pre>".print_r($street_n[$i])."</pre>"; 
       }
       
       ?>
       </div>
       
          <div class = "column">
        <!--- column for Street Type --->
     <?php 
   echo "<h3> Street Type: </h3>";
       for($i = 0; $i < count($street_t); $i++)
       {
           //echo " $i:$firstname[$i] <br>";
          echo "<pre>".print_r($street_t[$i])."</pre>"; 
       }
       
       ?>
       </div>
       <div>
       <table>
          <tr>
           <th> First name: </th>
           <th> Last name: </th>
           <th> Address: </th>
           <th> Email: </th>
           </tr>
           
           <?php 
            
                for($i = 0; $i < 25; $i++)
                {
                    $TheFirstName = $firstname[rand(0, count($firstname))];
                    echo "<td> $TheFirstName </td>";
                    $TheLastName = $l_name[rand(0, count($l_name))];
                    echo "<td> $TheLastName </td>";
                    $theAddress = rand(0,300)." ".$street_n[rand(0,count($street_n))]." ".$street_t[rand(0,count($street_t))];
                   /* echo "<td>".rand(0,300)." ".$street_n[rand(0,count($street_n))]." ".$street_t[rand(0,count($street_t))]."</td>"; */
                    echo "<td> $theAddress </td>";
                    $theEmailAddress = $TheFirstName.'.'.$TheLastName.'@'.$domain_array[rand(0,count($domain_array))];
                    echo "<td> $theEmailAddress <td>";
                    echo "<tr> </tr>";
                    $myfile = fopen("./customer.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, "$TheFirstName:$TheLastName:$theAddress:$theEmailAddress");
                    fclose($myfile);
                  /*  fwrite($myfile, $TheLastName);
                    fwrite($myfile, $theAddress);
                    fwrite($myfile, $theEmailAddress);
                    */
                    // file time 
                  // $myfile = "./customer.txt";
                    //$file = fopen($myfile, "w");
                    //fwrite($myfile, $TheFirstName);
                  
                    
                }
           
           ?>
              
               
       </table>
       
       </div>

   </body>
</html>