<?php
// Database connection details
$servername = "0.0.0.0";
$username = "root";
$password = "root";
$dbname = "Google";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = $_GET['q'];

// Escape the input to prevent SQL injection
$escapedQuery = $conn->real_escape_string($query);

// Prepare and execute the query for exact match in keywords
$sqlExactMatch = "SELECT * FROM definitions 
                  WHERE JSON_CONTAINS(keywords, '\"$escapedQuery\"', '$')";

$exactMatchResult = $conn->query($sqlExactMatch);

$html = '';

// Check if there's an exact match
if ($exactMatchResult->num_rows > 0) {
  $row = $exactMatchResult->fetch_assoc();
  $html .= '<div class="result-item">';
  $html .= '<div class="result-info">';
  $html .= '<b>' . $escapedQuery . '</b> <mark> ' . $row['definition'] . '</mark>';
  $html .= '</div>'; // result-info
  $html .= '</div>'; // result-item
}

// Prepare and execute the query for the rest of the results
$sqlOtherResults = "SELECT * FROM pages 
                    WHERE title LIKE '%$escapedQuery%' OR description LIKE '%$escapedQuery%' OR content LIKE '%$escapedQuery%' 
                    ORDER BY title ASC";
$otherResults = $conn->query($sqlOtherResults);

// Output the rest of the results
if ($otherResults->num_rows > 0) {
  while ($row = $otherResults->fetch_assoc()) {
    $html .= '<div class="result-item">';
    $html .= '<div class="result-info">';
    $html .= '<a href="' . $row['url'] . '" class="result-title">' . $row['title'] . '</a>';
    $html .= '<div class="result-description">' . $row['description'] . '</div>';
    $html .= '<div class="result-url">' . $row['url'] . '</div>';
    $html .= '</div>'; // result-info

    // Add the image if available
    if (!empty($row['image_url'])) {
      $html .= '<div class="result-image">';
      $html .= '<img src="' . $row['image_url'] . '" alt="Example Image">';
      $html .= '</div>';
    }
    $html .= '</div>'; // result-item
  }
} else {
  $html .= "No results found for <b>" . $query . "</b>";
}

echo $html;

$conn->close();
?>