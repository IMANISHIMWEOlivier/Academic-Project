<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ride_hailing";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details (assuming user ID 9 is hardcoded for now)
$sql = "SELECT * FROM users WHERE id = 9";  // Replace 9 with session user ID for dynamic content
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();

// Save a new message (if POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chat (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
    if ($stmt->execute()) {
        echo "Message sent!";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link rel="stylesheet" href="indexstyle.css">
    <link rel="stylesheet" href="profilestyle.css">
    <link rel="stylesheet" href="chatstyle.css">
</head>
<body>
<!-- <h1><?//php echo"<script>alert('". $greeting ."');</script>"; ?></h1> -->


    <!-- Navigation Bar -->
    <nav class="navbar">
    <div class="logo">
        <a href="index.php"><img src="uploads/g0000.png" alt="Logo"></a>
    </div>
    <ul class="nav-links">
        <li><a href="dashmotor.php">Profile</a></li>
        <li><a href="#contact">Massege</a></li>
        <li><a href="logout.php" class="login-btn">Logout</a></li>
    </ul>
    <div class="hamburger">&#9776;</div>
</nav>
      <!-- profile and chart -->
      <div class="container">
    <!-- Profile Section -->
    <div class="profile">
        <h1>Motorist Profile</h1>
        <div class="profile-picture">
            <?php if (!empty($user['profile_picture'])): ?>
                <img src="uploads/<?php echo $user['profile_picture']; ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="default-profile.png" alt="Default Profile Picture"> <!-- Default if no picture -->
            <?php endif; ?>
        </div>
        <div class="profile-info">
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
            <p><strong>Sex:</strong> <?php echo htmlspecialchars($user['sex']); ?></p>
            <p><strong>National ID:</strong> <?php echo htmlspecialchars($user['national_id']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>Language:</strong> <?php echo htmlspecialchars($user['language']); ?></p>
            <p><strong>Emergency Contact:</strong> <?php echo htmlspecialchars($user['emergency_contact']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>User Type:</strong> <?php echo htmlspecialchars($user['user_type']); ?></p>
            <a href="dashmotor.php">Edit</a>
        </div>
    </div>

    <!-- Chat Section -->
    <div class="chat-container">
        <h1>Chat</h1>
        <div class="chat-box" id="chat-box">
            <!-- Messages will be loaded here -->
        </div>
        
        <form id="chat-form">
            <input type="hidden" id="sender_id" value="1"> <!-- Passenger or motorist's ID -->
            <input type="hidden" id="receiver_id" value="2"> <!-- Motorist or passenger's ID -->
            <textarea id="message" placeholder="Type your message..."></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
</div>
  


    <!-- Hero 1 Section -->
    <section class="hero">
        <div class="hero-text">

            
            
        </div>
        </section>
          <br><br><br><br>
<!--- service section --->
<?php
//include"motorcyclistdecription.php";
?>
<!--- about section --->

    

            <!-- Emergency Contacts -->
            <div class="column emergency-contacts">
                <h2>Emergency Contacts</h2>
                <ul>
                    <li><strong>Company Email:</strong> support@motorcycleapp.com</li>
                    <li><strong>Police Emergency Contact:</strong> 112</li>
                    <li><strong>RURA Contact:</strong> +250 788 155 100</li>
                </ul>
            </div>
        </div>
    </div>
</section>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            
        
        <p>&copy; 2024 Real-time Motorcycle Ride-Hailing System. All rights reserved.</p>
    
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<ul class="social-icons">
    <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>

    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>

    <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
</ul>

        </div>
    </footer>

    <script src="indexscript.js"></script>
    <script src="chat.js"></script>
</body>
</html>




