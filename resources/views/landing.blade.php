<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>MovieGather</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    background:#141414;
    color:white;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

}

.card{

    background:#1f1f1f;
    border:none;
    border-radius:20px;
    padding:50px;
    width:500px;
    text-align:center;
    box-shadow:0 0 40px rgba(229,9,20,.25);

}

h1{

    color:#E50914;
    font-size:55px;
    font-weight:bold;

}

p{

    color:#ccc;
    margin-bottom:40px;

}

.btn-login{

    background:#E50914;
    color:white;
    border:none;

}

.btn-login:hover{

    background:#b20710;
    color:white;

}

.btn-register{

    background:white;
    color:black;
    border:none;

}

.btn-register:hover{

    background:#ddd;

}

</style>

</head>

<body>

<div class="card">

<h1>🎬 MovieGather</h1>

<p>
Temukan teman nonton dan buat event nobar favoritmu.
</p>

<div class="d-grid gap-3">

<a href="{{ route('login') }}" class="btn btn-login btn-lg">

🔐 Login

</a>

<a href="{{ route('register') }}" class="btn btn-register btn-lg">

📝 Register

</a>

</div>

</div>

</body>

</html>