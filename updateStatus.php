<?php
require "connection_db.php";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Find the selected job by ID
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($job) {
        // Toggle the status (example: change 'active' to 'inactive' and vice versa)
        $newStatus = $job['status'] == 'active' ? 'closed' : 'active';
        
        // Update the status in the database
        $stmt = $pdo->prepare("UPDATE jobs SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Redirect back to the previous page or display a success message
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // job not found
        echo "job not found.";
    }
}
?>
