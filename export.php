<?php
    if (isset($_POST["export_data"])) {
        $table_data = unserialize(base64_decode($_POST["export_data"]));

        $filename = "table-data.csv";
        ($file = fopen($filename, "w")) or die("could not open file");

        foreach ($table_data as $line) {
            fputcsv($file, $line);
        }

        fclose($file);

        // download
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . $filename);
        header("Content-Type: application/csv; ");

        readfile($filename);

        // delete file
        unlink($filename);

        exit();
    } else {
        echo "could not get data";
    }
?>
