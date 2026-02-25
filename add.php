<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Patient</title>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: #eee;
    margin: 0;
    padding: 0;
}

form {
    max-width: 600px;
    margin: 30px auto;
    padding: 20px;
    background: #1e1e1e;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
}

fieldset {
    border: 1px solid #444;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

legend {
    padding: 0 10px;
    font-weight: bold;
}

input[type="text"],
input[type="tel"],
input[type="number"],
input[type="date"],
select {
    width: 95%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #555;
    background-color: #2c2c2c;
    color: #eee;
}

input[type="submit"] {
    background-color: #1976d2;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
}

input[type="submit"]:hover {
    background-color: #1565c0;
}

.error-messages {
    background-color: #d32f2f;
    color: white;
    padding: 10px;
    margin: 15px auto;
    border-radius: 5px;
    max-width: 600px;
}

input[type="checkbox"] {
    margin-right: 5px;
}

</style>
</head>

<body>

<form action="handler.php" method="POST">

    <!-- PATIENT INFO -->

    <fieldset>
        <legend>Patient Info</legend>

        <label>Last Name:</label>
        <input type="text" name="PLname">

        <label>First Name:</label>
        <input type="text" name="PFname">

        <label>Birth Date:</label>
        <input type="date" name="Bdate">

        <label>Gender:</label>
        <select name="Gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Phone Number:</label>
        <input type="tel" name="PHnum">
    </fieldset>


    <!-- CONSULTATION INFO -->

    <fieldset>
        <legend>Consultation Info</legend>

        <label>Consultation Date:</label>
        <input type="date" name="Cdate">

        <label>Consultation Reason:</label>
        <input type="text" name="Creason">

        <label>Body Temperature (°C):</label>
        <input type="number" name="temp" step="0.1">

        <label>Blood Pressure:</label><br>
        <input type="number" name="pressure[]" placeholder="Systolic" style="width:45%;"> 
        /
        <input type="number" name="pressure[]" placeholder="Diastolic" style="width:45%;">

        <label>Weight (kg):</label>
        <input type="number" name="weight" step="0.1">

        <label>Height (cm):</label>
        <input type="number" name="height" step="0.1">

        <label>Symptoms:</label><br>
        <input type="checkbox" name="symptoms[]" value="Cough"> Cough<br>
        <input type="checkbox" name="symptoms[]" value="Fever"> Fever<br>
        <input type="checkbox" name="symptoms[]" value="Headache"> Headache
    </fieldset>

    <input type="submit" value="Submit">

</form>


<?php
if (!empty($_SESSION['errors'])) {

    echo '<div class="error-messages">';

    foreach ($_SESSION['errors'] as $error) {
        echo htmlspecialchars($error) . '<br>';
    }

    echo '</div>';

    unset($_SESSION['errors']);
}
?>

</body>
</html>