<?php
@include '../config.php';

session_start();
if (!isset($_SESSION['professor_name'])) {
    header('location:../index.php');
}

if (isset($_POST['submit'])) {
    $student_id = intval(mysqli_real_escape_string($conn, $_POST['student_id']));
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);;
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);;
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);;
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);;
    $grade_level = mysqli_real_escape_string($conn, $_POST['grade_level']);;
    $major = mysqli_real_escape_string($conn, $_POST['major']);;
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);

    // Check if student is not a duplicate
    $find_student = "SELECT * FROM Student WHERE StudentID = $student_id;";
    $find_student_result = mysqli_query($conn, $find_student);
    if (mysqli_num_rows($find_student_result) > 0) {
        $error[] = 'Student already in database!';
    } else {
        $insert = "INSERT INTO Student(StudentID, FirstName, LastName, EmailAddress, PhoneNumber, Semester, GradeLevel, Major, GroupID) VALUES('$student_id', '$first_name', '$last_name', '$email_address', '$phone', '$semester', '$grade_level', '$major', $group_id)";
        mysqli_query($conn, $insert);
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Import Students</title>
</head>

<body class="professor-body">
    <?php include '../templates/professor_nav.php' ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Import Students</h4>
    </div>
    <div class="container">
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>

        <br>
        <div class="container" style="background-color: #151c55; padding: 20px; border-radius: 15px;">
            <form action="" method="post">
                <!-- Student ID -->
                <label for="student_id">Student ID: </label><br>
                <input type="number" id="student_id" name="student_id" minlength="9" placeholder="Ex. 123456789" required></input><br>
                <!-- First Name -->
                <label for="first_name">First Name: </label><br>
                <input type="text" id="first_name" name="first_name" placeholder="Ex. John" required></input><br>
                <!-- Last Name -->
                <label for="last_name">Last Name: </label><br>
                <input type="text" id="last_name" name="last_name" placeholder="Ex. Appleseed" required></input><br>
                <!-- Email -->
                <label for="email_address">Email Address: </label><br>
                <input type="email" id="email_address" name="email_address" placeholder="Ex. johnappleseed@business.smu.edu.sg" required></input><br>
                <!-- Phone # -->
                <label for="phone_number">Phone #: </label><br>
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Ex. 123-456-7890" required></input><br>
                <!-- Semester -->
                <label for="semester">Semester: </label><br><br>
                <select name="semester" id="semester" style="display: block;" required>
                    <option value="Term 1">Term 1</option>
                    <option value="Term 2"> Term 2</option>
                </select><br>
                <!-- Grade Level -->
                <label for="grade_level">Grade Level: </label><br><br>
                <select name="grade_level" id="grade_level" style="display: block;" required>
                    <option value="Freshman">Freshman</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Sophomore">Junior</option>
                    <option value="Sophomore">Senior</option>
                </select><br>
                <!-- Major -->
                <label for="major">Major: </label><br>
                <input type="text" id="major" name="major" placeholder="Ex. Computer Science" required></input><br>
                <!-- Group ID -->
                <label for="group_id">Group ID: </label><br><br>
                <select name="group_id" id="group_id" style="display: block;" required>
                    <?php
                    $select_groups = "SELECT * FROM SMU.Groups";
                    $result = mysqli_query($conn, $select_groups);
                    $number_of_groups = mysqli_num_rows($result);
                    for ($i = 1; $i <= $number_of_groups; $i++) {
                    ?>
                        <option value="<?php $i ?>"> Group <?php echo $i ?></option>
                    <?php } ?>

                </select><br>
                <!-- Submit Button -->
                <input class="btn blue darken-4" type="submit" name="submit" value="Import" required>
            </form>
        </div>
    </div>
    <br>
    <div>
        <?php include '../templates/footer.php' ?>
    </div>
</body>

</html>