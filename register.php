<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container{
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 50%;
        }
        h1{
            text-align: center;
            color:rgb(255, 119, 0);
            margin-bottom: 30px;
        }
        .form-label{
            font-weight: bold;
            display: inline-block;
            width: 120px;
            text-align: right;
            margin-right: 15px;
        }
        .form-control {
            display: inline-block;
            width: calc(100% - 140px);
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .btn-orange {
            background-color: rgb(255, 119, 0);
            border-color: rgb(255, 119, 0);
            color: white;
        }
        .btn-orange:hover {
            background-color: rgb(235, 109, 0);
            border-color: rgb(235, 109, 0);
            color: white;
        }
        .button-container {
            padding-left: 135px;
        }
    </style>
  </head>
  <body>
    <div class="container">
    <h1>Halaman Daftar</h1>
    <form action="proses_daftar.php" method="post">
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username"
            required minlength="3" maxlength="8">
        </div>
        <div class="form-group">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required minlength="4" maxlength="20">
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="notlp" class="form-label">No Telp</label>
            <input type="number" class="form-control" id="notlp" name="notlp" required
            pattern="[0-9]{10,12,13}" placeholder="08***********">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="button-container">
            <button type="submit" class="btn btn-orange" style="width: calc(100% - 135px)">Register</button>
        </div>
    </form>
 </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>