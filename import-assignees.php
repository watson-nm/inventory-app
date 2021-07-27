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

                $timestamp = date("Y-m-d_H:i:s", time());
                $logname = $log_dir . "log_" . $timestamp . ".txt";
                $logname = $log_dir . "log.txt";
                $log = fopen($logname, "w");

                $i = 0;
                $s = 0;
                $f = 0;

                $count = 0;

                while (($row = fgetcsv($file, 10000, ",")) !== false) {
                    $name = mysqli_real_escape_string($conn, $row[0]);
                    $section =  mysqli_real_escape_string($conn, $row[1]);

                    # Insert assignee into table
                    $intoA = "INSERT INTO assignees (name, section) VALUES ('$name', '$section');";
                    $add_entry = mysqli_query($conn, $intoA);

                    if ($add_entry <= 0) {
                        $log_data = "Error: could not insert assignee 'name($name)' into table from input line '$i'".PHP_EOL;
                        fwrite($log, $log_data);
                        $f = $f + 1;
                        $i = $i + 1;
                        continue;
                    } else {
                        $log_data = "Alert: inserted assignee 'name($name)' into table from input line '$i'".PHP_EOL;
                        fwrite($log, $log_data);
                        $s = $s + 1;
                        $i = $i + 1;
                    }
                }
            }
            unlink($target_file);

            $msg = "Successfully imported data!<br>Please return to the assignees page and ensure your data is correct.";
            alert("good", $msg);
        } else {
            $warn = "Sorry, there was an error uploading your file.";
            alert("error", $warn);
        }
    }
}
?>

<!-- BACK button to go to the assignees page -->
<div class="container text-center">
    <a href="includes/assignees/assignees.php" class="btn btn-primary m-3"> Assignees Page </a>
<div>

<!-- Footer -->
<?php include "footer.php" ?>
