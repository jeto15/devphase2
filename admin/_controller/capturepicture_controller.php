<?php
session_start();
require '../.config/db.php';
include '../_model/capturepicture_model.php';  


$capturePictureClass =  new CapturePictureModel();
 
// Handle JSON data sent from client
$data = json_decode(file_get_contents("php://input"), true);

  
$imageData = $data['image'];

// Decode base64 image data and save as file
$imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
$imageData = str_replace(' ', '+', $imageData);
$imageData = base64_decode($imageData);
$fileName = uniqid() . '.jpg'; // Generate unique filename

 
$directory = "../uploads/pid".$data['patientid'];

if (!file_exists($directory)) {
    if (mkdir($directory, 0777, true)) {
        echo "Directory created successfully.";
    } else {
        echo "Failed to create directory.";
    }
} else {
    echo "Directory already exists.";
}

$fileLocation = $directory.'/' . $fileName;



echo $fileLocation;
file_put_contents($fileLocation, $imageData);
 
  
$description = "Some description";
$isAvatar = "Yes";
$type = "image/jpeg";
$name = $fileName;  
$patient_id = $data['patientid'];

// Prepare the SQL statement
$stmt = $db->prepare("INSERT INTO patient_file_library (description, isAvatar, type, name, patient_id) VALUES (?, ?, ?, ?, ?)");

if ($stmt) {
    // Bind the parameters (ensure they are variables)
    $stmt->bind_param("ssssi", $description, $isAvatar, $type, $name, $patient_id);

    // Execute the statement
    $stmt->execute();

    // Close the statement
    $stmt->close();
} else {
    // Handle error
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

echo "Image uploaded successfully.";