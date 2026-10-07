<?php
require_once "db.php";
$error=""; $success="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $role=$_POST["role"]??"Student"; $name=trim($_POST["name"]??""); $email=trim($_POST["email"]??""); $password=$_POST["password"]??""; $confirm=$_POST["confirm_password"]??"";
 $course=trim($_POST["course"]??""); $semester=trim($_POST["semester"]??""); $subject=trim($_POST["subject"]??"");
 if($name===""||$email===""||$password==="") $error="Please fill all required fields.";
 elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) $error="Enter a valid email.";
 elseif(strlen($password)<6) $error="Password must contain at least 6 characters.";
 elseif($password!==$confirm) $error="Passwords do not match.";
 else {
  $table=strtolower($role); $hash=password_hash($password,PASSWORD_DEFAULT);
  if(!in_array($table,["student","teacher","admin"],true)) $error="Invalid role.";
  else {
   $check=$conn->prepare("SELECT id FROM $table WHERE email=? LIMIT 1"); $check->bind_param("s",$email); $check->execute();
   if($check->get_result()->num_rows) $error="Email already registered.";
   else {
    if($table==="student"){ $st=$conn->prepare("INSERT INTO student(name,email,password,course,semester) VALUES(?,?,?,?,?)"); $st->bind_param("sssss",$name,$email,$hash,$course,$semester); }
    elseif($table==="teacher"){ $st=$conn->prepare("INSERT INTO teacher(name,email,password,subject) VALUES(?,?,?,?)"); $st->bind_param("ssss",$name,$email,$hash,$subject); }
    else { $st=$conn->prepare("INSERT INTO admin(name,email,password) VALUES(?,?,?)"); $st->bind_param("sss",$name,$email,$hash); }
    if($st->execute()) $success="Account created successfully. You can now login.";
    else $error="Registration failed: ".$conn->error;
   }
  }
 }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"><link href="assets/style.css" rel="stylesheet"></head>
<body class="login-wrap"><div class="container py-4"><div class="row justify-content-center"><div class="col-xl-9">
<div class="card auth-card"><div class="card-body p-4 p-lg-5"><div class="text-center mb-4"><i class="bi bi-person-plus text-primary fs-1"></i><h2 class="fw-bold">Create Account</h2><p class="text-muted">Join Online Quiz System and start learning today.</p></div>
<?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?=e($success)?></div><?php endif; ?>
<form method="post"><div class="mb-3"><label class="form-label fw-semibold">Register As</label><div class="row g-2">
<?php foreach(["Student","Teacher","Admin"] as $r): ?><div class="col-md-4"><label class="role-box w-100"><input type="radio" name="role" value="<?=$r?>" <?=($r===($_POST["role"]??"Student"))?"checked":""?>> <i class="bi bi-person"></i> <?=$r?></label></div><?php endforeach; ?></div></div>
<div class="row g-3"><div class="col-md-6"><label class="form-label">Full Name</label><input name="name" class="form-control" value="<?=e($_POST["name"]??"")?>" placeholder="Enter full name" required></div>
<div class="col-md-6"><label class="form-label">Email Address</label><input type="email" name="email" class="form-control" value="<?=e($_POST["email"]??"")?>" placeholder="Enter email" required></div>
<div class="col-md-6"><label class="form-label">Password</label><input type="password" name="password" class="form-control" placeholder="Enter password" required></div>
<div class="col-md-6"><label class="form-label">Confirm Password</label><input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required></div>
<div class="col-md-6"><label class="form-label">Course <small class="text-muted">(Student)</small></label><input name="course" class="form-control" placeholder="e.g. BCA"></div>
<div class="col-md-6"><label class="form-label">Semester <small class="text-muted">(Student)</small></label><input name="semester" class="form-control" placeholder="e.g. Semester 5"></div>
<div class="col-12"><label class="form-label">Subject <small class="text-muted">(Teacher)</small></label><input name="subject" class="form-control" placeholder="e.g. Java"></div></div>
<button class="btn btn-primary w-100 mt-4 py-2">Create Account <i class="bi bi-arrow-right"></i></button></form>
<div class="text-center mt-3">Already have an account? <a href="login.php">Login</a><br><a class="small text-muted" href="index.php">← Back to Home</a></div>
</div></div></div></div></div></body></html>
