<?php
session_start();

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger text-center'>"
        . $_SESSION['error'] .
        "</div>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <title>Login</title>
  </head>
    <style>

/* HEADER */
.header {
    padding: 15px 30px;
}

.logo-top {
    height: 40px;
}

/* CENTER CONTENT */
.main-content {
    flex: 1; /* pushes footer down */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* LOGIN CARD (keep yours) */
.login-card {
    background: linear-gradient(135deg, #ff4d4d, #cc0000);
    padding: 30px;
    border-radius: 15px;
    width: 300px;
    color: white;
    text-align: center;
}
.btn-primary {
    width: 100%;
    padding: 10px;
    background-color: #cc0000;
    color: white;
    border: none;
    border-radius: 5px;
    }
    .btn-primary:hover {
        background-color: #68b82a;
    }

    </style>
</head>
<body>
  <body>

    <!-- HEADER -->
    <header class="header">
        <img src="/FinalYearProject/img/LogoMaraliner.png" alt="Logo" width="100" height="30" class="d-inline-block align-text-top">
    </header>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="login-card">
    <h5>Hello!</h5>
    <p>Please sign in to continue.</p>

    <form method="POST" action="modules/auth/login.php">
         <div class="col-auto mb-3">
    <label class="visually-hidden" for="username">Username</label>
    <div class="input-group">
      <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
  </div>
  <br>
  <div class="col-auto mb-3">
    <label class="visually-hidden" for="password">Password</label>
    <div class="input-group">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
  </div>
  <div class="row mb-3">
    <div class="col-sm-10 offset-sm-2">
      <div class="form-check text-start mt-2">
        <input class="form-check-input" type="checkbox" id="rememberMeCheck">
        <label class="form-check-label" for="rememberMeCheck">
        Remember me
        </label>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>

    </form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>

<?php include('../FinalYearProject/includes/footer.php'); ?>