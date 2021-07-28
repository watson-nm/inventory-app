<!-- Header -->
<?php  include '../../header.php'?>

<div class="container p-0">
    <h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Details</h1>

    <button class="btn btn-sm btn-warning mb-1" type="submit" form="export">Export</button>
    <form name="export" id="export" action="../../export.php" method="POST">

        <table class="table table-striped table-bordered table-hover" style="font-size:12px">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Section</th>
            </tr>
        </thead>
            <tbody>
            <tr>
                <?php
                if (isset($_GET['aID'])) {
                    $aID = $_GET['aID'];

                    // SQL query to fetch the data where id=$userid & storing data in view_user
                    $query = "SELECT * FROM assignees WHERE aID = {$aID}";
                    $view_assignee = mysqli_query($conn,$query);

                    if ($row = mysqli_fetch_assoc($view_assignee)) {
                        $name = $row['name'];
                        $section = $row['section'];

                        $data_arr[] = array($name,$section);

                        echo "<tr >";
                        echo " <td scope='row' >{$aID}</td>";
                        echo " <td >{$name}</td>";
                        echo " <td >{$section}</td>";
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
    <a href="assignees.php" class="btn btn-sm btn-warning m-3"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
