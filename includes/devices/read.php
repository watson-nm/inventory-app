<!-- Header -->
<?php  include '../../header.php'?>

<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Details</h1>

<div class="container">
    <form name="export" action="../../export.php" method="POST">
        <button class="btn btn-secondary mb-2" type="submit" value="Submit">Export</button>

        <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
            <th scope="col">Item ID</th>
            <th scope="col">Assigned To</th>
            <th scope="col">Asset #</th>
            <th scope="col">Serial #</th>
            <th scope="col">Device</th>
            <th scope="col">Make</th>
            <th scope="col">Model</th>
            <th scope="col">Assign Date</th>
            <th scope="col">Update Date</th>
            </tr>
        </thead>
            <tbody>
            <tr>
                <?php
                if (isset($_GET['device_id'])) {
                    $dID = $_GET['device_id'];

                    $query = "SELECT * FROM devices WHERE dID = {$dID}";
                    $view_device = mysqli_query($conn,$query);

                    if ($row = mysqli_fetch_assoc($view_device)) {
                        $dID = $row['dID'];

                        $aID = $row['assignee'];
                        $query_assignees = "SELECT name FROM assignees WHERE aID = $aID";
                        $get_assignee = mysqli_query($conn, $query_assignees);
                        $aVal = mysqli_fetch_assoc($get_assignee);
                        $assignee = $aVal['name'];

                        $data_arr[] = array($dID,$assignee,$asset_num,$serial_num,$dev_type,$make,$model,$assign_date,$update_date);

                        $asset_num = $row['asset_num'];
                        $serial_num = $row['serial_num'];
                        $dev_type = $row['dev_type'];
                        $make = $row['make'];
                        $model = $row['model'];
                        $assign_date = $row['assign_date'];
                        $update_date = $row['update_date'];

                        echo "<tr >";
                        echo " <td scope='row' >{$dID}</td>";
                        echo " <td >{$assignee}</td>";
                        echo " <td >{$asset_num}</td>";
                        echo " <td >{$serial_num}</td>";
                        echo " <td >{$dev_type}</td>";
                        echo " <td >{$make}</td>";
                        echo " <td >{$model}</td>";
                        echo " <td >{$assign_date}</td>";
                        echo " <td >{$update_date}</td>";
                        echo " </tr> ";
                    }
                }
                ?>
            </tr>
            </tbody>
        </table>

        <!-- Serialize data_arr. Must be below table. -->
        <?php
            $serialized_data = base64_encode(serialize($data_arr));
        ?>

        <input type="hidden" name="export_data" value=<?php echo $serialized_data ?> />

    </form>
</div>

<!-- a BACK Button to go to pervious page -->
<div class="container text-center mt-5">
    <a href="home.php" class="btn btn-warning mt-5"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>