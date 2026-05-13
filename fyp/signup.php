<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #ffffff;
        }

        .card {
            background: linear-gradient(135deg, #ff4d4d, #cc0000);
            color: white;
            border-radius: 12px;
        }

        input {
            background: #ffffff !important;
            color: white !important;
            border: none !important;
        }

        input::placeholder {
            color: #ccc;
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow" style="width:400px;">

        <h3 class="text-center mb-4">Create Account</h3>

        <form method="POST" action="modules/auth/register.php">

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text"
                       name="full_name"
                       class="form-control"
                       placeholder="Enter full name"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter email"
                       required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter password"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Sign Up
            </button>

        </form>

        <div class="text-center mt-3">
            <a href="index.php" class="text-light">
                Already have account?
            </a>
        </div>

    </div>

</div>

</body>
</html>