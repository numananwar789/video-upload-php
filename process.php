<?php
/* For Error Reporting */
ini_set( 'error_log', 'error_log.log' );
error_reporting( E_ALL );
ini_set( 'display_errors', '1' );

session_start();

// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    // Escape and sanitize input values
    $videoUrl = escape_input( $conn, $_POST[ 'video_url' ] );
    $userName = escape_input( $conn, $_POST[ 'user_name' ] );
    $userEmail = escape_input( $conn, $_POST[ 'user_email' ] );

    // Check if video file is uploaded
    if ( !empty( $_FILES[ 'fileToUpload' ][ 'tmp_name' ] ) && is_uploaded_file( $_FILES[ 'fileToUpload' ][ 'tmp_name' ] ) ) {
        // Move the uploaded video file to the desired directory
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename( $_FILES[ 'fileToUpload' ][ 'name' ] );
        $target_file_name = basename( $_FILES[ 'fileToUpload' ][ 'name' ] );

        if ( move_uploaded_file( $_FILES[ 'fileToUpload' ][ 'tmp_name' ], $target_file ) ) {
            // File uploaded successfully, now insert data into the database
            $sql = "INSERT INTO video_submissions (video_url, user_name, user_email, file_name) VALUES ('$videoUrl', '$userName', '$userEmail', '$target_file_name')";

            if ( $conn->query( $sql ) === TRUE ) {
                // Insert successful
                $_SESSION[ 'successMessage' ] = 'Video uploaded and data saved successfully.';
                header( 'Location: index.php' );
                exit;
            } else {
                $_SESSION[ 'errorMessages' ][] = 'Error: ' . $sql . '<br>' . $conn->error;
            }
        } else {
            $_SESSION[ 'errorMessages' ][] = 'Sorry, there was an error uploading your video file.';
        }
    } else {
        $_SESSION[ 'errorMessages' ][] = 'Video file not uploaded or invalid.';
    }

    // Redirect back to the form with messages
    header( 'Location: index.php' );
    exit;
}
?>
