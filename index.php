<?php
$file = "data/consultations.json";
$json = @file_get_contents($file);
$data = json_decode($json, true) ?: [];

/* ===== SORT SIMPLE ===== */
if(isset($_GET['sort'])){

    // Sort by Name A
    if($_GET['sort'] == "name"){
        usort($data, function($a,$b){
            return strcmp($a[0][1], $b[0][1]);
        });
    }

    // Sort by Date 
    if($_GET['sort'] == "date"){
        usort($data, function($a,$b){
            return strtotime($b[1][0]) - strtotime($a[1][0]);
        });
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Patient Dashboard</title>

<style>
body { font-family: Arial; background:#121212; color:#eee; margin:0; }
form { text-align:center; margin:20px; }
button { padding:8px 15px; margin:5px; border:none; border-radius:8px; cursor:pointer; }
.nameBtn { background:#4caf50; color:white; }
.dateBtn { background:#ff9800; color:white; }
.addBtn { background:#1976d2; color:white; padding:10px 20px; }
.card-container { display:flex; flex-wrap:wrap; justify-content:center; gap:20px; padding:20px; }
.patient-card { width:280px; padding:15px; border-radius:12px; background:#1e1e1e; box-shadow:0 0 10px rgba(0,0,0,0.5); }
.patient-card hr { border:0; border-top:1px solid #444; margin:10px 0; }
.alert { padding:5px 10px; border-radius:5px; margin-top:5px; font-size:0.9rem; }
.alert-fever { background:#b71c1c; }
.alert-hypertension { background:#ff6f00; }
.alert-underweight { background:#1976d2; }
.alert-obese { background:#d32f2f; }
</style>
</head>
<body>

<!-- Add Patient -->
<form action="add.php">
    <button class="addBtn">Add New Patient</button>
</form>

<!-- SORT BUTTONS -->
<form method="GET">
    <button class="nameBtn" type="submit" name="sort" value="name">Sort by Name</button>
    <button class="dateBtn" type="submit" name="sort" value="date">Sort by Date</button>
</form>

<div class="card-container">

<?php foreach($data as $entry): 
    $patient = $entry[0];
    $consult = $entry[1];

    $id = $patient[0];
?>

<div class="patient-card">

<h3>Patient Card</h3>

<p><strong>ID:</strong> <?= $id ?></p>

<h4>Personal Info</h4>
<p><strong>Name:</strong> <?= $patient[1] . " " . $patient[2] ?></p>
<p><strong>Birth:</strong> <?= $patient[3] ?></p>
<p><strong>Gender:</strong> <?= $patient[4] ?></p>
<p><strong>Phone:</strong> <?= $patient[5] ?></p>
<p><strong>Age:</strong> <?= $patient[6] ?></p>

<hr>

<h4>Consultation</h4>
<p><strong>Date:</strong> <?= $consult[0] ?></p>
<p><strong>Reason:</strong> <?= $consult[1] ?></p>
<p><strong>Temp:</strong> <?= $consult[2] ?> °C</p>
<p><strong>BP:</strong> <?= $consult[3] ?>/<?= $consult[4] ?></p>
<p><strong>Weight:</strong> <?= $consult[5] ?> kg</p>
<p><strong>Height:</strong> <?= $consult[6] ?> cm</p>
<p><strong>BMI:</strong> <?= $consult[7] ?> kg/m²</p>

<?php if($consult[2] >= 38.5): ?>
<div class="alert alert-fever">Fever detected</div>
<?php endif; ?>

<?php if($consult[3] >= 140 || $consult[4] >= 90): ?>
<div class="alert alert-hypertension">Hypertension detected</div>
<?php endif; ?>

<?php if($consult[7] < 18.5): ?>
<div class="alert alert-underweight">Underweight</div>
<?php elseif($consult[7] >= 30): ?>
<div class="alert alert-obese">Obese</div>
<?php endif; ?>

</div>

<?php endforeach; ?>

</div>
</body>
</html>