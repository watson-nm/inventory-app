<!-- Header -->
<?php  include "../../header.php" ?>

<div class="container p-0">
    <h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Search Results</h1>

    <?php
        $category = $_POST['category'];
        $term = $_POST['term'];
    ?>

    <form name="search" action="search-assignees.php" method="POST">
        <div class="form-group w-50 mb-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <!-- Search Categories -->
                    <!-- ##### -->
                    <select class="custom-select" name="category">
                        <option value="aID">ID</option>
                        <option value="name">Name</option>
                        <option value="section">Section</option>
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
    <form name="export" id="export" action="../../export.php" method="POST">

        <table class="table table-striped table-bordered table-hover" style="font-size:12px">
            <!-- Table Head -->
            <!-- ##### -->
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Section</th>
                <th scope="col" colspan="3" class="text-center">CRUD Operations</th>
            </tr>
            </thead>
            <!-- ##### -->
            <tbody>
                <tr>
                    <?php
                    # The case for name search
                    $query = "SELECT * FROM assignees WHERE $category LIKE '%$term%'";
                    $view_data = mysqli_query($conn, $query);

                    while ($row= mysqli_fetch_assoc($view_data)) {
                        # Get From Database
                        #####
                        $aID = $row['aID'];
                        $name = $row['name'];
                        $section = $row['section'];
                        #####

                        # Data Array
                        #####
                        $data_arr[] = array($name,$section);
                        #####

                        # Echo Table Contents
                        #####
                        echo "<tr >";
                        echo " <td scope='row' >{$aID}</td>";
                        echo " <td >{$name}</td>";
                        echo " <td >{$section}</td>";
                        #####

                        echo " <td class='text-center'> <a href='read-assignee.php?aID={$aID}' class='btn btn-primary'> <i class='bi bi-eye'></i>View</a> </td>";

                        echo " <td class='text-center' > <a href='update-assignee.php?edit&aID={$aID}' class='btn btn-secondary'><i class='bi bi-pencil'></i>Edit</a> </td>";

                        echo " <td  class='text-center'>  <a href='delete-assignee.php?aID={$aID}' class='btn btn-danger'> <i class='bi bi-trash'></i>Delete</a> </td>";

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

<!-- a BACK button to go to the home page -->
<div class="container text-center">
    <a href="assignees.php" class="btn btn-warning m-3"> Back </a>
<div>

