<?php
// Database connection settings for WHMCS
$dbHost = 'localhost';
$dbName = 'whmcs_database';
$dbUser = 'db_user';
$dbPass = 'db_password';

try {
    // Establishing database connection
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Deleting selected TLDs
    if (!empty($_POST['tlds'])) {
        $tldsToDelete = $_POST['tlds'];
        $placeholders = rtrim(str_repeat('?,', count($tldsToDelete)), ',');

        $stmt = $pdo->prepare("DELETE FROM tbldomainpricing WHERE extension IN ($placeholders)");

        if ($stmt->execute($tldsToDelete)) {
            echo "<p style='color: green;'>Selected TLDs have been successfully deleted.</p>";
        } else {
            echo "<p style='color: red;'>An error occurred while deleting TLDs.</p>";
        }
    } else {
        echo "<p style='color: red;'>No TLDs were selected.</p>";
    }
}

// Fetching list of TLDs
$stmt = $pdo->query("SELECT id, extension FROM tbldomainpricing");
$tlds = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage TLDs in WHMCS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
        }
        h1 {
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        li {
            margin: 5px 0;
        }
        label {
            display: flex;
            align-items: center;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button.delete {
            background-color: #e74c3c;
            color: #ffffff;
        }
        button.select-all {
            background-color: #3498db;
            color: #ffffff;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage TLDs</h1>
        <form method="POST">
            <p>Select TLDs to delete:</p>
            <ul>
                <?php foreach ($tlds as $tld): ?>
                    <li>
                        <label>
                            <input type="checkbox" name="tlds[]" value="<?php echo htmlspecialchars($tld['extension']); ?>">
                            <?php echo htmlspecialchars($tld['extension']); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="actions">
                <button type="button" class="select-all" onclick="selectAllTLDs()">Select All</button>
                <button type="submit" class="delete">Delete Selected TLDs</button>
            </div>
        </form>
    </div>
    <script>
        function selectAllTLDs() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = true);
        }
    </script>
</body>
</html>
