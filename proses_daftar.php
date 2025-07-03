<?php
//memanggil data user dari user.txt
$users =[];
$data_file = "users.txt";
if (file_exists($data_file)){
    $UserData = file($data_file,
    FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($UserData as $line){
    $user =json_encode($line,true);
    if($user!==null){
        $users[] =$user;
        }
    }
}
//Mengambil data dari halaman daftar
if ($_SERVER["REQUEST_METHOD"] =="POST"){
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $notlp = $_POST["notlp"];
    $password = password_hash($_POST["password"],
    PASSWORD_DEFAULT);
//cek apakah username sudah ada
$usersExists = false;
foreach($users as $user){
    if (isset($user["email"]) || isset($user["username"]) && ($user["email"] == $email || $user["username"] == $username)) {
$usersExists = true;
break;
    }
}


if ($usersExists) {
    echo "<script> alert('Username atau Email sudah ada'); window.location.href='daftar.php';</script>";
    exit();
}
//simpan user ke dalam file
$newUser = [
    "username" => $username,
    "fullname" => $fullname,
    "email" => $email,
    "no_tlp" => $notlp,
    "password" => $password,
];


$users[] = $newUser;
$userDataToFile="";
foreach ($users as $user){
    $userDataToFile .= json_encode($user,true)."\n";
}


file_put_contents($data_file,$userDataToFile);


echo"<script>alert('Registrasi Berhasil Tersimpan'); window.location.href='login.php';</script>";
}
?>
