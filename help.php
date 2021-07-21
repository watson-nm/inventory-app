<!-- Header -->
<?php include "header.php"?>
<h1 class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.1);">Help Page</h1>

<div class="container">
    <div class="accordion" id="help_accordion">
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
                        <li><b>assignee</b>: The person, section, or location that the device is assigned to. This number corresponds to an entry in the <b>Assignees</b> table.</li>
                        <li><b>asset_num</b>: The asset number of the device.</li>
                        <li><b>serial_num</b>: The unique serial number of the device.</li>
                        <li><b>dev_type</b>: The type of device.</li>
                        <li><b>make</b>: The make of the device.</li>
                        <li><b>model</b>: The model of the device.</li>
                        <li><b>assign date</b>: TBD</li>
                        <li><b>update date</b>: TBD</li>
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
            <div class="card-header" id="create_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_N" aria-expanded="false" aria-controls="collapse_N">
                        Navigating app pages
                    </button>
                </h5>
            </div>
            <div id="collapse_N" class="collapse" aria-labelledby="heading_N" data-parent="#help_accordion">
                <div class="card-body">
                    explain website map
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
                    To create a new device or assignee use the Create button present on the main Devices and Assignees pages.<br>
                    In order to create a new device the intended assignee must already exist in the Assignees table.
                    Something something autosuggest.
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
                <div class="card-body"></div>
            </div>
        </div>

        <!-- Card about updating devices/assignees -->
        <div class="card">
            <div class="card-header" id="read_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_U" aria-expanded="false" aria-controls="collapse_U">
                        Updating Items
                    </button>
                </h5>
            </div>
            <div id="collapse_U" class="collapse" aria-labelledby="heading_U" data-parent="#help_accordion">
                <div class="card-body"></div>
            </div>
        </div>

        <!-- Card about delting devices/assignees -->
        <div class="card">
            <div class="card-header" id="read_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_D" aria-expanded="false" aria-controls="collapse_D">
                        Deleting Items
                    </button>
                </h5>
            </div>
            <div id="collapse_D" class="collapse" aria-labelledby="heading_D" data-parent="#help_accordion">
                <div class="card-body"></div>
            </div>
        </div>

        <!-- Card about exporting data -->
        <div class="card">
            <div class="card-header" id="read_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_E" aria-expanded="false" aria-controls="collapse_E">
                        Exporting
                    </button>
                </h5>
            </div>
            <div id="collapse_E" class="collapse" aria-labelledby="heading_E" data-parent="#help_accordion">
                <div class="card-body"></div>
            </div>
        </div>

        <!-- Card about importing data -->
        <div class="card">
            <div class="card-header" id="read_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_I" aria-expanded="false" aria-controls="collapse_I">
                        Importing
                    </button>
                </h5>
            </div>
            <div id="collapse_I" class="collapse" aria-labelledby="heading_I" data-parent="#help_accordion">
                <div class="card-body"></div>
            </div>
        </div>

        <!-- Card about searching -->
        <div class="card">
            <div class="card-header" id="read_info">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse_S" aria-expanded="false" aria-controls="collapse_S">
                        Searching
                    </button>
                </h5>
            </div>
            <div id="collapse_S" class="collapse" aria-labelledby="heading_S" data-parent="#help_accordion">
                <div class="card-body"></div>
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