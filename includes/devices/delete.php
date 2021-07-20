<!-- Header -->
<?php include "../../header.php" ?>

<?php
# delete a device from devices table
    if (isset($_GET['delete_device'])) {
        $dID = $_GET['delete_device'];
        $query = "DELETE FROM devices WHERE dID = '$dID'";
        $delete_query = mysqli_query($conn, $query);
        header("Location: home.php");
    }
?>

