<?php
session_start();
include('../database/connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ./components/home.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$msg = "";

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM login_twitter WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Basic validation
    if (empty($username) || empty($email)) {
        $msg = "Username and email are required.";
    } else {
        // Update the user's profile
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, bio = ? WHERE id = ?");
        if ($stmt->execute([$username, $email, $bio, $user_id])) {
            $msg = "Profile updated successfully!";
        } else {
            $msg = "Failed to update profile.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <?php if ($msg): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        
        <label for="bio">Bio:</label>
        <textarea name="bio" id="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea><br>
        
        <label for="profile_pic">Profile Picture:</label>
        <input type="file" name="profile_pic" id="profile_pic"><br>
        
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
