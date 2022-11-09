<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>
<body>
    <h1>Form Register Anggota</h1>
    <form action="/kirim" method="post">
        @csrf
        <label for="">Nama lengkap : </label>
        <br>
        <input type="text" name="nama" id="" required>
        <br>
        <label for="">Alamat : </label>
        <br>
        <textarea name="alamat" id="" cols="30" rows="10" required></textarea>
        <br>
        <label for="">Email : </label>
        <br>
        <input type="email" name="email" id="" required>
        <br>
        <label for="">No HP : </label>
        <br>
        <input type="text" name="no_hp" id="" required>
        <br>
        <label for="">Gender : </label>
        <input type="radio" name="gender"  value="1"id="">Laki-laki 
        <input type="radio" name="gender"  value="2"id="">Perempuan
        <br>
        <input type="submit" value="daftar">
    </form>
</body>
</html>