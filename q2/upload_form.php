<!DOCTYPE html>
<html>
<head>
    <title>Upload Student Grades</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Upload Student Grades</h1>
        <form action="process_grades.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Select file:</label>
                <input type="file" name="file" class="form-control-file" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
