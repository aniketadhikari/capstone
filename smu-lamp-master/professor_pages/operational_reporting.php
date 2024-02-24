<?php
@include '../config.php';

session_start();
if (!isset($_SESSION['professor_name'])) {
    header('location:../index.php');
}
$professor_id = $_SESSION['professor_id'];
$select_peers = "SELECT * FROM PeerAssessment INNER JOIN Student ON PeerAssessment.StudentID=Student.StudentID WHERE ProfessorID=$professor_id";
$result_select_peers = mysqli_query($conn, $select_peers);
$peers = mysqli_fetch_all($result_select_peers, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Operational Reporting</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "dark2", // "light1", "light2", "dark1", "dark2"
                height: 400,
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Name of Student Being Evaluated",
                title: {
                    text: "Student Scores"
                },
                axisY: {
                    title: "Total Score",
                    minimum: 0,
                    maximum: 5
                },
                data: [{
                    type: "column",
                    dataPoints: [
                        <?php foreach ($peers as $peer) { ?> {
                                y: <?php
                                    if (empty($peer['TotalScore'])) {
                                        echo 0;
                                    } else {
                                        echo $peer['TotalScore'];
                                    }
                                    ?>,
                                label: "<?php echo " " . $peer['FirstName'] . ' ' . $peer['LastName']; ?>"
                            },
                        <?php } ?>
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>


<body class="professor-body">
    <?php include '../templates/professor_nav.php'; ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Operational Reporting</h4>
    </div>
    <div>
        <div class="container" id="chartContainer" style="height: 400px"></div>
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
    </div>
    <br>
    <div>
        <?php include '../templates/footer.php' ?>
    </div>
</body>

</html>