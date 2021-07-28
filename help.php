<!-- Header -->
<?php include "header.php"?>
<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.1);">Help Page</h1>

<div class="container">
    <div class="accordion py-4" id="help_accordion">
        <!-- Card about database structure -->
        <div class="card">
            <div class="card-header" id="database_structure">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_ds" aria-expanded="false" aria-controls="collapse_ds">
                        Database Structure
                    </button>
                </h5>
            </div>

            <div id="collapse_ds" class="collapse" aria-labelledby="heading_ds" data-parent="#help_accordion">
                <div class="card-body">
                    The database contains two tables: Devices and Assignees.
                    <br />
                    The Devices table has columns:
                    <ul>
                        <li><b>dID</b>: The unique table ID of an item.</li>
                        <li><b>assignee</b>: The person, section, or location that the device is assigned to. This number corresponds to an <b>aID</b> in the <b>Assignees</b> table.</li>
                        <li><b>location</b>: The physical location of the device.</li>
                        <li><b>asset_num</b>: The asset number of the device.</li>
                        <li><b>serial_num</b>: The unique serial number of the device.</li>
                        <li><b>dev_type</b>: The type of device.</li>
                        <li><b>make</b>: The make of the device.</li>
                        <li><b>model</b>: The model of the device.</li>
                        <li><b>assign date</b>: The date when the device is assigned.</li>
                        <li><b>update date</b>: The date when the device is updated.</li>
                    </ul>
                    The Assignees table has columns:
                    <ul>
                        <li><b>aID</b>: The unique table ID an item. This is linked to the <b>assignees</b> column of the <b>Devices</b> table.</li>
                        <li><b>name</b>: The name of a person, section, or location.</li>
                        <li><b>section</b>: The section to which a person may belong to.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Card about navigating -->
        <div class="card">
            <div class="card-header" id="navigation_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_N" aria-expanded="false" aria-controls="collapse_N">
                        Navigating App Pages
                    </button>
                </h5>
            </div>
            <div id="collapse_N" class="collapse" aria-labelledby="heading_N" data-parent="#help_accordion">
                <div class="card-body">
                    <ul>
                        <li>The <b>Start</b> page leads to the <b>Devices</b> page.</li>
                        <li>The <b>Devices</b> page contains buttons for the following operations:
                            <ul>
                                <li>Search in the devices table.</li>
                                <li>Create a new device item in tabel.</li>
                                <li>See all devices on one page.</li>
                                <li>Export table on page to a csv file.</li>
                                <li>Import data to the devices table from a csv file.</li>
                                <li>Go to Assignees page.</li>
                            </ul>
                        </li>
                        <li>The <b>Assignees</b> page contains buttons for the following operations:
                            <ul>
                                <li>Search in the assignees table.</li>
                                <li>Create a new assignee item in table.</li>
                                <li>See all assignees on one page.</li>
                                <li>Export table on page to a csv file.</li>
                                <li>Import data to the assignees table from a csv file.</li>
                                <li>Go to the Devices page.</li>
                            </ul>
                        </li>
                        <li>Each entry in tables on the <b>Devices</b> and <b>Assignees</b> pages contain buttons for the following operations:
                            <ul>
                                <li>View the details of the table item.</li>
                                <li>Edit the details of the table item.</li>
                                <li>Delete the item from the table.</li>
                            </ul>
                        </li>
                    </ul>
                    Both the Devices and Assignees pages will show up to 50 results from their respective database tables.<br>
                    The navigation bar beneath the tables can be used to see more results.<br>
                    If you wish to see every item in a table, use the <b>See All</b> button beneath the search bar.
                </div>
            </div>
        </div>

        <!-- Card about searching -->
        <div class="card">
            <div class="card-header" id="search_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_S" aria-expanded="false" aria-controls="collapse_S">
                        Searching
                    </button>
                </h5>
            </div>
            <div id="collapse_S" class="collapse" aria-labelledby="heading_S" data-parent="#help_accordion">
                <div class="card-body">
                    The Search bar is made up of three components:
                    <ul>
                        <li>On the left is a dropdown menu for choosing the search category.</li>
                        <li>In the middle is a text input box for typing in the search query.</li>
                        <li>On the right is the search button, which will bring you to a Search Results page.</li>
                    </ul>
                    The dropdown menu for searching in the Devices table has the following search categories:
                    <ul>
                        <li><b>Item ID</b>: The automatically assigned table ID of an item.</li>
                        <li><b>Assigned To</b>: The name of the device's assignee.</li>
                        <li><b>Location</b>: The device's physical location.</li>
                        <li><b>Asset #</b>: The device's asset number.</li>
                        <li><b>Serial #</b>: The device's unique serial number.</li>
                        <li><b>Device</b>: The type of device.</li>
                        <li><b>Make</b>: The make of the device.</li>
                        <li><b>Model</b>: The model of the device.</li>
                        <li><b>Assign Date</b>: The date when a device was assigned.</li>
                        <li><b>Update Date</b>: The date when a device was updated.</li>
                    </ul>
                    The dropdown menu for searching in the Assignees table has the following search categories:
                    <ul>
                        <li><b>Name</b>: The name of the assignee</li>
                        <li><b>Section</b>: The section the assignee belongs to.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Card about creating devices/assignees -->
        <div class="card">
            <div class="card-header" id="create_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_C" aria-expanded="false" aria-controls="collapse_C">
                        Creating Items
                    </button>
                </h5>
            </div>
            <div id="collapse_C" class="collapse" aria-labelledby="heading_C" data-parent="#help_accordion">
                <div class="card-body">
                    To add a new device or assignee item to a table use the <b>Create</b> button on the Devices and Assignees pages.<br>
                    In order to create a new device the intended assignee <b>must already exist</b> in the Assignees table.<br>
                    The Create page for a new device contains the following input fields:
                    <ul>
                        <li><b>Assignee Name</b>: The name of the person, section, or location the device should be assigned to.</li>
                        <li><b>Assignee Section</b>: If applicable, the section which the assignee belongs to.</li>
                        <li><b>Service Tag</b>: The physical location of the device.</li>
                        <li><b>Asset #</b>: The asset number of the device.</li>
                        <li><b>Serial #</b>: The unique serial number of the device.</li>
                        <li><b>Device Type</b>: The type of device.</li>
                        <li><b>Make</b>: The make of the device.</li>
                        <li><b>Model</b>: The model of the device.</li>
                        <li><b>Assign Date</b>: The date when the device was assigned.</li>
                        <li><b>Update Date</b>: The date when the device was updated</li>
                    </ul>
                    The inputs for Assignee Name, Assignee Section, Device Type, Make, and Model will show suggestions as you type.<br>
                    The suggestions are based off of information that is already in the table.<br>
                    The Date inputs will show a small calendar tool when clicked.<br>
                    Please use the calendar tool when choosing dates so as to ensure the data is properly formatted.
                    <br>
                    The Create page for a new assignee contains the following input fields:
                    <ul>
                        <li><b>Name</b>: The name of a person, section, or location.</li>
                        <li><b>Section</b>: If applicable, the section the assignee belongs to.</li>
                    </ul>
                    The Name and Section inputs will also show suggestions as you type.
                    <br>
                </div>
            </div>
        </div>

        <!-- Card about reading devices/assignees -->
        <div class="card">
            <div class="card-header" id="read_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_R" aria-expanded="false" aria-controls="collapse_R">
                        Reading Items
                    </button>
                </h5>
            </div>
            <div id="collapse_R" class="collapse" aria-labelledby="heading_R" data-parent="#help_accordion">
                <div class="card-body">
                    To view the information for a singe device or assignee in a table, click the <b>View</b> button in the Item Operations column.<br>
                    The viewing page also contains an export button, so that the information for a singe table item may be downloaded.
                </div>
            </div>
        </div>

        <!-- Card about updating devices/assignees -->
        <div class="card">
            <div class="card-header" id="update_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_U" aria-expanded="false" aria-controls="collapse_U">
                        Updating Items
                    </button>
                </h5>
            </div>
            <div id="collapse_U" class="collapse" aria-labelledby="heading_U" data-parent="#help_accordion">
                <div class="card-body">
                    To change a table item's information, click the <b>Edit</b> button in the Item Operations column.<br>
                    The Update page for a new device will show the current information in the following fields:
                    <ul>
                        <li><b>Assignee Name</b>: The name of the person, section, or location the device should be assigned to.</li>
                        <li><b>Assignee Section</b>: If applicable, the section which the assignee belongs to.</li>
                        <li><b>Location</b>: The physical location of a device.</li>
                        <li><b>Asset #</b>: The asset number of the device.</li>
                        <li><b>Serial #</b>: The unique serial number of the device.</li>
                        <li><b>Device Type</b>: The type of device.</li>
                        <li><b>Make</b>: The make of the device.</li>
                        <li><b>Model</b>: The model of the device.</li>
                        <li><b>Assign Date</b>: The date the device was assigned.</li>
                        <li><b>Update Date</b>: The date the device was updated.</li>
                    </ul>
                    As with the create page, the inputs for Assignee Name, Assignee Section, Device Type, Make, and Model will show suggestions as you type.<br>
                    The Date inputs will also show small calendar tools when clicked, so as to ensure proper formatting of data.<br>
                    To assign the device to a different assignee, simply input the desired assignee's Name and Section in the first two input fields.<br>
                    <br>
                    The Create page for a new assignee will show the current information in the following fields:
                    <ul>
                        <li><b>Name</b>: The name of a person, section, or location.</li>
                        <li><b>Section</b>: If applicable, the section the assignee belongs to.</li>
                    </ul>
                    As with the create page, the Name and Section inputs will show suggestions from the database as you type.
                </div>
            </div>
        </div>

        <!-- Card about delting devices/assignees -->
        <div class="card">
            <div class="card-header" id="delete_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_D" aria-expanded="false" aria-controls="collapse_D">
                        Deleting Items
                    </button>
                </h5>
            </div>
            <div id="collapse_D" class="collapse" aria-labelledby="heading_D" data-parent="#help_accordion">
                <div class="card-body">
                    To delete an item from the Devices or Assignees table click the <b>Delete</b> button in the Item Operations column.<br>
                    In order to delete an assignee <b>there must be <i>no</i> devices assigned to it</b>.<br>
                    If attempting to delete an assignee you can follow these steps:
                    <ul>
                        <li>Go to the <b>Devices</b> page.</li>
                        <li>Choose the <b>Assigned To</b> option in the search bar's dropdown menu.</li>
                        <li>Type in the name of the assignee you wish to delete and click <b>Search</b>.</li>
                        <li>Either delete or reassign the devices on the results page.</li>
                        <li>Go to the Assignees page and delete the assignee.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Card about exporting data -->
        <div class="card">
            <div class="card-header" id="export_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_E" aria-expanded="false" aria-controls="collapse_E">
                        Exporting
                    </button>
                </h5>
            </div>
            <div id="collapse_E" class="collapse" aria-labelledby="heading_E" data-parent="#help_accordion">
                <div class="card-body">
                    The export button is available on the Devices page, the Assignees page, item View pages, and Search result pages.<br>
                    When clicked data will be exported to a csv file.<br>
                    Only the data visible on the <b>current page</b> will be exported.<br>
                    If you wish to export <b>all of the data in a table</b>, click the <b>See All</b> button beneath the search bar and then the <b>Export</b> button.
                </div>
            </div>
        </div>

        <!-- Card about importing data -->
        <div class="card">
            <div class="card-header" id="import_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_I" aria-expanded="false" aria-controls="collapse_I">
                        Importing
                    </button>
                </h5>
            </div>
            <div id="collapse_I" class="collapse" aria-labelledby="heading_I" data-parent="#help_accordion">
                <div class="card-body">
                The import button is available on the Devices and Assignees pages.<br>
                Any data you wish to import <b>must</b> be in a csv file.<br>
                To import data into the Devices table the csv file must contain the following columns, in this <b>exact order</b>:
                <ul>
                    <li><b>Assignee Name</b></li>
                    <li><b>Location</b></li>
                    <li><b>Asset Number</b></li>
                    <li><b>Serial Number</b></li>
                    <li><b>Device Type</b></li>
                    <li><b>Device Make</b></li>
                    <li><b>Device Model</b></li>
                    <li><b>Assign Date</b></li>
                    <li><b>Update Date</b></li>
                </ul>

                <b>Do not</b> include column names in the csv file, just make sure the data is in this order.<br>
                The rules for how column data should be formatted:
                <ul>
                    <li>It is allowed to have blank entries in columns.</li>
                    <li>Serial numbers and service tags must be unique values. If they are not, then the device will not be placed in the database.</li>
                    <li>All dates must be in the format <b>mm/dd/yyyy</b>.</li>
                    <li>Input data shold not include:
                        <ul>
                            <li>unknown characters (�)</li>
                            <li>double quotes (")</li>
                            <li>back slashes (\)</li>
                            <li>percentages (%)</li>
                            <li>underscores (_)</li>
                        </ul>
                    </li>
                </ul>
                To import data into the Assignees table the csv file must include the following columns, in this <b>exact order</b>:
                <ul>
                    <li><b>Name</b></li>
                    <li><b>Section</b></li>
                </ul>
                <b>Do not</b> include column names in the csv file, just make sure the data is in this order.<br>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BACK button to go to the index page -->
<div class="container text-center mb-5">
    <a href="index.php" class="btn btn-warning mb-5"> Back </a>
    <div>
        <!-- Footer -->
        <?php include "footer.php" ?>
    </div>
</div>
