<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $filename = $_FILES['file']['tmp_name'];
        
        try {
            $file_content = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($file_content === false) {
                throw new Exception("Failed to read the file.");
            }

            $students = [];
            $total_grade = 0;
            $highest_grade = 0;

            foreach ($file_content as $line) {
                $parts = explode(',', $line);
                if (count($parts) != 2) {
                    throw new Exception("Malformed data: $line");
                }

                $name = trim($parts[0]);
                $grade = trim($parts[1]);

                if (!is_numeric($grade)) {
                    throw new Exception("Invalid grade for student $name: $grade");
                }

                $grade = (int)$grade;
                $students[] = ['name' => $name, 'grade' => $grade];
                $total_grade += $grade;
                
                if ($grade > $highest_grade) {
                    $highest_grade = $grade;
                }
            }

            $average_grade = $total_grade / count($students);

            $top_students = array_filter($students, function($student) use ($highest_grade) {
                return $student['grade'] == $highest_grade;
            });

        } catch (Exception $e) {
            echo "<div class='container mt-5'>";
            echo "<p class='text-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "</div>";
            exit;
        }
    } else {
        echo "<div class='container mt-5'>";
        echo "<p class='text-danger'>Error: Failed to upload the file.</p>";
        echo "</div>";
        exit;
    }
} else {
    header("Location: upload_form.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Grades Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .result-block {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .result-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .student-list {
            list-style-type: none;
            padding: 0;
        }
        .student-list li {
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Student Grades Result</h1>
        
        <div class="result-block">
            <div class="result-title">Average Grade</div>
            <p><?php echo number_format($average_grade, 2); ?></p>
        </div>

        <div class="result-block">
            <div class="result-title">Students with the Highest Grade (<?php echo $highest_grade; ?>)</div>
            <ul class="student-list">
                <?php foreach ($top_students as $student) : ?>
                    <li><?php echo htmlspecialchars($student['name']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="result-block">
            <div class="result-title">All Students and Grades</div>
            <ul class="student-list">
                <?php foreach ($students as $student) : ?>
                    <li><?php echo htmlspecialchars($student['name']) . ": " . $student['grade']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="text-center">
            <a href="upload_form.php" class="btn btn-primary">Upload Another File</a>
        </div>
    </div>
</body>
</html>
