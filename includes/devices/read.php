<!-- Header -->
<?php  include '../../header.php'?>


<div class="container p-0">
<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Details</h1>

    <button class="btn btn-sm btn-warning mb-2" type="submit" form="export">Export</button>
    <form name="export" id="export" action="../../export.php" method="POST">

        <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
            <th scope="col">Item ID</th>
            <th scope="col">Assigned To</th>
            <th scope="col">Location</th>
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

                        $location = $row['location'];
                        $asset_num = $row['asset_num'];
                        $serial_num = $row['serial_num'];
                        $dev_type = $row['dev_type'];
                        $make = $row['make'];
                        $model = $row['model'];

                        if ($row['assign_date'] == '0000-00-00') {
                            $assign_date = NULL;
                        } else {
                            $assign_date = date("m/d/Y", strtotime($row['assign_date']));
                        }

                        if ($row['update_date'] == '0000-00-00') {
                            $update_date = NULL;
                        } else {
                            $update_date = date("m/d/Y", strtotime($row['update_date']));
                        }

                        $data_arr[] = array($dID,$assignee,$location,$asset_num,$serial_num,$dev_type,$make,$model,$assign_date,$update_date);

                        echo "<tr >";
                        echo " <td scope='row' >{$dID}</td>";
                        echo " <td >{$assignee}</td>";
                        echo " <td >{$location}</td>";
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
<div class="container text-center">
    <a href="home.php" class="btn btn-sm btn-warning m-3"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
