<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Tambah Data User</title>
</head>

<body>
    <h1>Form Tambah Data User</h1>
    <a href="/user">Kembali</a>
    <br><br>
    <form method="post" action="/user/tambah_simpan">
        {{ csrf_field() }}

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Masukan Username">
        <br>
        <label for="nama">Nama</label>
        <input type="text" name="nama" placeholder="Masukan Nama">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Masukan Password">
        <br>
        <label for="level_id">Level ID</label>
        <input type="number" name="level_id" placeholder="Masukan ID Level">
        <br><br>
        <input type="submit" value="Simpan" class="btn btn-success">
    </form>
</body>

</html>
