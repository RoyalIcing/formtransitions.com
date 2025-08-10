<?php
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

<form action="/search">
    <input name="q" type="search" placeholder="Search..." value="<?= htmlspecialchars(
        $search,
    ) ?>">
</form>
<form action="/search">
    <fieldset>
        <button>Clear</button>
    </fieldset>
</form>

<?php foreach ($filteredItems as $item) {
    echo "<p style='view-transition-name: " . sha1($item) . "'>$item</p>";
}
