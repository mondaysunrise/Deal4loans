<div class="content_left">
    <h1><a href="dashboard.php"><img src="<?php echo SITE_IMAGES; ?>dash_icon.png"  border="none" />&nbsp;&nbsp;DASHBOARD</a></h1>
    <hr />

    <div class="nav"><img src="<?php echo SITE_IMAGES; ?>nav_icon.png" /><a href="#">Manage Users</a>
        <ul>
            <li><a href="add-user.php">Add User</a></li>
            <li><a href="view-user.php">View User list</a></li>

        </ul>
    </div>
    <div class="nav"><img src="<?php echo SITE_IMAGES; ?>nav_icon.png" /><a href="#">Manage Appointments</a>
        <ul>
            <?php if ($_SESSION['Product_pl'] == 1 || $_SESSION["UserType"] == 1) { ?>
                <li><a href="pl-assign-to.php">Assign for Pickup (Personal Loan) </a></li>              
            <?php } ?>
            <?php if ($_SESSION['Product_hl'] == 1) { ?>
                <li><a href="hl-assign-to.php">Assign for Pickup (Home Loan) </a></li>              
            <?php } ?>
            <?php if ($_SESSION['Product_cl'] == 1) { ?>
                <li><a href="cl-assign-to.php">Assign for Pickup (Car Loan) </a></li>              
            <?php } ?>
            <?php if ($_SESSION['Product_cc'] == 1) { ?>
                <li><a href="cc-assign-to.php">Assign for Pickup (Credit Card) </a></li>              
            <?php } ?>
            <?php if ($_SESSION['Product_bl'] == 1) { ?>
                <li><a href="bl-assign-to.php">Assign for Pickup (Business Loan) </a></li>              
            <?php } ?>
            <?php if ($_SESSION['Product_lap'] == 1) { ?>
                <li><a href="lap-assign-to.php">Assign for Pickup (Loan Against Property) </a></li>              
            <?php } ?>
        </ul>
    </div>
    <div class="nav"><img src="<?php echo SITE_IMAGES; ?>nav_icon.png" /><a href="#">Manage Documents</a>
        <ul>
            <?php if ($_SESSION['Product_pl'] == 1 || $_SESSION["UserType"] == 1) { ?>
                <li><a href="pl_document_picked.php">Document Picked (Personal Loan)</a></li>
            <?php } ?>
            <?php if ($_SESSION['Product_hl'] == 1) { ?>
                <li><a href="hl_document_picked.php">Document Picked (Home Loan)</a></li>
            <?php } ?>
            <?php if ($_SESSION['Product_cl'] == 1) { ?>
                <li><a href="cl_document_picked.php">Document Picked (Car Loan)</a></li>          
            <?php } ?>
            <?php if ($_SESSION['Product_cc'] == 1) { ?>
                <li><a href="cc_document_picked.php">Document Picked (Credit Card)</a></li>          
            <?php } ?>
            <?php if ($_SESSION['Product_bl'] == 1) { ?>
                <li><a href="bl_document_picked.php">Document Picked (Business Loan)</a></li>          
            <?php } ?>
            <?php if ($_SESSION['Product_lap'] == 1) { ?>
                <li><a href="lap_document_picked.php">Document Picked (Loan Against Property)</a></li>
            <?php } ?>


        </ul>
    </div>

    <hr />

    <div class="nav"><img src="<?php echo SITE_IMAGES; ?>nav_icon.png" /><a href="#">General</a>
        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>