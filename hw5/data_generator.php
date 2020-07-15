<html>
<head>
	<title>Data Generator</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>

<body>
        <?php
                // Code from example 
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

                $customer_columns = array("customer_id", "first_name", "last_name", "email", "phone", "address_id");
                $order_column = array("order_id", "customer_id", "address_id");
                $product_column = array("product_id","product_name", "description", "weight", "base_cost");
                $order_item_column = array("order_id", "product_id", "quantity", "price");
                $address_column = array("address_id", "street", "city", "state", "zip");
                $warehouse_column = array("warehouse_id", "name", "address_id");
                $product_warehouse_column = array("product_id", "warehouse_id");
                const cust_row = 100;
                const order_row = 350;
                const product_row = 750;
                const order_item_row = 550;
                const address_row = 150;
                const warehouse_row = 25;
                const product_warehouse = 1250;

                print("<h1>Generating SQL script</h1>");
        
                print("...");
                
                $firstNames = get_array_data("first_names.txt");
                $lastNames = get_array_data("last_names.txt"); 
                $street_name = get_array_data("street_names.txt");
                $street_type = get_array_data("street_types.txt");
                $city = get_array_data("cities.txt");
                $product = get_array_data("products.txt");
                $states = get_array_data("states.txt");
                $domain = get_array_data("domains.txt");
                $address = rand(0,300)." ".$street_name." ".$street_type.",".$city.",".$states; 
                $email = $lastNames . $firstNames . $domain;

                
        ?>
</body>
</html>
