<!-- Header -->
<?php include "header.php"?>

<?php
$target_dir = "uploads/";

if (isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["input_file"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;

    # Allow only csv files
    if($fileType != "csv") {
        $warn = "Sorry, only CSV files are allowed";
        alert("error", $warn);
        $uploadOk = 0;
    }

    # Upload file
    if ($uploadOk == 0) {
        $warn = "Sorry, your file was not uploaded";
        alert("error", $warn);
    } else {
        if (move_uploaded_file($_FILES["input_file"]["tmp_name"], $target_file)) {
            $fileExists = 0;
            if (file_exists($target_file)) {
               $fileExists = 1;
            }

            # read file
            if ($fileExists == 1) {
                $file = fopen($target_file, "r");

                $log_dir = "logs/";
                $logname = $log_dir . "log.txt";
                $log = fopen($logname, "w");

                $i = 0;
                $s = 0;
                $f = 0;

                $count = 0;

                while (($row = fgetcsv($file, 10000, ",")) !== false) {
                    $name = $row[0];
                    $asset_num = $row[1];
                    $serial_num = $row[2];
                    $dev_type = $row[3];
                    $make = $row[4];
                    $model = $row[5];
                    $service_tag = $row[6];
                    $assign_date = date("Y-m-d", strtotime($row[7]));
                    $update_date = date("Y-m-d", strtotime($row[8]));

                    $query = "SELECT aID FROM assignees WHERE name LIKE '%$name%' ORDER BY aID ASC LIMIT 1";
                    $table_result = mysqli_query($conn, $query);

                    # Get the aID for assignee category
                    if (mysqli_num_rows($table_result) != 0) {
                        $a_array = mysqli_fetch_assoc($table_result);
                        $assignee = $a_array['aID'];
                    } else {
                        $a_query = "INSERT INTO assignees(name) VALUES('{$name}')";
                        $a_insert = mysqli_query($conn, $a_query);

                        if ($a_insert <= 0) {
                            $log_data = "Error: could not insert assignee '$name' into table from input line '$i'".PHP_EOL;
                            fwrite($log, $log_data);
                            $f = $f + 1;
                            $i = $i + 1;
                            continue;
                        } else {
                            $log_data = "Alert: inserted assignee '$name' into table from input line '$i'".PHP_EOL;
                            fwrite($log, $log_data);

                            $get_new_aID = mysqli_query($conn, $query);
                            $a_array = mysqli_fetch_assoc($get_new_aID);
                            $assignee = $a_array['aID'];
                        }
                    }

                    # Insert device into table
                    if ($serial_num == '' && $service_tag != '') {
                        $intoD = "INSERT INTO devices (assignee, asset_num, dev_type, make, model, service_tag, assign_date, update_date) VALUES ('$assignee', '$asset_num', '$dev_type', '$make', '$model', '$service_tag', '$assign_date', '$update_date');";
                    } else if ($serial_num != '' && $service_tag == '') {
                        $intoD = "INSERT INTO devices (assignee, asset_num, serial_num, dev_type, make, model, assign_date, update_date) VALUES ('$assignee', '$asset_num', '$serial_num', '$dev_type', '$make', '$model', '$assign_date', '$update_date');";
                    } else if ($service_tag == '' && $serial_num == '') {
                        $intoD = "INSERT INTO devices (assignee, asset_num, dev_type, make, model, assign_date, update_date) VALUES ('$assignee', '$asset_num', '$dev_type', '$make', '$model', '$assign_date', '$update_date');";
                    } else {
                        $intoD = "INSERT INTO devices (assignee, asset_num, serial_num, dev_type, make, model, service_tag, assign_date, update_date) VALUES ('$assignee', '$asset_num', '$serial_num', '$dev_type', '$make', '$model', '$service_tag', '$assign_date', '$update_date');";
                    }
                    $add_entry = mysqli_query($conn, $intoD);

                    if ($add_entry <= 0) {
                        $log_data = "Error: could not insert device 'asset_num($asset_num)' into table from input line '$i'".PHP_EOL."  reason(".mysqli_error($conn).")".PHP_EOL;
                        fwrite($log, $log_data);
                        $f = $f + 1;
                        $i = $i + 1;
                        continue;
                    } else {
                        $log_data = "Alert: inserted device 'asset_num($asset_num)' into table from input line '$i'".PHP_EOL;
                        fwrite($log, $log_data);
                        $s = $s + 1;
                        $i = $i + 1;
                    }
                }
            }
            unlink($target_file);

            $msg = "Successfully imported data!<br>Please return to the devices page and ensure your data is correct.";
            alert("good", $msg);
        } else {
            $warn = "Sorry, there was an error uploading your file.";
            alert("error", $warn);
        }
    }
}
?>

<!-- BACK button to go to the devices page -->
<div class="container text-center">
    <a href="includes/devices/home.php" class="btn btn-primary m-3"> Devices Page </a>
<div>

<!-- Footer -->
<?php include "footer.php" ?>
