<!-- Header -->
<?php include "../../header.php" ?>

<?php
# delete a device from devices table
    if (isset($_GET['delete_device'])) {
        $dID = $_GET['delete_device'];
        $query = "DELETE FROM devices WHERE dID = '$dID'";
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
    <a href="home.php" class="btn btn-primary m-3"> Return to table </a>
<div>

<?php include "../../footer.php" ?>

