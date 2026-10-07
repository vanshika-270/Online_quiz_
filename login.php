<?php
require_once "db.php";
$error="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $email=trim($_POST["email"]??""); $password=$_POST["password"]??""; $role=$_POST["role"]??"";
 if($email===""||$password===""||$role==="") $error="Please fill all fields.";
 else {
  $table=strtolower($role);
  if(!in_array($table,["admin","teacher","student"],true)) $error="Invalid role.";
  else {
   $stmt=$conn->prepare("SELECT * FROM $table WHERE email=? LIMIT 1");
   $stmt->bind_param("s",$email); $stmt->execute(); $u=$stmt->get_result()->fetch_assoc();
   if($u && password_verify($password,$u["password"])){
    $_SESSION["role"]=ucfirst($table); $_SESSION["user_id"]=(int)$u["id"]; $_SESSION["user_name"]=$u["name"]; $_SESSION["user_email"]=$u["email"];
    if($table==="student"){$_SESSION["student_id"]=$u["id"];} elseif($table==="teacher"){$_SESSION["teacher_id"]=$u["id"];} else {$_SESSION["admin_id"]=$u["id"];}
    go(role_home(ucfirst($table)));
   } else $error="Invalid email or password.";
  }
 }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"><link href="assets/style.css" rel="stylesheet"></head>
<body class="login-wrap"><div class="container py-5"><div class="row justify-content-center"><div class="col-lg-6">
<div class="card auth-card"><div class="card-body p-5"><div class="text-center mb-4"><i class="bi bi-mortarboard-fill text-primary fs-1"></i><h2 class="fw-bold">Welcome Back</h2><p class="text-muted">Login to continue to Online Quiz System.</p></div>
<?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?>
<form method="post"><div class="mb-3"><label class="form-label">Email Address</label><input type="email" name="email" class="form-control" placeholder="Enter your email" required></div>
<div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" placeholder="Enter your password" required></div>
<div class="mb-4"><label class="form-label">Login As</label><select name="role" class="form-select" required><option value="">Select Role</option><option>Student</option><option>Teacher</option><option>Admin</option></select></div>
<button class="btn btn-primary w-100 py-2">Login <i class="bi bi-arrow-right"></i></button></form>
<div class="text-center mt-4">Don't have an account? <a href="register.php">Register</a><br><a class="text-muted small" href="index.php">← Back to Home</a></div>
</div></div></div></div></div></body></html>
