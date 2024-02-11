<?php

// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'videos_db';

// Create connection
$conn = new mysqli( $host, $username, $password, $database );

// Check connection
if ( $conn->connect_error ) {
    die( 'Connection failed: ' . $conn->connect_error );
}

// Function to safely escape input values

function escape_input( $conn, $input ) {
    return mysqli_real_escape_string( $conn, $input );
}