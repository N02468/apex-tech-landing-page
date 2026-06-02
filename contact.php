<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $conn = new mysqli('localhost', 'root', '', 'landingpage');

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contacts(name, email, subject, message) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Message Sent</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e293b);
}

.success-card{
    background:#fff;
    width:90%;
    max-width:500px;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,0.3);
    animation:slideUp .5s ease;
}

.icon{
    width:90px;
    height:90px;
    margin:auto;
    background:#22c55e;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:40px;
    margin-bottom:20px;
}

h1{
    color:#0f172a;
    margin-bottom:10px;
}

p{
    color:#64748b;
    line-height:1.6;
    margin-bottom:25px;
}

.btn{
    display:inline-block;
    padding:12px 28px;
    background:#2563eb;
    color:#fff;
    text-decoration:none;
    border-radius:10px;
    font-weight:600;
    transition:.3s;
}

.btn:hover{
    background:#1d4ed8;
    transform:translateY(-3px);
}

@keyframes slideUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
</style>

</head>
<body>

<div class="success-card">
    <div class="icon">✓</div>
    <h1>Message Sent Successfully!</h1>
    <p>
        Thank you for contacting us. We have received your message
        and will get back to you as soon as possible.
    </p>

    <a href="index.html" class="btn">Back to Home</a>
</div>

</body>
</html>

<?php
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>