<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Video List</h2>
            <a href="index.php" class="btn btn-sm btn-outline-primary">Back to Form</a>
        </div>
        <table id="videoTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Video URL</th>
                    <th>Video Name</th>
                    <th>Video</th>
                    <th>User Name</th>
                    <th>User Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // Include the database connection file
            include 'db_connection.php';

            // Fetch video data from the database
            $sql = "SELECT * FROM video_submissions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["video_url"] . "</td>";
                    echo "<td>" . $row["file_name"] . "</td>";
                    echo "<td><video width='150' height='100' controls><source src='uploads/{$row["file_name"]}' type='video/mp4'>Your browser does not support the video tag.</video></td>";
                    echo "<td>" . $row["user_name"] . "</td>";
                    echo "<td>" . $row["user_email"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No videos found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#videoTable').DataTable();
        });
    </script>

</body>

</html>