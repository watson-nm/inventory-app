<!-- Header -->
<?php include "../../header.php"?>
<div class="container">
<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Device Inventory</h1>

    <p>
    <form name="search" action="search.php" method="POST">
        <div class="form-group w-50">
            <div class="input-group">
                <div class="input-group-prepend">
                    <select class="custom-select" name="category">
                        <option value="dID">Item ID</option>
                        <option value="assignee">Assigned To</option>
                        <option value="asset_num">Asset #</option>
                        <option value="serial_num">Serial #</option>
                        <option value="dev_type">Device</option>
                        <option value="make">Make</option>
                        <option value="model">Model</option>
                        <option value="assign_date">Assign Date</option>
                        <option value="update_date">Update Date</option>
                    </select>
                </div>

                <input type="text" class="form-control" name="term" placeholder="Search term"/>

                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit" value="Search">Search</button>
                </div>
            </div>
        </div>
    </form>
    </p>

    <a href="create.php" class='btn btn-outline-dark mb-2'></i>Create Entry</a>
    <a href="../assignees/assignees.php" class='btn btn-secondary mb-2'></i>Assignees Page</a>
    <a href="see-all.php" class='btn btn-secondary mb-2'></i>See All Devices</a>

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
                        if (isset($_GET["page"])) {
                            $page  = $_GET["page"];
                        } else {
                            $page=1;
                        }

                        $start_from = ($page-1) * $results_per_page;

                        $query_devices = "SELECT * FROM devices LIMIT $start_from, ".$results_per_page;
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

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php
            $prev = $page - 1;
            $next = $page + 1;

            // button for previous page
            if ($page==1) {
                echo "<li class='page-item disabled'>";
            } else {
                echo "<li class='page-item'>";
            }
            echo "<a class='page-link' href='home.php?page=".$prev."' aria-label='Previous'>";
            echo "<span aria-hidden='true'>&laquo;</span>";
            echo "<span class='sr-only'>Previous</span>";
            echo "</a></li>";

            // buttons for pages
            $sql = "SELECT COUNT(dID) AS total FROM devices";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

            for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
                if ($i==$page) {
                    echo "<li class='page-item active'>";
                } else {
                    echo "<li class='page-item'>";
                }
                echo "<a href='home.php?page=".$i."'";
                if ($i==$page) echo " active";
                echo " class='page-link'>".$i." ";
                if ($i==$page) echo "<span class='sr-only'>(current)</span>";
                echo "</a></li>";
            };

            // button for next page
            if ($page==$total_pages) {
                echo "<li class='page-item disabled'>";
            } else {
                echo "<li class='page-item'>";
            }
            echo "<a class='page-link' href='home.php?page=".$next."' aria-label='Next'>";
            echo "<span aria-hidden='true'>&raquo;</span>";
            echo "<span class='sr-only'>Next</span>";
            echo "</a></li>";
            ?>
        </ul>
    </nav>
</div>
<!-- BACK button to go to the index page -->
<div class="container text-center mb-5">
    <a href="../../index.php" class="btn btn-warning mb-5"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
