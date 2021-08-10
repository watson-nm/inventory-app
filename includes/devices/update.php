<!-- Header -->
<?php include "../../header.php"?>

<?php
    # checking if the variable is set or not and if set adding the set data value to variable userid
    if (isset($_GET['device_id'])) {
        $dID = $_GET['device_id'];
    }
    # SQL query to select all the data from the table where dID = $dID
    $query = "SELECT * FROM devices WHERE dID = $dID";
    $view_device_data= mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($view_device_data)) {
        # Get From Database
        #####
        $aID = $row['assignee'];
        $query_assignees = "SELECT * FROM assignees WHERE aID = $aID";
        $get_assignee = mysqli_query($conn, $query_assignees);
        $aVal = mysqli_fetch_assoc($get_assignee);
        $assignee = $aVal['name'];
        $section = $aVal['section'];

        $location = $row['location'];
        $asset_num = $row['asset_num'];
        $serial_num = $row['serial_num'];
        $dev_type = $row['dev_type'];
        $make = $row['make'];
        $model = $row['model'];
        if ($row['assign_date'] == '0000-00-00') {
            $assign_date = NULL;
        } else {
            $assign_date = $row['assign_date'];
        }
        #####
    }

    # Processing form data when form is submitted
    if(isset($_POST['update'])) {
        # Input From Form
        #####
        $assignee = $_POST['name'];
        $section = $_POST['section'];
        $location = $_POST['location'];
        $asset_num = $_POST['asset_num'];
        $serial_num = $_POST['serial_num'];
        $dev_type = $_POST['dev_type'];
        $make = $_POST['make'];
        $model = $_POST['model'];

        # 1970-01-01 is automatically set for some reason if you don't include an actual date
        if ($_POST['assign_date'] == '1970-01-01' || $_POST['assign_date'] == NULL) {
            $assign_date = NULL;
        } else {
            $assign_date = date("Y-m-d", strtotime($_POST['assign_date']));
        }
        $update_date = date("Y-m-d", time());
        #####

        #get the aID using name and section
        $search_aID = "SELECT aID FROM assignees WHERE name = '$assignee' AND section = '$section'";
        $search_res = mysqli_query($conn, $search_aID);
        if (mysqli_num_rows($search_res) > 0) {
            $data = mysqli_fetch_assoc($search_res);
            $aID = $data['aID'];

            # SQL query to update the data in devices table where the dID = $dID
            # Update Command
            #####
            $query = "UPDATE devices SET assignee = '{$aID}', location = '{$location}', asset_num = '{$asset_num}', serial_num = '{$serial_num}', dev_type = '{$dev_type}', make = '{$make}', model = '{$model}', assign_date = '{$assign_date}', update_date = '{$update_date}' WHERE dID = $dID";
            #####

            $update_device = mysqli_query($conn, $query);
            $msg = "Table data updated successfully!";
            alert("good", $msg);
        } else {
            # the assignee must be specified by name and section
            # Jane Doe in MIS is different from Jane Doe in Admin
            $warn = "Assignee does not exist. Please add assignee first.";
            alert("error", $warn);
        }
    }
?>

<div class="container p-0">
<h1 class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.10);">Update Details</h1>

    <!-- Input Form -->
    <!-- ##### -->
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Assigned To: Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $assignee ?>">
        </div>

        <div class="form-group">
            <label for="section">Assigned To: Section</label>
            <input type="text" name="section" id="section" class="form-control" value="<?php echo $section ?>">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="<?php echo $location ?>">
        </div>

        <div class="form-group">
            <label for="asset_num">Asset #</label>
            <input type="text" name="asset_num" id="asset_num" class="form-control" value="<?php echo $asset_num ?>">
        </div>

        <div class="form-group">
            <label for="serial_num">Serial #</label>
            <input type="text" name="serial_num" id="serial_num" class="form-control" value="<?php echo $serial_num ?>">
        </div>

        <div class="form-group">
            <label for="dev_type">Device Type</label>
            <input type="text" name="dev_type" id="dev_type" class="form-control" value="<?php echo $dev_type ?>">
        </div>

        <div class="form-group">
            <label for="">Make</label>
            <input type="text" name="make" id="make" class="form-control" value="<?php echo $make ?>">
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="<?php echo $model ?>">
        </div>

        <div class="form-group">
            <label for="assign_date">Assign Date</label>
            <input type="text" name="assign_date" id="assign_date" class="date form-control" value="<?php echo $assign_date ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="update" class="btn btn-primary mt-2" value="Update">
        </div>
    </form>
    <!-- ##### -->
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
     $( "#location" ).autocomplete({
       source: '../search-suggestions/location-search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#dev_type" ).autocomplete({
       source: '../search-suggestions/dev-type-search.php',
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
<a href="home.php" class="btn btn-warning m-3"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
