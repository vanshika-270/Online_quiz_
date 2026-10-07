<?php
require_once "../db.php"; require_role("Student");
$uid=current_id(); $qid=(int)($_GET["id"]??0);
if(!$qid) go("available_quiz.php");
$st=$conn->prepare("SELECT * FROM quiz WHERE id=?"); $st->bind_param("i",$qid); $st->execute(); $quiz=$st->get_result()->fetch_assoc(); if(!$quiz) die("Quiz not found.");
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $qr=$conn->prepare("SELECT * FROM questions WHERE quiz_id=? ORDER BY id"); $qr->bind_param("i",$qid); $qr->execute(); $questions=$qr->get_result();
 $score=0;$attempted=0;$correct=0;$wrong=0;$total=0;
 while($q=$questions->fetch_assoc()){ $total++; $ans=$_POST["answer_".$q["id"]]??""; if($ans!==""){$attempted++; if($ans===$q["correct_answer"]){$score++;$correct++;}else{$wrong++;}}}
 $ins=$conn->prepare("INSERT INTO quiz_history(student_id,quiz_id,score,total_questions,attempted_questions,correct_answers,wrong_answers) VALUES(?,?,?,?,?,?,?)");
 $ins->bind_param("iiiiiii",$uid,$qid,$score,$total,$attempted,$correct,$wrong);$ins->execute();$hid=$conn->insert_id;go("quiz_result.php?id=".$hid);
}
$st=$conn->prepare("SELECT * FROM questions WHERE quiz_id=? ORDER BY id");$st->bind_param("i",$qid);$st->execute();$questions=$st->get_result();
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($quiz["title"])?></title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/style.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-4"><div class="card panel-card"><div class="card-body p-4"><div class="d-flex justify-content-between"><div><h2 class="fw-bold"><?=e($quiz["title"])?></h2><p class="text-muted"><?=e($quiz["description"])?></p></div><span class="badge bg-primary align-self-start"><?=e($quiz["subject"])?></span></div>
<form method="post"><?php $n=1;while($q=$questions->fetch_assoc()):?><div class="border rounded p-4 mb-3"><h5><?=$n++?>. <?=e($q["question"])?></h5><?php foreach(["A"=>"option_a","B"=>"option_b","C"=>"option_c","D"=>"option_d"] as $k=>$field):?><label class="d-block border rounded p-2 my-2"><input type="radio" name="answer_<?=$q["id"]?>" value="<?=$k?>"> <?=e($q[$field])?></label><?php endforeach;?></div><?php endwhile;?><button class="btn btn-success btn-lg">Submit Quiz</button> <a href="available_quiz.php" class="btn btn-outline-secondary btn-lg">Cancel</a></form>
</div></div></div></body></html>
