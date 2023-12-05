<?php 
session_start();
include 'connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
$query = mysqli_query($conn, $sql);
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['role'] == 'admin') {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        header("Location: ../admin.php");
        
    } else {
        $_SESSION['id'] = $row['id'];

        //Relasi
        $idwali = $row['id_wali'];
        $sql2 = "SELECT * FROM wali WHERE id = '$idwali'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $_SESSION['nama_wali'] = $row2['nama'];

        header("Location: ../murid.php");
    }
} else {
    echo "email atau password salah";
}

$conn->close();
?>