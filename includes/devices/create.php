<!-- Header -->
<?php  include "../../header.php" ?>

<!-- The php code that adds items to tables -->
<?php
    if(isset($_POST['create'])) {
        $name = $_POST['name'];
        $section = $_POST['section'];
        $location = $_POST['location'];
        $asset_num = $_POST['asset_num'];
        $serial_num = $_POST['serial_num'];
        $dev_type = $_POST['dev_type'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $assign_date = date("Y-m-d", strtotime($_POST['assign_date']));
        $update_date = date("Y-m-d", strtotime($_POST['update_date']));

        # This portion should:
        # - look for any assignees that match the user input
        # - if a match is found then the aID for that assignee will be used
        $search_aID = "SELECT aID FROM assignees WHERE name = '$name' AND section = '$section'";
        $search_res = mysqli_query($conn, $search_aID);
        if (mysqli_num_rows($search_res) > 0) {
            $row = mysqli_fetch_assoc($search_res);
            $assignee = $row['aID'];

            if (!$assignee) {
                $message = "something went wrong fetching assignee:<br> error '".mysqli_error($conn)."'";
                $type = "error";
                alert($type, $message);
            }
        } else {
            # the assignee must be specified by name and section
            # Jane Doe in MIS is different from Jane Doe in Admin
            $message = "Assignee does not exist in database. Please add assignee first.";
            $type = "error";
            alert($type, $message);
        }

        # This portion should: # - insert a new device using the previously obtained assignee value and user input values
        $intoD = "INSERT INTO devices(assignee, location, asset_num, serial_num, dev_type, make, model, assign_date, update_date) VALUES('{$assignee}', '{$asset_num}', '{$location}', '{$serial_num}', '{$dev_type}', '{$make}', '{$model}', '{$assign_date}', '{$update_date}')";
        $add_entry = mysqli_query($conn, $intoD);

        # displaying proper message for the user to see whether the query executed perfectly or not
        if (!$add_entry) {
            $message = "something went wrong adding device entry:<br> error '".mysqli_error($conn)."'";
            $type = "error";
            alert($type, $message);
        } else {
            $message = "Device added successfully!";
            $type = "good";
            alert($type, $message);
        }
    }
?>

<div class="container p-0">
<h1 class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.10);">Add Entry details</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="name" class="form-label">Assigned To: Name</label>
            <input type="text" name="name" id="name" class="form-control" />
        </div>

        <div class="form-group">
            <label for="section" class="form-label">Assigned To: Section</label>
            <input type="text" name="section" id="section" class="form-control" />
        </div>

        <div class="form-group">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" />
        </div>

        <div class="form-group">
            <label for="asset_num" class="form-label">Asset #</label>
            <input type="text" name="asset_num" id="asset_num" class="form-control" />
        </div>

        <div class="form-group">
            <label for="serial_num" class="form-label">Serial #</label>
            <input type="text" name="serial_num" id="serial_num" class="form-control" />
        </div>

        <div class="form-group">
            <label for="dev_type" class="form-label">Device Type</label>
            <input type="text" name="dev_type" id="dev_type" class="form-control" />
        </div>

        <div class="form-group">
            <label for="make" class="form-label">Make</label>
            <input type="text" name="make" id="make" class="form-control" />
        </div>

        <div class="form-group">
            <label for="model" class="form-label">Model</label>
            <input type="text" name="model" id="model" class="form-control" />
        </div>

        <div class="form-group">
            <label for="assign_date" class="form-label">Assign Date</label>
            <input type="text" name="assign_date" id="assign_date" class="date form-control" />
        </div>

        <div class="form-group">
            <label for="update_date" class="form-label">Update Date</label>
            <input type="text" name="update_date" id="update_date" class="date form-control" />
        </div>

        <div class="form-group">
            <input type="submit" name="create" class="btn btn-sm btn-primary mt-2" value="Submit" />
        </div>
    </form>
</div>

<!-- The code that autosuggests for input -->
<script type="text/javascript">
  $(function() {
     $( "#name" ).autocomplete({
       source: '../search-suggestions/name-search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#section" ).autocomplete({
       source: '../search-suggestions/section-search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#dev_type" ).autocomplete({
       source: '../search-suggestions/dev_type-search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#make" ).autocomplete({
       source: '../search-suggestions/make-search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#model" ).autocomplete({
       source: '../search-suggestions/model-search.php',
     });
  });
</script>

<script type="text/javascript">
    $(".date").datepicker({
        format: "mm/dd/yyyy",
    });
</script>

<!-- a BACK button to go to the home page -->
<div class="container text-center">
  <a href="home.php" class="btn btn-sm btn-warning m-3"> Back </a>
  <div>
    <!-- Footer -->
    <?php include "../../footer.php" ?>
  </div>
</div>
