<!-- Header -->
<?php include "../../header.php" ?>

<?php
# delete assignee from assignees table
# only works if no devices are assigned
# if assignee remeains even after using delete:
#   - search for all devices assigned to subject
#   - edit devices so they are no longer assigned to subject
#   - OR delete all devices assigned to subject
    if (isset($_GET['aID'])) {
        $aID = $_GET['aID'];
        $query = "DELETE FROM assignees WHERE aID = '$aID'";
        $delete_query = mysqli_query($conn, $query);

        if (!$delete_query) {
            $warn = "Was unable to delete item from table:<br>error '".mysqli_error($conn)."'";
            alert("error", $warn);
        } else {
            $msg = "Successfully deleted item from table!";
            alert("good", $msg);
        }
    }
?>

<!-- BACK button to go to the devices page -->
<div class="container text-center">
    <a href="assignees.php" class="btn btn-primary m-3"> Return to table </a>
<div>

<?php include "../../footer.php" ?>
