<!-- Header -->
<?php include "../../header.php"?>
<div class="container p-0">
<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Assignees</h1>

    <a href="assignees.php" class='btn btn-sm btn-primary mb-1'></i>Return to Assignees</a>

    <button class="btn btn-sm btn-warning mb-1" type="submit" form="export">Export</button>
    <form name="export" id="export" action="../../export.php" method="POST">

        <table class="table table-striped table-bordered table-hover" style="font-size:12px">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Assigned To</th>
                <th scope="col">Section</th>
                <th scope="col" colspan="3" class="text-center">CRUD Operations</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $query_assignees = "SELECT * FROM assignees";
                    $view_assignees_data = mysqli_query($conn, $query_assignees);

                    while($row = mysqli_fetch_assoc($view_assignees_data)){
                        $aID = $row['aID'];

                        $name = $row['name'];
                        $section = $row['section'];

                        $data_arr[] = array($name,$section);

                        echo "<tr >";
                        echo " <td scope='row' >{$aID}</td>";
                        echo " <td >{$name}</td>";
                        echo " <td >{$section}</td>";

                        echo " <td class='text-center'> <a href='read-assignee.php?aID={$aID}' class='btn btn-sm btn-primary'> <i class='bi bi-eye'></i>View</a> </td>";

                        echo " <td class='text-center' > <a href='update-assignee.php?edit&aID={$aID}' class='btn btn-sm btn-secondary'><i class='bi bi-pencil'></i>Edit</a> </td>";

                        echo " <td  class='text-center'>  <a href='delete-assignee.php?aID={$aID}' class='btn btn-sm btn-danger'> <i class='bi bi-trash'></i>Delete</a> </td>";

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
<div class="container text-center">
    <a href="../../index.php" class="btn btn-sm btn-warning m-3"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
