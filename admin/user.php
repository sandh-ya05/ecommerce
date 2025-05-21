<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
<div class="content">
<?php
// Include database connection
include('./includes/db.php');

// Fetch user data from the users table
$query = "
    SELECT user_id, user_name 
    FROM php_project.users
";
$result = mysqli_query($conn, $query);

// Check for any errors in fetching data
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Delete user if delete button is pressed
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete_query = "DELETE FROM php_project.users WHERE user_id = $user_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

// Handle the edit form submission
if (isset($_POST['edit'])) {
    // Get the updated values from the form
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];

    // Update the user in the database
    $update_query = "
        UPDATE php_project.users 
        SET user_name = '$user_name' 
        WHERE user_id = $user_id
    ";

    if (mysqli_query($conn, $update_query)) {
        // If update is successful, show a success message and reload the page
        echo "<script>
                alert('User updated successfully.');
                window.location.href = 'user.php';  // Reload the page to show updated data
              </script>";
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Dashboard</title>
    <style>
        /* Basic styles for the page, table, and modal */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            margin: 5px;
            cursor: pointer;
        }

        a:hover {
            background-color: #45a049;
        }

        /* Edit Modal Styling */
        #editModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }

        #editModal h3 {
            margin-bottom: 15px;
        }

        #editModal form {
            display: flex;
            flex-direction: column;
        }

        #editModal input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #editModal input[type="submit"], #editModal button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }

        #editModal input[type="submit"]:hover, #editModal button:hover {
            background-color: #45a049;
        }

        /* Overlay Background */
        #editModal::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>
<body>

    <h2>User List</h2>
    
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td>
                    <!-- Edit Button -->
                    <a href="#" onclick="editUser(<?php echo $row['user_id']; ?>, '<?php echo $row['user_name']; ?>')">Edit</a>
                    
                    <!-- Delete Button -->
                    <a href="user.php?delete=<?php echo $row['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Edit User Modal -->
    <div id="editModal">
        <h3>Edit User</h3>
        <form method="POST">
            <input type="hidden" name="user_id" id="edit_user_id">
            <label>User Name:</label>
            <input type="text" name="user_name" id="edit_user_name" required><br><br>
            <input type="submit" name="edit" value="Update User">
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>

    <script>
        function editUser(user_id, user_name) {
            // Populate the modal with the current data
            document.getElementById('edit_user_id').value = user_id;
            document.getElementById('edit_user_name').value = user_name;

            // Show the modal
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
</div>
<?php include('includes/footer.php'); ?>