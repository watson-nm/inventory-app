<!-- Header -->
<?php  include "../../header.php" ?>

<!-- The php code that adds items to tables -->
<?php
    if(isset($_POST['create'])) {
        $name = $_POST['name'];
        $section = $_POST['section'];

        # This portion should:
        # - look for any assignees that match the user input
        # - if a match is already in the table then the aID for that assignee will be used
        # - if no match is found then a new assignee will be added and its aId will be used
        $search_aID = "SELECT aID FROM assignees WHERE name Like '%$name%' AND section LIKE '%$section%'";
        $search_res = mysqli_query($conn, $search_aID);

        if (mysqli_num_rows($search_res) > 0) {
            echo "<script type='text/javascript'>alert('That assignee already exists in the table!')</script>";
        } else {
            $intoA = "INSERT INTO assignees(name, section) VALUES('{$name}', '{$section}')";
            $addA = mysqli_query($conn, $intoA);

            if ($addA <= 0) {
                echo "something went wrong adding assignee". mysqli_error($conn);
            } else {
                echo "<script type='text/javascript'>alert('User added successfully!')</script>";
            }
        }
    }
?>

<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.10);">Add Entry details</h1>
<div class="container">
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
      <input type="submit" name="create" class="btn btn-primary mt-2" value="submit" />
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

<!-- a BACK button to go to the assignees page -->
<div class="container text-center mt-5">
  <a href="assignees.php" class="btn btn-warning mt-5"> Back </a>
  <div>
    <!-- Footer -->
    <?php include "../../footer.php" ?>
  </div>
</div>
