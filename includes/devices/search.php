<!-- Header -->
<?php  include "../../header.php" ?>
<div class="container p-1">
<h1 class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.10);">Search Results</h1>

    <?php
        $category = $_POST['category'];
        $term = $_POST['term'];
    ?>

    <form name="search" action="search.php" method="POST">
        <div class="form-group w-50 mb-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <!-- Search Categories -->
                    <!-- ##### -->
                    <select class="custom-select" name="category">
                        <option value="dID">ID</option>
                        <option value="assignee">Assigned To</option>
                        <option value="location">Location</option>
                        <option value="asset_num">Asset #</option>
                        <option value="serial_num">Serial #</option>
                        <option value="dev_type">Device</option>
                        <option value="make">Make</option>
                        <option value="model">Model</option>
                        <option value="assign_date">Assign Date</option>
                        <option value="update_date">Update Date</option>
                    </select>
                    <!-- ##### -->
                </div>

                <input type="text" class="form-control" name="term" placeholder="Search term"/>

                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" value="Search">Search</button>
                </div>
            </div>
        </div>
    </form>

    <button class="btn btn-warning mb-1" type="submit" form="export">Export</button>
    <form name="export" action="../../export.php" method="POST">

        <table class="table table-striped table-bordered table-hover" style="font-size:12px">
            <!-- Table Head -->
            <!-- ##### -->
            <thead class="thead-dark">
            <tr>
                <th scope="col">Device ID</th>
                <th scope="col">Assigned To</th>
                <th scope="col">Location</th>
                <th scope="col">Asset #</th>
                <th scope="col">Serial #</th>
                <th scope="col">Device</th>
                <th scope="col">Make</th>
                <th scope="col">Model</th>
                <th scope="col">Assign Date</th>
                <th scope="col">Update Date</th>
                <th scope="col" colspan="3" class="text-center">Item Operations</th>
            </tr>
            </thead>
            <!-- ##### -->

            <tbody>
                <tr>
                    <?php
                    # The case for name search
                    if ($category == 'assignee') {
                        $query_aID = "SELECT * FROM assignees WHERE name LIKE '%$term%'";
                        $view_data = mysqli_query($conn, $query_aID);

                        while ($row = mysqli_fetch_assoc($view_data)) {
                            $aID = $row['aID'];
                            $dev_query = "SELECT * FROM devices WHERE assignee = $aID";
                            $view = mysqli_query($conn, $dev_query);
                            while ($result = mysqli_fetch_assoc($view)) {
                                # Name Search: Get From Database
                                #####
                                $assignee = $row['name'];
                                $location = $result['location'];
                                $dID = $result['dID'];
                                $asset_num = $result['asset_num'];
                                $serial_num = $result['serial_num'];
                                $dev_type = $result['dev_type'];
                                $make = $result['make'];
                                $model = $result['model'];

                                if ($result['assign_date'] == '0000-00-00') {
                                    $assign_date = NULL;
                                } else {
                                    $assign_date = date("m/d/Y", strtotime($result['assign_date']));
                                }

                                if ($result['update_date'] == '0000-00-00') {
                                    $update_date = NULL;
                                } else {
                                    $update_date = date("m/d/Y", strtotime($result['update_date']));
                                }
                                #####

                                # Name Search: Data Array
                                #####
                                $data_arr[] = array($dID,$assignee,$location,$asset_num,$serial_num,$dev_type,$make,$model,$assign_date,$update_date);
                                #####

                                # Name Search: Echo Table Contents
                                #####
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
                                #####

                                echo " <td class='text-center'> <a href='read.php?device_id={$dID}' class='btn btn-info'> <i class='bi bi-eye'></i>View</a> </td>";

                                echo " <td class='text-center' > <a href='update.php?edit&device_id={$dID}' class='btn btn-secondary'><i class='bi bi-pencil'></i>Edit</a> </td>";

                                echo " <td  class='text-center'> <a href='delete.php?delete_device={$dID}' class='btn btn-danger'> <i class='bi bi-trash'></i>Delete</a> </td>";

                                echo " </tr> ";
                            }
                        }
                    } else {
                        $query = "SELECT * FROM devices WHERE $category LIKE '%$term%'";
                        $view_data=mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($view_data)) {
                            # Other: Get From Database
                            #####
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
                            $assign_date = $row['assign_date'];
                            $update_date = $row['update_date'];
                            #####

                            # Other: Data Array
                            $data_arr[] = array($dID,$assignee,$location,$asset_num,$serial_num,$dev_type,$make,$model,$assign_date,$update_date);
                            #####

                            # Other: Echo Table Contents
                            #####
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
                            #####

                            echo " <td class='text-center'> <a href='read.php?device_id={$dID}' class='btn btn-info'> <i class='bi bi-eye'></i>View</a> </td>";

                            echo " <td class='text-center' > <a href='update.php?edit&device_id={$dID}' class='btn btn-secondary'><i class='bi bi-pencil'></i>Edit</a> </td>";

                            echo " <td  class='text-center'>  <a href='delete.php?delete_device={$dID}' class='btn btn-danger'> <i class='bi bi-trash'></i>Delete</a> </td>";

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

<!-- U BACK button to go to the home page -->
<div class="container text-center">
    <a href="home.php" class="btn btn-warning m-3"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
