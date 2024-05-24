<?php
session_start();
include "../database/connection.php";

$user_id = $_SESSION['user_id'];

// Fetch the current user information
$query = "SELECT * FROM login_twitter WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update the user information in the database
    $update_query = "UPDATE login_twitter SET username = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $username, $email, $user_id);

    if ($update_stmt->execute()) {
        // Redirect to home.php after successful update
        header("Location: ../home.php");
        exit();
    } else {
        $error_message = "Failed to update profile. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit Profile</h1>
        <?php if (isset($error_message)): ?>
            <p class="bg-red-100 text-red-700 p-2 rounded mb-4"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="profile.php">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-2">Full Name:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-200">Save Changes</button>
        </form>
        <a href="../home.php" class="block text-center text-blue-500 mt-4 hover:underline">Back to Home</a>
    </div>
</body>
</html>
