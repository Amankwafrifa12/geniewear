<?php
// Start the session
session_start();

// Clear the session
session_unset();
session_destroy();

// Redirect to index.php
header('Location: index.php');
exit;
