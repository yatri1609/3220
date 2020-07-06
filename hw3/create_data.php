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
       //echo " hello: ".count($firstname). "<br>";
       $number = count($firstname); // number = 25

       // street_n is the array
        $sname = file_get_contents("street_names.txt");
        $street_n = explode(":", $sname);
        $street_name = $street_n[array_rand($street_n)];
     //  echo "street names: ".count($street_n);

        $stype = file_get_contents("street_types.txt");
        $street_t = explode(";", $stype);
        $street_type = $street_t[array_rand($street_t)];
      //  echo "street type number:". count($street_t);

        $email = $last_name.".".$first_name;
        $domain = file_get_contents("domains.txt");
        $array = preg_split('/(?<=.[a-z]{3}\b)./', $domain);
        $domain_array = [];
        for($j = 0; $j < 15 ; $j+=2){
                $dom = $array[$j] . "." . $array[$j+1];
                array_push($domain_array, $dom);
        }
        
        $full_domain = $email."@".$domain_array[array_rand($domain_array)];
        //echo $full_domain;

    ?>
     <!--- column for first name --->
     <div class = "column">
     <?php 
   echo "<h3> first name: </h3>";
       
          echo "<pre>".print_r($firstname)."</pre>"; 
       
       ?>
       </div>
       <div class = "column">
        <!--- column for last name --->
     <?php 
   echo "<h3> last name: </h3>";
       
           echo "<pre>".print_r($l_name)."</pre>";
       
       ?>
       </div>
       <div class = "column">
        <!--- column for Street name --->
     <?php 
   echo "<h3> Street name: </h3>";
       
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
       <div>
       <table>
          <tr>
           <th> First name: </th>
           <th> Last name: </th>
           <th> Address: </th>
           <th> Email: </th>
           </tr>
           
           <?php 
           error_reporting(E_ERROR | E_WARNING | E_PARSE);
           // errors are annoying and tacky. Line 98 was used from Post Affiliate Pro
           // https://support.qualityunit.com/471229-How-to-turn-off-PHP-notices#:~:text=To%20turn%20this%20off%2C%20you,(E_ERROR%20%7C%20E_WARNING%20%7C%20E_PARSE)%3B
           $fileArray = array();
            
                for($i = 0; $i < 25; $i++)
                {
                    $FNMax = count($firstname);
                    $TheFirstName = $firstname[rand(0, $FNMax)];
                    echo "<td> $TheFirstName </td>";
                    $LNMax = count($l_name);
                    $TheLastName = $l_name[rand(0, $LNMax)];
                    echo "<td> $TheLastName </td>";
                    $randomNumber = rand(0,300);
                    $SNMax = count($street_n);
                    $SNNumber = rand(0, $SNMax);
                    $STMax = count($street_t);
                    $STNumber = rand(0, $STMax);
                    $theAddress = $randomNumber." ".$street_n[$SNNumber]." ".$street_t[$STNumber];
                   /* echo "<td>".rand(0,300)." ".$street_n[rand(0,count($street_n))]." ".$street_t[rand(0,count($street_t))]."</td>"; */
                    echo "<td> $theAddress </td>";
                    $theEmailAddress = $TheFirstName.'.'.$TheLastName.'@'.$domain_array[rand(0,count($domain_array))];
                    echo "<td> $theEmailAddress <td>";
                    echo "<tr> </tr>";
                    
                  
                    
                   // echo "<h1> $fileArray[0] </h1>";
          $myfile = fopen("./customer.txt", "w") or die("Unable to open file!");
                   //  file_put_contents($myfile, $fileArray);
            $data = $TheFirstName.":".$TheLastName.":".$theAddress.":".$theEmailAddress;
           // array_push($fileArray, $TheFirstName,$TheLastName,$theAddress,$theEmailAddress);
             array_push($fileArray, $data);
          
                  
                    
                }
           
         $string = str_replace(array("\n","\r\n","\r"), '', $fileArray);
          
         file_put_contents("./customer.txt", $string);
           ?>
              
               
       </table>
       
       </div>

   </body>
</html>
