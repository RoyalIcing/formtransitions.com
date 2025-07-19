<?php
if ($_SERVER["REQUEST_URI"] === "/search?") {
    header("Location: /search");
    exit();
}

$items = file("fruit.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$filteredItems = $items;
$search = trim($_GET["q"] ?? "");

if ($search != "") {
    $filteredItems = array_filter(
        $items,
        fn($item) => strpos($item, $search) !== false,
    );
}
?>
<!doctype html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
:root {
    font-family: system-ui, sans-serif;
    font-size: 150%;
}
body {
    max-width: 30ch;
    margin: auto;
}
input, button {
    font-size: inherit;
}
form {
    display: grid;
    gap: 1lh;
}

@view-transition {
  navigation: auto;
}
</style>

<form action="/search">
    <input name="q" type="search" placeholder="Search..." value="<?= htmlspecialchars(
        $search,
    ) ?>">
</form>
<form action="/search">
    <button>Clear</button>
</form>

<?php foreach ($filteredItems as $item) {
    echo "<p style='view-transition-name: " . sha1($item) . "'>$item</p>";
}
