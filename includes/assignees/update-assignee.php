<!-- Header -->
<?php include "../../header.php"?>

<?php
    # checking if the variable is set or not and if set adding the set data value to variable userid
    if (isset($_GET['aID'])) {
        $aID = $_GET['aID'];
    }
    # SQL query to select all the data from the table where aID = $aID
    $query = "SELECT * FROM assignees WHERE aID = $aID";
    $view_assignee_data = mysqli_query($conn,$query);

    while ($row = mysqli_fetch_assoc($view_assignee_data)) {
        # Get From Database
        #####
        $name = $row['name'];
        $section = $row['section'];
        #####
    }

    # Processing form data when form is submitted
    if(isset($_POST['update'])) {
        # Input From Form
        #####
        $name = $_POST['name'];
        $section = $_POST['section'];
        #####

        # SQL query to update the data in devices table where the dID = $dID

        # Update Command
        #####
        $query = "UPDATE assignees SET name = '{$name}' , section = '{$section}' WHERE aID = $aID";
        #####

        $update_assignee = mysqli_query($conn, $query);
        echo "<script type='text/javascript'>alert('Table data updated successfully!')</script>";
    }
?>

<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Update Details</h1>
<div class="container ">

    <!-- Input Form -->
    <!-- ##### -->
    <form action="" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name ?>">
    </div>

    <div class="form-group">
        <label for="section">Section</label>
        <input type="text" name="section" id="section" class="form-control" value="<?php echo $section ?>">
    </div>

    <div class="form-group">
        <input type="submit"  name="update" class="btn btn-primary mt-2" value="Update">
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

<!-- a BACK button to go to the home page -->
<div class="container text-center mt-5">
<a href="assignees.php" class="btn btn-warning mt-5"> Back </a>
<div>

<!-- Footer -->
<?php include "../../footer.php" ?>
