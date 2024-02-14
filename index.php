<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Submission Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add the Toastify CSS and JS links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <!-- Success or Error Message showing in toast starts -->
    <?php
        session_start();

        // Check if there's a success message in the session
        if (isset($_SESSION['successMessage'])) {
            $successMessage = htmlspecialchars($_SESSION['successMessage']);

            // Display a success toast message using Toastify
            echo '<script>
                    Toastify({
                        text: "' . $successMessage . '",
                        backgroundColor: "green",
                        className: "toastify-success",
                        close: true,
                        gravity: "top",
                        position: "right",
                    }).showToast();
                </script>';

            // Remove the success message from the session to avoid displaying it again on refresh
            unset($_SESSION['successMessage']);
        } 
        // Check if there's an error message in the session
        else if (isset($_SESSION['errorMessages'])) {
            foreach ($_SESSION['errorMessages'] as $errorMessage) {
                $errorMessage = htmlspecialchars($errorMessage);

                // Display an error toast message using Toastify
                echo '<script>
                        Toastify({
                            text: "' . $errorMessage . '",
                            backgroundColor: "red",
                            className: "toastify-error",
                            close: true,
                            gravity: "top",
                            position: "right",
                        }).showToast();
                    </script>';
            }

            // Remove the error messages from the session to avoid displaying them again on refresh
            unset($_SESSION['errorMessages']);
        }
    ?>
    <!-- Success or Error Message showing in toast ends -->

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Video Submission Form</h2>
        <button class="btn btn-sm btn-outline-success">View Video List</button>
    </div>

    <form action="process.php" method="post" enctype="multipart/form-data" id="videoForm">
        <div class="form-group">
            <label for="video_url">Video URL:</label>
            <input type="url" class="form-control" name="video_url" placeholder="Enter video URL" >
        </div>

        <div class="form-group">
            <label for="video_file">Upload Video: <small class="text-muted">(max upload size 2 mb)</small></label>
            <input type="file" class="form-control-file" name="fileToUpload" accept="video/*">
            <small class="form-text text-muted">Accepted formats: mp4, avi, mkv, mov, wmv</small>
        </div>

        <div class="form-group">
            <label for="user_name">Your Name:</label>
            <input type="text" class="form-control" name="user_name" placeholder="Enter your name" >
        </div>

        <div class="form-group">
            <label for="user_email">Your Email:</label>
            <input type="email" class="form-control" name="user_email" placeholder="Enter your email" >
        </div>

        <input type="submit" value="Submit" class="btn btn-sm btn-primary">
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript plugins) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.2/jquery.validate.min.js"></script>

<script>
    // jQuery Validation
    $(document).ready(function () {
        $("#videoForm").validate({
            rules: {
                user_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                user_email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                }
            }
        });
    });
</script>

</body>
</html>
