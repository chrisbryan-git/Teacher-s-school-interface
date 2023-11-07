<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* CSS for Teacher Registration Form */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5; /* Optional: Setting a background color for the entire page */
}

h2 {
    text-align: center;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: whitesmoke;
    box-shadow: 0 0 10px 3px blue;
    border-radius: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: blue;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: darkblue;
}

    </style>
</head>
<body>
    <h2>Teacher Registration</h2>
    <form action="register_process.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <label for="personal_id">Personal ID:</label>
        <input type="text" name="personal_id" required><br>
        <input type="submit" value="Register">
    </form>
    
</body>
</html>