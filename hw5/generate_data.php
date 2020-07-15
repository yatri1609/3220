<html>
<head>
	<title>Data Generator</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>

<body>

	<?php
        //To make a function in PHP use the "function" keyword, function name, paramter list
        function get_array_data($fileName) {
            $handle = fopen($fileName,"r");
            while (!feof($handle)) {
                $value = fgets($handle); //read a value (one line)
                $value = str_replace(array("\n", "\r"), '', $value);  //remove newlines
                if(!feof($handle)) {
                    $values[] = $value;		
                }
            }
            fclose($handle);
            return $values;
        }
        
        function write_table($handle, $database, $table, $columns, $values) {
            fwrite($handle, "use $database;\n\n");
            fwrite($handle, "SET AUTOCOMMIT=0;\n\n");
            //from DBeaver
            //INSERT INTO moviestore4.actor (first_name,last_name) VALUES ('Fred','Schwab');
            fwrite($handle, "INSERT INTO $database.$table (");
            for($i = 0; $i < sizeof($columns); $i++) {
                fwrite($handle, $columns[$i]);
                if($i!= sizeof($columns)-1) { // if not the last value, print comma
                    fwrite($handle, ",");
                }
            }
            fwrite($handle, ") VALUES\n");
            
            for($i = 0; $i < sizeof($values); $i++) {
                fwrite($handle, "(");
                for($j = 0; $j < sizeof($values[$i]); $j++) {
                    fwrite($handle, $values[$i][$j]);
                    if($j != sizeof($values[$i]) - 1) { //if not at last value, print comma
                       fwrite($handle, ","); 
                    }
                }
                if($i != sizeof($values)-1) { //not at last one
                    fwrite($handle, "),\n");
                } else {
                    fwrite($handle, ");\n\nCOMMIT;");
                }

            }
        }
        
        //create an array of your table column names for inserting.
        $actor_columns = array("first_name", "last_name");
        //create constant for the number of rows you will generate for each table
        const NUM_ACTORS = 100;
    
    
    
        print("<h1>Generating SQL script</h1>");
        
        print("...");
        
        $firstNames = get_array_data("first_names.txt");
        $lastNames = get_array_data("last_names.txt"); 
        
        for($i = 0; $i < NUM_ACTORS; $i++) {
            $actors[$i][0] = "'".$firstNames[rand(0, sizeof($firstNames)-1)]."'"; 
            $actors[$i][1] = "'".$lastNames[rand(0, sizeof($lastNames)-1)]."'"; 
        }
        /*
        print("<pre>");
        print_r($actors);
        print("</pre>");
        */
        
        $handle = fopen("data.sql", "w");
        //write the data
        write_table($handle, "moviestore4", "actor", $actor_columns, $actors);
        
        fclose($handle);
          
        print("<h1>SQL script complete!</h1>");
        
	?>
</body>
</html>