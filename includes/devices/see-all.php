<!-- Header -->
<?php include "../../header.php"?>
<div class="container">
<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Device Inventory: All</h1>

    <a href="home.php" class='btn btn-outline-dark mb-2'></i>Return to Devices</a>

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
                <th scope="col" colspan="3" class="text-center">CRUD Operations</th>
            </tr>
            </thead>
                <tbody>
                    <tr>
                        <?php
                        $query_devices = "SELECT * FROM devices";
                        $view_devices_data = mysqli_query($conn, $query_devices);

                        while ($row = mysqli_fetch_assoc($view_devices_data)) {
                            $dID = $row['dID'];

                            $aID = $row['assignee'];
                            $query_assignees = "SELECT * FROM assignees WHERE aID = $aID";
                            $get_assignee = mysqli_query($conn, $query_assignees);
                            $aVal = mysqli_fetch_assoc($get_assignee);
                            $assignee = $aVal['name'];

                            $asset_num = $row['asset_num'];
                            $serial_num = $row['serial_num'];
                            $dev_type = $row['dev_type'];
                            $make = $row['make'];
                            $model = $row['model'];
                            $assign_date = $row['assign_date'];
                            $update_date = $row['update_date'];

                            $data_arr[] = array($dID,$assignee,$asset_num,$serial_num,$dev_type,$make,$model,$assign_date,$update_date);

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

                            echo " <td class='text-center'> <a href='read.php?device_id={$dID}' class='btn btn-primary'> <i class='bi bi-eye'></i>View</a> </td>";

                            echo " <td class='text-center' > <a href='update.php?edit&device_id={$dID}' class='btn btn-secondary'><i class='bi bi-pencil'></i>Edit</a> </td>";

                            echo " <td  class='text-center'>  <a href='delete.php?delete_device={$dID}' class='btn btn-danger'> <i class='bi bi-trash'></i>Delete</a> </td>";

                            echo " </tr> ";
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
<!-- BACK button to go to the index page -->
<div class="container text-center mb-5">
    <a href="../../index.php" class="btn btn-warning mb-5"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>