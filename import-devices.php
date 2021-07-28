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
                $file = fopen($target_file, "r") or die("Unable to open file!");
                $log_dir = "logs/";
                $timestamp = date("Y-m-d_H-i-s", time());
                $logname = $log_dir . $timestamp . ".log";
                $log = fopen($logname, "w");

                $i = 1;
                $s_d = 0;
                $f_d = 0;
                $s_a = 0;
                $f_a = 0;

                while (($row = fgetcsv($file, 10000, ",")) !== false) {
                    $name = mysqli_real_escape_string($conn, $row[0]);
                    $location = $row[1];
                    $asset_num = $row[2];
                    $serial_num = $row[3];
                    $dev_type = $row[4];
                    $make = $row[5];
                    $model = $row[6];

                    if (isset($row[7])) {
                        $assign_date = date("Y-m-d", strtotime($row[7]));
                    } else {
                        $assign_date = NULL;
                    }
                    if (isset($row[8])) {
                        $update_date = date("Y-m-d", strtotime($row[8]));
                    } else {
                        $update_date = NULL;
                    }

                    $query = "SELECT aID FROM assignees WHERE name LIKE '%$name%' ORDER BY aID ASC LIMIT 1";
                    $table_result = mysqli_query($conn, $query);

                    # Get the aID for assignee category
                    if (mysqli_num_rows($table_result) != 0) {
                        $a_array = mysqli_fetch_assoc($table_result);
                        $assignee = $a_array['aID'];
                    } else {
                        $a_query = "INSERT INTO assignees (name) VALUES('{$name}')";
                        $a_insert = mysqli_query($conn, $a_query);

                        if ($a_insert <= 0) {
                            $log_data = "Error on line '" . $i . "': could not insert assignee '$name' into table".PHP_EOL."  reason(".mysqli_error($conn).")".PHP_EOL;
                            fwrite($log, $log_data);
                            $f_a = $f_a + 1;
                            $i = $i + 1;
                            continue;
                        } else {
                            $log_data = "Alert on line '" . $i . "': inserted assignee '$name' into table".PHP_EOL;
                            fwrite($log, $log_data);

                            $s_a = $s_a + 1;

                            $get_new_aID = mysqli_query($conn, $query);
                            $a_array = mysqli_fetch_assoc($get_new_aID);
                            $assignee = $a_array['aID'];
                        }
                    }

                    $intoD = "INSERT INTO devices (assignee, location, asset_num, serial_num, dev_type, make, model, assign_date, update_date) VALUES ('$assignee', '$location', '$asset_num', '$serial_num', '$dev_type', '$make', '$model', '$assign_date', '$update_date');";

                    $add_entry = mysqli_query($conn, $intoD);

                    if ($add_entry <= 0) {
                        $log_data = "Error on line '" . $i . "': could not insert device 'asset_num($asset_num)' into table".PHP_EOL."  reason(".mysqli_error($conn).")".PHP_EOL;
                        fwrite($log, $log_data);
                        $f_d = $f_d + 1;
                        $i = $i + 1;
                        continue;
                    } else {
                        $log_data = "Alert on line '" . $i . "': inserted device 'asset_num($asset_num)' into table".PHP_EOL;
                        fwrite($log, $log_data);
                        $s_d = $s_d + 1;
                        $i = $i + 1;
                    }
                }
            }
            unlink($target_file);

            $log_data = PHP_EOL . "Succeeded importing assignees: " . $s_a . PHP_EOL . "Failed to import assignees: " . $f_a . PHP_EOL;
            fwrite($log, $log_data);

            $log_data = PHP_EOL . "Succeeded importing devices: " . $s_d . PHP_EOL . "Failed to import devices:" . $f_d . PHP_EOL;
            fwrite($log, $log_data);

            $msg = "Successfully imported " . $s_d . " items!<br>Skipped " . $f_d . " items.<br>See log files to see any errors.";
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
