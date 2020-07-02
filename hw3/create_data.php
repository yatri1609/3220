<html>

   <head>
      <title>Reading a file using PHP</title>
   </head>
   
   <body>
      
   <?PHP

        // Reading the files with appropriate deliminators
        
        $lines = file("last_names.txt");
        $f_name = $lines[array_rand($lines)];
        echo $f_name;

        $file = file_get_contents("first_names.csv");
        $last_name = explode(",", $file);
        $l_name = $last_name[array_rand($last_name)];
        echo $l_name;

        $sname = file_get_contents("street_names.txt");
        $street_n = explode(":", $sname);
        echo $street_n[array_rand($street_n)];

        $stype = file_get_contents("street_types.txt");
        $street_t = explode(";", $stype);
        echo $street_t[array_rand($street_t)];

        $email = $l_name . "." . $f_name;
        echo $email;


    ?>
      
   </body>
</html>