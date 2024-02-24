<?php

@include '../config.php';

session_start();

if (!isset($_SESSION['professor_name'])) {
    header('location:../index.php');
}

$professor_id = $_SESSION['professor_id'];
$select = "SELECT Student.* FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE ProfessorID = $professor_id";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No students assigned to you!';
}
mysqli_free_result($result);
if (isset($_POST['submit'])) {

    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_name']));
    $group_id = intval(mysqli_real_escape_string($conn, $_POST['group_id']));

    // Make sure student exists otherwise update the table
    $find_student = "SELECT * FROM Student WHERE StudentID = $student_id;";
    $find_student_result = mysqli_query($conn, $find_student);
    if (mysqli_num_rows($find_student_result) == 0) {
        $error[] = 'Student does not exist';
    } else {
        $update = "UPDATE Student SET GroupID=$group_id WHERE StudentID = $student_id;";
        mysqli_query($conn, $update);
    }

    header('location:groups.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Student Groups</title>
</head>

<body class="professor-body">
    <?php include '../templates/professor_nav.php' ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Assign Student Groups</h4>
    </div>
    <div class="container" style="background-color: #151c55; padding: 20px; border-radius: 15px;">
        <form action="" method="post">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };
            ?>
            <label for="student_name">Select Student:</label>
            <select name="student_name" id="student_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <div>
                <label for="group_id">Enter Group ID:</label>
                <br>
                <input type="number" minlength="1" maxlength="2" name="group_id" required placeholder="Enter Number">
            </div>
            <br>
            <input class="btn blue darken-4" type="submit" name="submit" value="Assign Group">
        </form>
    </div>
    <div class="container" style="padding: 20px;">
        <div class="row">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email <?php echo ' ' . ' ' ?> <i class="bi bi-envelope-at-fill"></i> </th>
                        <th>Phone <?php echo ' ' . ' ' ?><i class="bi bi-telephone-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($students as $student) {
                    ?>
                        <tr class="hoverable">
                            <td><?php echo htmlspecialchars($student['StudentID']); ?></td>
                            <td><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></td>
                            <td><a class="mail-link" href="mailto:"><?php echo htmlspecialchars($student['EmailAddress']); ?></a></td>
                            <td><?php echo htmlspecialchars($student['PhoneNumber']); ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div>
        <?php include '../templates/footer.php' ?>
    </div>
</body>

</html>