<!-- Header -->
<?php include "../../header.php" ?>

<?php
# delete a device from devices table
    if (isset($_GET['delete_device'])) {
        $dID = $_GET['delete_device'];

        if(isset($_POST['confirm_delete'])) {
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
    }
?>

<div class="container text-center">
    <h1 class="text-center py-4" style="background-color: rgba(0, 0, 0, 0.10);">Confirm Delete</h1>
    <form action="" method="POST">
        <div class="form-group">
            <input type="submit" name="confirm_delete" class="btn btn-danger mt-2" value="Confirm Delete">
        </div>
    </form>
</div>

<!-- BACK button to go to the devices page -->
<div class="container text-center">
    <a href="home.php" class="btn btn-primary m-3"> Return to table </a>
<div>

<?php include "../../footer.php" ?>

