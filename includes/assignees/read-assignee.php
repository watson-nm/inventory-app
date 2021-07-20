<!-- Header -->
<?php  include '../../header.php'?>

<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Details</h1>
<div class="container">
    <form name="export" action="../../export.php" method="POST">
        <button class="btn btn-secondary mb-2" type="submit" value="Submit">Export</button>

        <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
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
<div class="container text-center mt-5">
    <a href="assignees.php" class="btn btn-warning mt-5"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
