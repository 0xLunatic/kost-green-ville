<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['permission'])) {
    header("Location: ../administrator/login.php");
    exit;
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../administrator/login.php");
    exit;
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2 class="sidebar-title">Admin Tools</h2>
            <ul class="sidebar-menu">
                <li><a href="#account">Account</a></li>
                <li><a href="#order">Order</a></li>
                <li><a href="#comment">Comment</a></li>
                <li><a href="?logout=true">Logout</a></li>
            </ul>
        </div>
        <div class="content" id="content">
            <h1>Admin Panel</h1>
            <br>
            <br>
            <!-- Initial content -->
            <div id="account" class="section">
                <h2>Account Table</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Permission</th>
                            <th>Action</th>
                            <th>Set Permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database configuration file
                        require_once 'dbconfig.php';

                        // Fetch account data from the database
                        $sql = "SELECT * FROM account";
                        $result = $db->query($sql);

                        // Populate the account data in the table
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>" . $row['permission'] . "</td>";
                                echo "<td><button onclick=\"deleteAccount('" . $row['id'] . "')\">X</button></td>";
                                echo "<td><button onclick=\"setPermission('" . $row['id'] . "')\">P</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="order" class="section">
                <h2>Order Table</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>ID Card</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Room Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database configuration file
                        require_once 'dbconfig.php';

                        // Fetch order data from the database
                        $sql = "SELECT * FROM `order`";
                        $result = $db->query($sql);

                        // Populate the order data in the table
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['id_card'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone_number'] . "</td>";
                                echo "<td>" . $row['room_type'] . "</td>";
                                echo "<td><button onclick=\"deleteOrder('" . $row['id'] . "')\">X</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="comment" class="section">
                <h2>Comment Table</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'dbconfig.php';

                        $sql = "SELECT * FROM comment";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['message'] . "</td>";
                                echo "<td><button onclick=\"deleteComment('" . $row['id'] . "')\">X</button></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteAccount(accountId) {
            // Send an AJAX request to delete the account
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_account.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Refresh the page after successful deletion
                    location.reload();
                }
            };
            xhr.send("accountId=" + accountId);
        }

        function setPermission(accountId) {
            // Send an AJAX request to delete the account
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "account_permission.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Refresh the page after successful deletion
                    location.reload();
                }
            };
            xhr.send("accountId=" + accountId);
        }

        function deleteOrder(orderId) {
            // Send an AJAX request to delete the order
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_order.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Refresh the page after successful deletion
                    location.reload();
                }
            };
            xhr.send("orderId=" + orderId);
        }

        function deleteComment(commentId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_comment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send("commentId=" + commentId);
        }
    </script>
</body>

</html>