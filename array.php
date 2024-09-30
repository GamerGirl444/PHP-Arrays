<?php
//  Create a random associative array of albums
$albums = [
    "Dark Side of the Moon" => rand(1, 10),
    "Thriller" => rand(1, 10),
    "Back in Black" => rand(1, 10),
    "The Joshua Tree" => rand(1, 10),
    "Nevermind" => rand(1, 10)
];
$albums["Abbey Road"] = 10;

$pageContent = "<h1>Favorite Albums</h1>";

// Create a sorted list of albums for the dropdown
ksort($albums);
$albumOptions = "";
foreach ($albums as $title => $rating) {
    $albumOptions .= "<option value=\"" . htmlspecialchars($title) . "\">" . htmlspecialchars($title) . "</option>";
}

//  Create a multidimensional array of artists, albums, and release dates
$artists = [
    "The Beatles" => [
        "A Hard Day's Night" => 1964,
        "Help!" => 1965,
        "Rubber Soul" => 1965,
        "Abbey Road" => 1969
    ],
    "Led Zeppelin" => [
        "Led Zeppelin IV" => 1971
    ],
    "Rolling Stones" => [
        "Let It Bleed" => 1969,
        "Sticky Fingers" => 1971
    ],
    "The Who" => [
        "Tommy" => 1969,
        "Quadrophenia" => 1973,
        "The Who by Numbers" => 1975
    ],
    "Lil Baby" => [
        "My Turn" => 2020,
        "Drip Harder" => 2018,
        "Perfect Timing" => 2017
    ],
    "Pop Smoke" => [
        "Meet the Woo" => 1959,
        "Shoot for the stars aim for the moon" => 2020,
        "Faith" => 2021
    ],
    "Juice WRLD" => [
        "Goodbye & Good Riddance" => 2018,
        "Death Race" => 1950
    ]
];

//  Access the release date for Tommy by The Who
$pageContent .= "<p>Tommy by The Who was released in " . $artists["The Who"]["Tommy"] . "</p>";

// List of each artist and album title
$pageContent .= "<h2>All Artists and Albums</h2><ul>";
foreach ($artists as $artist => $albums) {
    foreach ($albums as $album => $year) {
        $pageContent .= "<li>$artist - $album</li>";
    }
}
$pageContent .= "</ul>";

//  List of The Who albums and release dates
$pageContent .= "<h2>The Who Albums</h2><ul>";
foreach ($artists["The Who"] as $album => $year) {
    $pageContent .= "<li>$album ($year)</li>";
}
$pageContent .= "</ul>";

//  List of albums released after 1970
$pageContent .= "<h2>Albums Released After 1970</h2><ul>";
foreach ($artists as $artist => $albums) {
    foreach ($albums as $album => $year) {
        if ($year > 1970) {
            $pageContent .= "<li>$artist - $album ($year)</li>";
        }
    }
}
$pageContent .= "</ul>";

// Handle form submission for filtering
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['album'])) {
    $selectedAlbum = $_POST['album'];
    $pageContent .= "<h2>Selected Album Details</h2>";
    foreach ($artists as $artist => $albums) {
        if (array_key_exists($selectedAlbum, $albums)) {
            $pageContent .= "<p>Artist: $artist</p>";
            $pageContent .= "<p>Album: $selectedAlbum</p>";
            $pageContent .= "<p>Year: " . $albums[$selectedAlbum] . "</p>";
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Information</title>
</head>
<body>
    <form method="post">
        <label for="album">Select an album:</label>
        <select name="album" id="album">
            <?php echo $albumOptions; ?>
        </select>
        <input type="submit" value="Get Details">
    </form>

    <?php echo $pageContent; ?>
</body>
</html>




