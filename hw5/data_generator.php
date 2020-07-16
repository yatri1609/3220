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

                $customer_columns = array("first_name", "last_name", "email", "phone", "address_id");
                $order_column = array("address_id", "customer_id");
                $product_column = array("product_name", "description", "weight", "base_cost");
                $order_item_column = array("order_id", "product_id", "quantity", "price");
                $address_column = array("street", "city", "states", "zip");
                $warehouse_column = array("name", "address_id");
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
                $warehouse_name = get_array_data("warehouse.txt");
                $product_desc = get_array_data("product_desc.txt");
                $digits = 5;
                $phone_digit =10;


                for($i = 0; $i < address_row; $i++) {
                        $add[$i][0] = "'".$street_name[rand(0, sizeof($street_name)-1)].$street_type[rand(0, sizeof($street_type)-1)]."'"; 
                        $add[$i][1] = "'".$city[rand(0, sizeof($city)-1)]."'";
                        $add[$i][2] = "'".$states[rand(0, sizeof($states)-1)]."'";
                        $add[$i][3] = "'".(rand(pow(10, $digits-1), pow(10, $digits)-1))."'";
                }

                for($i = 0; $i < cust_row; $i++) {
                        $fname = $firstNames[rand(0, sizeof($firstNames)-1)];
                        $lname = $lastNames[rand(0, sizeof($lastNames)-1)];
                        $cust[$i][0] = "'".$fname."'"; 
                        $cust[$i][1] = "'".$lname."'";
                        $cust[$i][2] = "'".$lname.'.'.$fname.$domain[rand(0, sizeof($domain)-1)]."'";
                        $cust[$i][3] = "'".rand(pow(10, $phone_digit-1), pow(10, $phone_digit)-1)."'";
                        $cust[$i][4] = "'".rand(1, address_row)."'";
                }

                for($i = 0; $i < order_row; $i++) {
                        // $ord[$i][0] = "'".rand(1, cust_row)."'";
                        $ord[$i][0] = "'".rand(1, address_row)."'";
                        $ord[$i][1] = "'".rand(1, cust_row)."'";
                }

                for($i = 0; $i < product_row; $i++) {
                        $pro[$i][0] = "'".$product[rand(0, sizeof($product)-1)]."'";
                        $pro[$i][1] = "'".$product_desc[rand(0, sizeof($product_desc)-1)]."'";
                        $pro[$i][2] = "'".rand(0,100)."'";
                        $pro[$i][3] = "'".rand(1,100)."'";
                }

                for($i = 0; $i < warehouse_row; $i++) {
                        $ware[$i][0] = "'".$warehouse_name[rand(0, sizeof($warehouse_name)-1)]."'";
                        $ware[$i][1] = "'".rand(1, address_row)."'";
                }

                for($i = 0; $i < order_item_row; $i++) {
                        $oitem[$i][0] = "'".rand(1, order_row)."'"; 
                        $oitem[$i][1] = "'".rand(1, product_row )."'";
                        $oitem[$i][2] = "'".rand(0,50)."'";
                        $oitem[$i][3] = "'".((rand(1000,100000))/100)."'";
                }

                for($i = 0; $i < product_warehouse; $i++) {
                        $pware[$i][0] = "'".rand(1, product_row )."'"; 
                        $pware[$i][1] = "'".rand(1, warehouse_row)."'";
                }

                $handle = fopen("data.sql", "a");
                //write the data
                write_table($handle, "SuperStore", "address", $address_column, $add);
                write_table($handle, "SuperStore", "customer", $customer_columns, $cust);
                write_table($handle, "SuperStore", "`order`", $order_column, $ord);
                write_table($handle, "SuperStore", "product", $product_column, $pro);
                write_table($handle, "SuperStore", "warehouse", $warehouse_column, $ware);
                write_table($handle, "SuperStore", "order_item", $order_item_column, $oitem);
                write_table($handle, "SuperStore", "product_warehouse", $product_warehouse_column, $pware);

                fclose($handle);
                
                print("<h1>SQL script complete!</h1>");
        ?>
</body>
</html>
