<?php
@include '../config.php';

session_start();
if (!isset($_SESSION['professor_name'])) {
    header('location:../index.php');
}
// Gather all respective students of professor logged in 
$professor_id = $_SESSION['professor_id'];
$select = "SELECT Student.* FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE ProfessorID = $professor_id ORDER BY FirstName";
$result = mysqli_query($conn, $select);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) == 0) {
    $error[] = 'No students assigned to you!';
}

// INSERT into the PeerAssessments table when a new entry is made by a professor
if (isset($_POST['submit'])) {
    // StartDate 
    $start_date = date("Y-m-d");
    // DueDate
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    // SubmittedDate TO BE FILLED BY STUDENT
    // StudentID
    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_name']));
    // GroupID
    $find_student = "SELECT SMU.Student.*, SMU.Course.ProfessorID FROM ((`Student` INNER JOIN `Groups` ON `Student`.`GroupID`=`Groups`.`GroupID`) INNER JOIN `Course` ON `Groups`.`CourseID`=`Course`.`CourseID`) WHERE StudentID = $student_id";
    $find_student_result = mysqli_query($conn, $find_student);
    $group_id = mysqli_fetch_row($find_student_result)[9];
    // EvaluatorStudentID
    $evaluator_id = intval(mysqli_real_escape_string($conn, $_POST['evaluator_name']));
    if ($student_id == $evaluator_id) {
        $error[] = 'Student can not evaluate themselves!';
    } else {
        $insert = "INSERT INTO PeerAssessment(StartDate, DueDate, StudentID, GroupID, EvaluatorStudentID, ProfessorID) VALUES('$start_date', '$due_date', '$student_id', '$group_id', '$evaluator_id', '$professor_id')";
        mysqli_query($conn, $insert);
        $success[] = 'Assessment Successfully Assigned';
        header('location:schedule_eval.php');
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Evaluations</title>
</head>

<body class="professor-body">
    <?php include '../templates/professor_nav.php'; ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Evaluations</h4>
    </div>
    <div class="container" style="background-color: #151c55; padding: 20px; border-radius: 15px;">
        <form action="" method="post">
            <label for="student_name">Which student is being evaluated?</label>
            <select name="student_name" id="student_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="evaluator_name">Which student is doing the evaluating?</label>
            <select name="evaluator_name" id="evaluator_name" style="display: block;">
                <?php foreach ($students as $student) { ?>
                    <option value="<?php echo htmlspecialchars($student['StudentID']) ?>"><?php echo htmlspecialchars($student['FirstName']) . ' ' . htmlspecialchars($student['LastName']); ?></option>
                <?php } ?>
            </select>
            <br>
            <label for="due_date"><strong>Select</strong> due date for peer evaluations</label>
            <input type="date" id="due_date" name="due_date" min="<?php echo htmlspecialchars(date("Y-m-d")) ?>" value="<?php echo htmlspecialchars(date("Y-m-d")) ?>">
            <br>
            <input class="btn blue darken-4" type="submit" name="submit" value="Schedule">
        </form>
    </div>
    <br>
    <?php
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<div class="error-container">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-octagon" viewBox="0 0 16 16">
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
              </svg><span class="msg">' . $error . '</span>';
            echo '</div>';
        };
    };
    if (isset($success)) {
        foreach ($success as $success) {
            echo '<div class="success-container">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
            <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
          </svg><span class="msg">' . $success . '</span>';
            echo '</div>';
        }
    }
    ?>
    <!-- View Peer Eval Scores  -->
    <div class="container">
        <div class="row center">
            <?php
            $professor_id = $_SESSION['professor_id'];
            $select_peers = "SELECT * FROM PeerAssessment INNER JOIN Student ON PeerAssessment.StudentID=Student.StudentID WHERE ProfessorID=$professor_id";
            $result_select_peers = mysqli_query($conn, $select_peers);
            $peers = mysqli_fetch_all($result_select_peers, MYSQLI_ASSOC);

            foreach ($peers as $peer) {
            ?>

                <div class="col s6 md3">
                    <div class="card z-depth-2">
                        <div class="card-panel center hoverable">
                            <div class="card-title chip hoverable">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg><a class="chip-link" href="mailto:<?php echo htmlspecialchars($peer['EmailAddress']); ?>"><?php echo " " . htmlspecialchars($peer['FirstName']) . ' ' . htmlspecialchars($peer['LastName']); ?></a>
                            </div>
                            <div class="card-content">
                                <p>DMK Score: <?php echo intval(htmlspecialchars($peer['DMKScore'])) ?></p>
                                <p>IC Score: <?php echo intval(htmlspecialchars($peer['ICScore'])) ?></p>
                                <p>IP Score: <?php echo intval(htmlspecialchars($peer['IPScore'])) ?></p>
                                <p>GC Score: <?php echo intval(htmlspecialchars($peer['GCScore'])) ?></p>
                                <p>PM Score: <?php echo intval(htmlspecialchars($peer['PMScore'])) ?></p>
                            </div>
                            <div class="card-action">
                                <h5>Total Score: <?php echo intval(htmlspecialchars($peer['TotalScore'])) ?></h5>
                                <?php
                                $evaluator_id =  htmlspecialchars($peer['EvaluatorStudentID']);
                                $select_evaluator = "SELECT FirstName, LastName FROM Student WHERE StudentID='$evaluator_id'";
                                $result_select_evaluator = mysqli_query($conn, $select_evaluator);
                                $evaluator = mysqli_fetch_row($result_select_evaluator);
                                echo 'Evaluated By: ' . $evaluator[0] . ' ' . $evaluator[1] . ' on ' . date_format(date_create($peer['SubmittedDate']), "M d, Y");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <br>
    <div>
        <?php include '../templates/footer.php' ?>
    </div>
</body>

</html>