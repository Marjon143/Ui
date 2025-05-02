<?php
session_start();
include('db_connection.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: profile.php'); // Redirect to login if not logged in
    exit();
}

// Fetch the user's data from the database using their user ID
$user_id = $_SESSION['user_id']; // Assume the user ID is stored in session
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Include Bootstrap CSS (optional, can also use CDN for convenience) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Profile Information</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Welcome, <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>!</h4>

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <?php if ($user['profile_picture']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="img-fluid rounded-circle" width="150" height="150">
                            <?php else: ?>
                                <img src="uploads/default-avatar.png" alt="Default Profile Picture" class="img-fluid rounded-circle" width="150" height="150">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
                            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (optional, for responsive behavior) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
