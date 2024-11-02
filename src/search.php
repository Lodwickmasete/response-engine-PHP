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
$query = $_GET['q'] ?? ''; // Default to an empty string if 'q' is not set
$queryStartIndex = $_GET['startIndex']; // Default to an empty string if 'q' is not set
// Escape the input to prevent SQL injection
$escapedQuery = $conn->real_escape_string($query);

// Prepare and execute the query for exact match in keywords
$sqlExactMatch = "SELECT * FROM definitions 
                  WHERE JSON_CONTAINS(keywords, ' " . $escapedQuery . "', '$')";

$exactMatchResult = $conn->query($sqlExactMatch);

$html = '';
$resultsPerPage = 5; // Limit number of results per page

// Check if there's an exact match
if ($exactMatchResult && $exactMatchResult->num_rows > 0) {
    $row = $exactMatchResult->fetch_assoc();
    $html .= '<div class="result-item">';
    $html .= '<div class="result-info">';
    $html .= '<b>' . htmlspecialchars($escapedQuery) . '</b> <mark> ' . htmlspecialchars($row['definition']) . '</mark>';
    $html .= '</div>'; // result-info
    $html .= '</div>'; // result-item
}

// Prepare and execute the query for the rest of the results with limit
$sqlOtherResults = "SELECT * FROM pages 
                    WHERE title LIKE '%$escapedQuery%' OR description LIKE '%$escapedQuery%' OR content LIKE '%$escapedQuery%' 
                    ORDER BY title ASC LIMIT $resultsPerPage";
$otherResults = $conn->query($sqlOtherResults);
$html .= ' <div class="main-results">' ;
// Output the rest of the results
if ($otherResults && $otherResults->num_rows > 0) {
    while ($row = $otherResults->fetch_assoc()) {

        $html .= '<div class="result-item">';
        $html .= '<div class="result-info">';
        $html .= '<a href="' . htmlspecialchars($row['url']) . '" class="result-title">' . htmlspecialchars($row['title']) . '</a>';
        $html .= '<div class="result-description">' . htmlspecialchars($row['description']) . '</div>';
        $html .= '<div class="result-url">' . htmlspecialchars($row['url']) . '</div>';
        $html .= '</div>'; // result-info

        // Add the image if available
        if (!empty($row['image_url'])) {
            $html .= '<div class="result-image">';
            $html .= '<img src="' . htmlspecialchars($row['image_url']) . '" alt="Example Image">';
            $html .= '</div>'; // result-image
        }
        $html .= '</div>'; // result-item

    }
                    $html .= '</div>';
                    $html .= '<div id="more-results">';
                    $html .= '</div>';
                    
    // Create Load More button
$html .= '<center><button class="more" id="load-more-button" onclick="loadMore(\'' . addslashes($query) . '\', ' . ($resultsPerPage + 5) . ')">Load More</button></center>';
} else {
    $html .= "No results found for <b>" . htmlspecialchars($query) . "</b>";
}

// Call the function to load shortcuts from the JSON file
$jsonFile = 'shortcuts.php'; // Path to your JSON file containing related shortcuts
if (file_exists($jsonFile)) {
    $shortcutsData = json_decode(file_get_contents($jsonFile), true); // Decode the JSON file
    if ($shortcutsData) {
        $html .= '<h3>Related Shortcuts</h3>';
        $html .= '<div class="related-shortcuts">';
        foreach ($shortcutsData as $shortcut) {
            $html .= '<div class="shortcut">';
            $html .= '<h4>' . htmlspecialchars($shortcut['title']) . '</h4>';
            $html .= '<p>' . htmlspecialchars($shortcut['description']) . '</p>';
            $html .= '<a href="' . htmlspecialchars($shortcut['url']) . '" target="_blank">Visit Page</a>';
            if (!empty($shortcut['image_url'])) {
                $html .= '<img src="' . htmlspecialchars($shortcut['image_url']) . '" alt="Shortcut Image">';
            }
            $html .= '</div>'; // shortcut
        }
        $html .= '</div>'; // related-shortcuts
    }
}

echo $html;
echo '</div>';
$conn->close();
?>