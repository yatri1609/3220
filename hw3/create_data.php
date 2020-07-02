<html>

   <head>
      <title>Reading a file using PHP</title>
   </head>
   
   <body>
      
   <?PHP

        // Reading the files with appropriate deliminators

        $l_name = file("last_names.txt");
        $last_name = $l_name[array_rand($l_name)];

        $f_name = file_get_contents("first_names.csv");
        $firstname = explode(",", $f_name);
        $first_name = $firstname[array_rand($firstname)];

        $sname = file_get_contents("street_names.txt");
        $street_n = explode(":", $sname);
        $street_name = $street_n[array_rand($street_n)];

        $stype = file_get_contents("street_types.txt");
        $street_t = explode(";", $stype);
        $street_type = $street_t[array_rand($street_t)];
        

        $email = $last_name . "." . $first_name;
        $domain = file_get_contents("domains.txt");
        $array = preg_split('/(?<=.[a-z]{3}\b)./', $domain);
        $domain_array = [];
        for($j = 0; $j < 15 ; $j+=2){
                $dom = $array[$j] . "." . $array[$j+1];
                array_push($domain_array, $dom);
        }
        
        $full_domain = $email . "@" . $domain_array[array_rand($domain_array)];
        echo $full_domain;

    ?>
      
   </body>
</html>