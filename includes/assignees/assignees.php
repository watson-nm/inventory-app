<!-- Header -->
<?php include "../../header.php"?>
<div class="container p-0">
    <h1 class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.10);">Assignees</h1>

    <form name="search" action="search-assignees.php" method="POST">
        <div class="form-group w-50 mb-1">
            <div class="input-group">
                <div class="input-group-prepend">
                    <select class="custom-select" name="category">
                        <option value="aID">ID</option>
                        <option value="name">Name</option>
                        <option value="section">Section</option>
                    </select>
                </div>

                <input type="text" class="form-control" name="term" placeholder="Search term"/>

                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="submit" value="Search">Search</button>
                </div>
            </div>
        </div>
    </form>

    <a href="create-assignee.php" class='btn btn-sm btn-primary mb-1'></i>Create Entry</a>
    <a href="../devices/home.php" class='btn btn-sm btn-secondary mb-1'></i>Device Inventory</a>
    <a href="see-all.php" class='btn btn-sm btn-info mb-1'></i>See All Assignees</a>

    <!-- Import and export buttons -->
    <div class="row">
        <!-- Export button that is connected to the export form -->
        <div class="col-md-auto pr-1">
            <button class="btn btn-sm btn-warning mb-1" type="submit" form="export">Export</button>
        </div>

        <!-- Import form containing import button -->
        <div class="col-md-auto pl-0">
            <form name="import" action="../../import-assignees.php" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-1">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-warning" type="submit" name="submit">Import</button>
                        </div>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="input_file" name="input_file" aria-describedby="submit">
                            <label class="custom-file-label" for="input_file"></label>
                        </div>
                    </div>
                    <script type="application/javascript">
                        $('input[type="file"]').change(function(e){
                            var fileName = e.target.files[0].name;
                            $('.custom-file-label').html(fileName);
                        });
                    </script>
                </div>
            </form>
        </div>
    </div>

    <form name="export" id="export" action="../../export.php" method="POST">
        <table class="table table-striped table-bordered table-hover" style="font-size:12px">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Assigned To</th>
                <th scope="col">Section</th>
                <th scope="col" colspan="3" class="text-center">Item Operations</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                    $start_from = ($page-1) * $results_per_page;

                    $query_assignees = "SELECT * FROM assignees LIMIT $start_from, ".$results_per_page;
                    $view_assignees_data = mysqli_query($conn, $query_assignees);
                    $data_arr = array();

                    while($row = mysqli_fetch_assoc($view_assignees_data)){
                        $aID = $row['aID'];

                        $name = $row['name'];
                        $section = $row['section'];

                        $data_arr[] = array($name,$section);

                        echo "<tr >";
                        echo " <td scope='row' >{$aID}</td>";
                        echo " <td >{$name}</td>";
                        echo " <td >{$section}</td>";

                        echo " <td class='text-center'> <a href='read-assignee.php?aID={$aID}' class='btn btn-sm btn-info'> <i class='bi bi-eye'></i>View</a> </td>";

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

    <!-- Page navigation code -->
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
                echo "<a class='page-link' href='assignees.php?page=".$prev."' aria-label='Previous'>";
                echo "<span aria-hidden='true'>&laquo;</span>";
                echo "<span class='sr-only'>Previous</span>";
                echo "</a></li>";

                // buttons for pages
                $sql = "SELECT COUNT(aID) AS total FROM assignees";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

                for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
                    if ($i==$page) {
                        echo "<li class='page-item active'>";
                    } else {
                        echo "<li class='page-item'>";
                    }
                    echo "<a href='assignees.php?page=".$i."'";
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
                echo "<a class='page-link' href='assignees.php?page=".$next."' aria-label='Next'>";
                echo "<span aria-hidden='true'>&raquo;</span>";
                echo "<span class='sr-only'>Next</span>";
                echo "</a></li>";
                ?>
            </ul>
        </nav>
    </div>

<!-- BACK button to go to the index page -->
<div class="container text-center">
    <a href="../../index.php" class="btn btn-sm btn-warning m-3"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
