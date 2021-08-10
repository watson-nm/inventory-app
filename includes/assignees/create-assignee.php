<!-- Header -->
<?php  include "../../header.php" ?>

<!-- The php code that adds items to tables -->
<?php
    if(isset($_POST['create'])) {
        # Input From Form
        #####
        $name = $_POST['name'];
        $section = $_POST['section'];
        #####

        # This portion should:
        # - look for any assignees that match the user input
        # - if a match is already in the table then the aID for that assignee will be used
        # - if no match is found then a new assignee will be added and its aId will be used
        $search_aID = "SELECT aID FROM assignees WHERE name Like '%$name%' AND section LIKE '%$section%'";
        $search_res = mysqli_query($conn, $search_aID);

        if (mysqli_num_rows($search_res) > 0) {
            $warn = "That assignee already exists in the table!";
            alert("error", $warn);
        } else {
            # Insert Command
            #####
            $intoA = "INSERT INTO assignees(name, section) VALUES('{$name}', '{$section}')";
            #####
            $addA = mysqli_query($conn, $intoA);

            if ($addA <= 0) {
                $warn = "Something went wrong adding assignee". mysqli_error($conn);
                alert("error", $warn);
            } else {
                $msg = "User added successfully!";
                alert("good", $msg);
            }
        }
    }
?>

<div class="container p-0">
    <h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Add Entry details</h1>

    <!-- Input Form -->
    <!-- ##### -->
    <form action="" method="post">
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" />
        </div>

        <div class="form-group">
            <label for="section" class="form-label">Section</label>
            <input type="text" name="section" id="section" class="form-control" />
        </div>

        <div class="form-group">
            <input type="submit" name="create" class="btn btn-primary mt-2" value="Submit" />
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

<!-- a BACK button to go to the assignees page -->
<div class="container text-center">
  <a href="assignees.php" class="btn btn-warning m-3"> Back </a>
  <div>
    <!-- Footer -->
    <?php include "../../footer.php" ?>
  </div>
</div>
