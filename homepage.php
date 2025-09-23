<?php
session_start();
include("connect.php");

$showForm = false;


// Dito yung code sa may edit function, ito yung nag cacall ng data papunta sa may welcome container (Forms)
if (isset($_GET['edit_id'])) {
    // Get the edit_id from the URL (GET parameter)
    $edit_id = intval($_GET['edit_id']);

    // Fetch the user data from the database based on the `edit_id`
    $query = "SELECT * FROM inventory WHERE id = $edit_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        // If the user data is found, populate the form with this data
    } else {
        echo "Record not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="homepagestyle.css">

</head>

<!-- User Profile Header -->
<div class="user-header">
    <div class="user-profile">
        <div class="user-info">
            <div class="user-avatar">
                <?php
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                    $user = mysqli_fetch_array($query);
                    echo strtoupper(substr($user['firstName'], 0, 1) . substr($user['lastName'], 0, 1));
                }
                ?>
            </div>
            <div class="user-details">
                <h3>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "Welcome, " . $user['firstName'] . ' ' . $user['lastName'];
                    }
                    ?>
                </h3>
                <p><i class="fas fa-envelope"></i> <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>
            </div>
        </div>
        <div class="user-actions">
            <a href="logout.php" class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>
</div>


<div class="action-buttons">
    <button id="showTableBtn" class="action-btn btn-table">Table of Inventories</button>
    <button id="showFormBtn" class="action-btn btn-insert">Insert Data</button>
</div>

<!-- Pag pindot mo ng Table of Inventories button, magbubukas ang Container na ito -->
<div class="container" id="inventoryTable">
    <h2>List of Users in Inventory</h2>

    <!-- Department Filter Dropdown -->
    <div id="filterContainer">
        <select id="departmentFilter">
            <option value="">-- Filter by Department --</option>
            <option value="AO">AO</option>
            <option value="AO-PAD">AO-PAD</option>
            <option value="AGSD-DO">AGSD-DO</option>
            <option value="AGSD-GSD">AGSD-GSD</option>
            <option value="AGSD-HRDSD">AGSD-HRDSD</option>
            <option value="CPMSD-DO">CPMSD-DO</option>
            <option value="CPMSD-CPD">CPMSD-CPD</option>
            <option value="CPMSD-ICTSD">CPMSD-ICTSD</option>
            <option value="FD">FD</option>
            <option value="IAD">IAD</option>
            <option value="LAD">LAD</option>
            <option value="OAAFA">OAAFA</option>
            <option value="OAAO">OAAO</option>
            <option value="OCD-DO">OCD-DO</option>
            <option value="OCD-TSD">OCD-TSD</option>
            <option value="ODA">ODA</option>
            <option value="COA">COA</option>
        </select>


        <!-- Updated search bar -->
        <input type="text" id="searchInput" placeholder="Search Name or IP Address...">
    </div>

    <!-- ito yung display ng table sa mga list of users na na-encode -->
    <div class="table-wrapper">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Name of User</th>
                    <!-- No need to show IP address header -->
                </tr>
            </thead>

            <tbody>
                <?php
                $query = "SELECT id, nameofuser, department, ipaddress FROM inventory ORDER BY id DESC";

                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr data-department='" . htmlspecialchars($row['department']) . "' data-ip='" . htmlspecialchars($row['ipaddress']) . "'>
        <td><a href='homepage.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['nameofuser']) . "</a></td>
      </tr>";
                    }
                } else {
                    echo "<tr><td>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pag click mo sa kahit sinong users, mag sho-show yung full details of inventories nya -->
<?php
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM inventory WHERE id = $user_id");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        echo "<div id='inventoryDetails' class='container'>
                <a href='homepage.php?show=table' style='position: absolute; top: 10px; right: 20px; font-size: 22px; color: red; text-decoration: none;' title='Close'>&times;</a>
                <h2>Inventory Details for " . htmlspecialchars($data['nameofuser']) . "</h2>
                <table border='1' cellpadding='8' cellspacing='0'>";

        foreach ($data as $key => $value) {
            if ($key === 'id') continue; // Exclude ID
            $label = ucwords(str_replace("_", " ", $key));
            echo "<tr><th>$label</th><td>" . htmlspecialchars($value) . "</td></tr>";
        }

        echo "</table>";

        // Action Buttons Container
        echo '<div class="record-actions">';

        // DELETE BUTTON
        echo '<form method="POST" action="delete.php" class="delete-form" onsubmit="return confirm(\'Are you sure you want to delete this record?\');">
                <input type="hidden" name="delete_id" value="' . htmlspecialchars($data['id']) . '">
                <button type="submit" class="delete-btn">
                    Delete Record
                </button>
            </form>';

        // 👇 INSERT EDIT FORM HERE
        echo '<form action="homepage.php" method="GET" class="edit-form">
                <input type="hidden" name="edit_id" value="' . htmlspecialchars($data['id']) . '">
                <button type="submit" class="edit-btn">
                    Edit Record
                </button>
            </form>';

        echo '</div>'; // Close record-actions
        echo "</div>"; // Close inventoryDetails
    } else {
        echo "<div class='container'><p style='color:#ff4757; text-align:center; font-weight:500;'><i class='fas fa-exclamation-triangle'></i> No details found for the selected user.</p></div>";
    }
}
?>



<div class="container" id="welcome" style="display: none;">
    <h1 class="form-title">NETWORK MONITORING AND INVENTORY</h1>
    <!-- Form -->
    <form id="inventoryForm" method="POST" action="submithandler.php">
        <div class="form-columns">
            <!-- Column 1 -->
            <div class="form-column">
                <div class="input-group">
                    <label for="nameofuser">Name of User</label>
                    <input type="text" name="nameofuser" id="nameofuser" placeholder="Full Name"
                        value="<?php echo isset($userData['nameofuser']) ? htmlspecialchars($userData['nameofuser']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="department">Department - Division</label>
                    <select name="department" id="department" required>

                        <option value="AO" <?php echo (isset($userData['department']) && $userData['department'] == 'AO') ? 'selected' : ''; ?>>AO</option>
                        <option value="AO-PAD" <?php echo (isset($userData['department']) && $userData['department'] == 'AO-PAD') ? 'selected' : ''; ?>>AO-PAD</option>
                        <option value="AGSD" <?php echo (isset($userData['department']) && $userData['department'] == 'AGSD') ? 'selected' : ''; ?>>AGSD-DO</option>
                        <option value="AGSD-GSD" <?php echo (isset($userData['department']) && $userData['department'] == 'AGSD-GSD') ? 'selected' : ''; ?>>AGSD-GSD</option>
                        <option value="AGSD-HRDSD" <?php echo (isset($userData['department']) && $userData['department'] == 'AGSD-HRDSD') ? 'selected' : ''; ?>>AGSD-HRDSD</option>
                        <option value="CPMSD-DO" <?php echo (isset($userData['department']) && $userData['department'] == 'CPMSD-DO') ? 'selected' : ''; ?>>CPMSD-DO</option>
                        <option value="CPMSD-CPD" <?php echo (isset($userData['department']) && $userData['department'] == 'CPMSD-CPD') ? 'selected' : ''; ?>>CPMSD-CPD</option>
                        <option value="CPMSD-ICTSD" <?php echo (isset($userData['department']) && $userData['department'] == 'CPMSD-ICTSD') ? 'selected' : ''; ?>>CPMSD-ICTSD</option>
                        <option value="FD" <?php echo (isset($userData['department']) && $userData['department'] == 'FD') ? 'selected' : ''; ?>>FD</option>
                        <option value="IAD" <?php echo (isset($userData['department']) && $userData['department'] == 'IAD') ? 'selected' : ''; ?>>IAD</option>
                        <option value="LAD" <?php echo (isset($userData['department']) && $userData['department'] == 'LAD') ? 'selected' : ''; ?>>LAD</option>
                        <option value="OAAFA" <?php echo (isset($userData['department']) && $userData['department'] == 'OAAFA') ? 'selected' : ''; ?>>OAAFA</option>
                        <option value="OAAO" <?php echo (isset($userData['department']) && $userData['department'] == 'OAAO') ? 'selected' : ''; ?>>OAAO</option>
                        <option value="OCD" <?php echo (isset($userData['department']) && $userData['department'] == 'OCD') ? 'selected' : ''; ?>>OCD-DO</option>
                        <option value="OCD-TSD" <?php echo (isset($userData['department']) && $userData['department'] == 'OCD-TSD') ? 'selected' : ''; ?>>OCD-TSD</option>
                        <option value="ODA" <?php echo (isset($userData['department']) && $userData['department'] == 'ODA') ? 'selected' : ''; ?>>ODA</option>
                        <option value="COA" <?php echo (isset($userData['department']) && $userData['department'] == 'COA') ? 'selected' : ''; ?>>COA</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="desig">Position / Designation</label>
                    <input type="text" name="desig" id="desig"
                        value="<?php echo isset($userData['desig']) ? htmlspecialchars($userData['desig']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="employmentstatus">Employment Status</label>
                    <select name="employmentstatus" id="employmentstatus" required>
                        <option value="Permanent" <?php echo (isset($userData['employmentstatus']) && $userData['employmentstatus'] == 'Permanent') ? 'selected' : ''; ?>>Permanent</option>
                        <option value="Allied" <?php echo (isset($userData['employmentstatus']) && $userData['employmentstatus'] == 'Allied') ? 'selected' : ''; ?>>Allied</option>
                        <option value="Contract of Service" <?php echo (isset($userData['employmentstatus']) && $userData['employmentstatus'] == 'Contract of Service') ? 'selected' : ''; ?>>Contract of Service</option>
                        <option value="Job Order" <?php echo (isset($userData['employmentstatus']) && $userData['employmentstatus'] == 'Job Order') ? 'selected' : ''; ?>>Job Order</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="accountable">Accountable User</label>
                    <input type="text" name="accountable" id="accountable"
                        value="<?php echo isset($userData['accountable']) ? htmlspecialchars($userData['accountable']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="ipaddress">IP Address</label>
                    <input type="text" name="ipaddress" id="ipaddress"
                        value="<?php echo isset($userData['ipaddress']) ? htmlspecialchars($userData['ipaddress']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="macaddress">MAC Address</label>
                    <input type="text" name="macaddress" id="macaddress"
                        value="<?php echo isset($userData['macaddress']) ? htmlspecialchars($userData['macaddress']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="typeofdevice">Type of Device</label>
                    <select name="typeofdevice" id="typeofdevice" required>
                        <option value="Desktop" <?php echo (isset($userData['typeofdevice']) && $userData['typeofdevice'] == 'Desktop') ? 'selected' : ''; ?>>Desktop</option>
                        <option value="laptop" <?php echo (isset($userData['typeofdevice']) && $userData['typeofdevice'] == 'laptop') ? 'selected' : ''; ?>>Laptop</option>
                        <option value="Video Conferencing System" <?php echo (isset($userData['typeofdevice']) && $userData['typeofdevice'] == 'Video Conferencing System') ? 'selected' : ''; ?>>Video Conferencing System</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="computername">Computer Name</label>
                    <input type="text" name="computername" id="computername"
                        value="<?php echo isset($userData['computername']) ? htmlspecialchars($userData['computername']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="operatingsystem">Operating System</label>
                    <select name="operatingsystem" id="operatingsystem" required>
                        <option value="Windows 11" <?php echo (isset($userData['operatingsystem']) && $userData['operatingsystem'] == 'Windows 11') ? 'selected' : ''; ?>>Windows 11</option>
                        <option value="Windows 10" <?php echo (isset($userData['operatingsystem']) && $userData['operatingsystem'] == 'Windows 10') ? 'selected' : ''; ?>>Windows 10</option>
                        <option value="Windows 8" <?php echo (isset($userData['operatingsystem']) && $userData['operatingsystem'] == 'Windows 8') ? 'selected' : ''; ?>>Windows 8</option>
                        <option value="Windows 7" <?php echo (isset($userData['operatingsystem']) && $userData['operatingsystem'] == 'Windows 7') ? 'selected' : ''; ?>>Windows 7</option>
                        <option value="Windows XP" <?php echo (isset($userData['operatingsystem']) && $userData['operatingsystem'] == 'Windows XP') ? 'selected' : ''; ?>>Windows XP</option>
                        <option value="Macintosh" <?php echo (isset($userData['operatingsystem']) && $userData['operatingsystem'] == 'Macintosh') ? 'selected' : ''; ?>>Macintosh</option>
                    </select>
                </div>
                <br>
                <p><input type="button" class="btn" value="Preview" id="previewButton"> </p>
            </div>

            <!-- Column 2 -->
            <div class="form-column">
                <div class="input-group">
                    <label for="ssid">SSID</label>
                    <select name="ssid" id="ssid" required>
                        <option value="NFACOWLNET" <?php echo (isset($userData['ssid']) && $userData['ssid'] == 'NFACOWLNET') ? 'selected' : ''; ?>>NFACOWLNET</option>
                        <option value="NFABYOD" <?php echo (isset($userData['ssid']) && $userData['ssid'] == 'NFABYOD') ? 'selected' : ''; ?>>NFABYOD</option>
                        <option value="NFAFreePublicWifi" <?php echo (isset($userData['ssid']) && $userData['ssid'] == 'NFAFreePublicWifi') ? 'selected' : ''; ?>>NFAFreePublicWifi</option>
                        <option value="Wired" <?php echo (isset($userData['ssid']) && $userData['ssid'] == 'Wired') ? 'selected' : ''; ?>>Wired</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="ppsk">PPSK</label>
                    <input type="text" name="ppsk" id="ppsk"
                        value="<?php echo isset($userData['ppsk']) ? htmlspecialchars($userData['ppsk']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="pass">Password</label>
                    <input type="text" name="pass" id="pass"
                        value="<?php echo isset($userData['pass']) ? htmlspecialchars($userData['pass']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="domain">Domain User Name</label>
                    <input type="text" name="domain" id="domain"
                        value="<?php echo isset($userData['domain']) ? htmlspecialchars($userData['domain']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="property">Property Code</label>
                    <input type="text" name="property" id="property"
                        value="<?php echo isset($userData['property']) ? htmlspecialchars($userData['property']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="brand">Brand</label>
                    <select name="brand" id="brand" required>
                        <option value="ACER" <?php echo (isset($userData['brand']) && $userData['brand'] == 'ACER') ? 'selected' : ''; ?>>ACER</option>
                        <option value="HP" <?php echo (isset($userData['brand']) && $userData['brand'] == 'HP') ? 'selected' : ''; ?>>HP</option>
                        <option value="APPLE" <?php echo (isset($userData['brand']) && $userData['brand'] == 'APPLE') ? 'selected' : ''; ?>>APPLE</option>
                        <option value="HUWAWEI" <?php echo (isset($userData['brand']) && $userData['brand'] == 'HUWAWEI') ? 'selected' : ''; ?>>HUWAWEI</option>
                        <option value="DELL" <?php echo (isset($userData['brand']) && $userData['brand'] == 'DELL') ? 'selected' : ''; ?>>DELL</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="model">Model</label>
                    <select name="model" id="model" required>
                        <option value="Veriton X26656" <?php echo (isset($userData['model']) && $userData['model'] == 'Veriton X26656') ? 'selected' : ''; ?>>Veriton X26656</option>
                        <option value="Veriton M2640G" <?php echo (isset($userData['model']) && $userData['model'] == 'Veriton M2640G') ? 'selected' : ''; ?>>Veriton M2640G</option>
                        <option value="Prodesk 400 G3 SFF" <?php echo (isset($userData['model']) && $userData['model'] == 'Prodesk 400 G3 SFF') ? 'selected' : ''; ?>>Prodesk 400 G3 SFF</option>
                        <option value="OPTIPLEX 5090" <?php echo (isset($userData['model']) && $userData['model'] == 'OPTIPLEX 5090') ? 'selected' : ''; ?>>OPTIPLEX 5090</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="serial">Serial Number</label>
                    <input type="text" name="serial" id="serial"
                        value="<?php echo isset($userData['serial']) ? htmlspecialchars($userData['serial']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="endpoint">End-Point</label>
                    <select name="endpoint" id="endpoint" required>
                        <option value="Kaspersky Anti-Virus (Managed by Server)" <?php echo (isset($userData['endpoint']) && $userData['endpoint'] == 'Kaspersky Anti-Virus (Managed by Server)') ? 'selected' : ''; ?>>Kaspersky Anti-Virus (Managed by Server)</option>
                        <option value="Kaspersky Anti-Virus (Unmanaged by Server)" <?php echo (isset($userData['endpoint']) && $userData['endpoint'] == 'Kaspersky Anti-Virus (Unmanaged by Server)') ? 'selected' : ''; ?>>Kaspersky Anti-Virus (Unmanaged by Server)</option>
                        <option value="No Installed Anti-Virus" <?php echo (isset($userData['endpoint']) && $userData['endpoint'] == 'No Installed Anti-Virus') ? 'selected' : ''; ?>>No Installed Anti-Virus</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="microsoftoffice">Microsoft Office</label>
                    <select name="microsoftoffice" id="microsoftoffice" required>
                        <option value="Microsoft Office 2010" <?php echo (isset($userData['microsoftoffice']) && $userData['microsoftoffice'] == 'Microsoft Office 2010') ? 'selected' : ''; ?>>Microsoft Office 2010</option>
                        <option value="Microsoft Office 2019" <?php echo (isset($userData['microsoftoffice']) && $userData['microsoftoffice'] == 'Microsoft Office 2019') ? 'selected' : ''; ?>>Microsoft Office 2019</option>
                        <option value="Microsoft Office 2020" <?php echo (isset($userData['microsoftoffice']) && $userData['microsoftoffice'] == 'Microsoft Office 2020') ? 'selected' : ''; ?>>Microsoft Office 2020</option>
                    </select>
                </div>
                <br>
                <p><input type="button" class="btn" value="Clear" id="clearButton"></p>

            </div>

        </div>
    </form>

</div>

<!-- Modal -->
<div id="dataPreviewModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Preview your data before submitting:</h2>
        <p><strong>Name of User:</strong> <span id="previewName"></span></p>
        <p><strong>Department:</strong> <span id="previewDepartment"></span></p>
        <p><strong>Position/Designation:</strong> <span id="previewDesig"></span></p>
        <p><strong>Employment Status:</strong> <span id="previewEmploymentStatus"></span></p>
        <p><strong>Accountable User:</strong> <span id="previewAccountable"></span></p>
        <p><strong>IP Address:</strong> <span id="previewIP"></span></p>
        <p><strong>MAC Address:</strong> <span id="previewMAC"></span></p>
        <p><strong>Type of Device:</strong> <span id="previewDevice"></span></p>
        <p><strong>Computer Name:</strong> <span id="previewComputerName"></span></p>
        <p><strong>Operating System:</strong> <span id="previewOperatingSystem"></span></p>
        <p><strong>SSID:</strong> <span id="previewSSID"></span></p>
        <p><strong>PPSK:</strong> <span id="previewPPSK"></span></p>
        <p><strong>Password:</strong> <span id="previewPass"></span></p>
        <p><strong>Domain User Name:</strong> <span id="previewDomain"></span></p>
        <p><strong>Property Code:</strong> <span id="previewProperty"></span></p>
        <p><strong>Brand:</strong> <span id="previewBrand"></span></p>
        <p><strong>Model:</strong> <span id="previewModel"></span></p>
        <p><strong>Serial:</strong> <span id="previewSerial"></span></p>
        <p><strong>End-Point:</strong> <span id="previewEndpoint"></span></p>
        <p><strong>Microsoft Office:</strong> <span id="previewMicrosoftOffice"></span></p>
        <br>
        <p>
            <button id="submitDataButton" class="button">Save</button>
            <button id="editDataButton" class="button">Edit</button>
        </p>

        <script src="modal.js"></script>


        <!-- pag click mo ng edit button in the inventory table section, automatically mag sho-show yung forms together with the populated data of the selected name of user -->
        <?php if (isset($_GET['edit_id'])): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('welcome').style.display = 'block';
                    document.getElementById('inventoryTable').style.display = 'none';
                });
            </script>
        <?php endif; ?>
        </body>

</html>