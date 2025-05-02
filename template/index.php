<?php
// Example: fetch user with ID = 1
$conn = new mysqli("localhost", "root", "", "ecarga");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = 1;
$sql = "SELECT name, avatar_url FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $avatar_url);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ECARGA</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="header-left">
      <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="flag" alt="App Logo" />
      <h1>E<span>CARGA</span> <span class="beta">TM</span></h1>
    </div>
  </header>

  <main>
    <section class="welcome">
      <img src="<?php echo htmlspecialchars($avatar_url); ?>" class="profile-pic" alt="Profile">
      <h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
      <p>Ready to book your next service?</p>
    </section>

    <section class="services">
      <div class="service"><img src="image/Graphicloads-100-Flat-2-Bus.64.png"><span>Vehicle</span></div>
      <div class="service"><img src="image/Icons8-Windows-8-Transport-Driver.64.png"><span>Drivers</span></div>
      <div class="service"><img src="image/Icons8-Windows-8-Very-Basic-Rating.64.png"><span>Ratings</span></div>
    </section>

    <section class="booking-banner">
      <h3>Book Now</h3>
      <p>Select a service and schedule your appointment.</p>
      <button class="book-btn">Start Booking</button>
    </section>
  </main>

  <footer>
    <div class="nav"><a href="home.php"><span>🏠</span><p>Home</p></a></div>
    <div class="nav"><a href="bookings.php"><span>📅</span><p>Bookings</p></a></div>
    <div class="nav"><a href="history.php"><span>📜</span><p>History</p></a></div>
    <div class="nav"><a href="profile.php"><span>👤</span><p>Profile</p></a></div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
