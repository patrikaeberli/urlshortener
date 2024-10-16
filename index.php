<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://avatars.githubusercontent.com/u/175005826?v=4&size=64">
    <title>Ordner und Weiterleitung erstellen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            color: #4CAF50;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="url"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            font-size: 16px;
        }

        p a {
            color: #4CAF50;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        p.error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Ordner und Weiterleitung erstellen</h1>

    <form method="POST" action="">
        <label for="folderName">Ordnername:</label>
        <input type="text" id="folderName" name="folderName" required><br><br>

        <label for="redirectLink">Weiterleitungslink:</label>
        <input type="url" id="redirectLink" name="redirectLink" required><br><br>

        <button type="submit" name="submit">Erstellen</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $folderName = htmlspecialchars(trim($_POST['folderName']));
        $redirectLink = htmlspecialchars(trim($_POST['redirectLink']));

        // Sicherstellen, dass Ordnername nicht leer ist
        if (!empty($folderName) && !empty($redirectLink)) {
            $directoryPath = __DIR__ . "/" . $folderName;

            // Überprüfen, ob der Ordner bereits existiert
            if (!is_dir($directoryPath)) {
                // Ordner erstellen
                if (mkdir($directoryPath, 0755)) {

                    // Inhalt der index.php Datei für Weiterleitung
                    $indexFileContent = "<?php\nheader('Location: " . $redirectLink . "');\nexit();";

                    // index.php Datei im erstellten Ordner erstellen
                    $indexFilePath = $directoryPath . "/index.php";
                    if (file_put_contents($indexFilePath, $indexFileContent)) {
                        echo "<p>Ihre Domain lautet <a href='http://" . $_SERVER['SERVER_NAME'] . "/$folderName'>http://" . $_SERVER['SERVER_NAME'] . "/$folderName</a></p>";
                    } else {
                        echo "<p class='error'>Fehler beim Erstellen der index.php Datei.</p>";
                    }
                } else {
                    echo "<p class='error'>Fehler beim Erstellen des Ordners.</p>";
                }
            } else {
                echo "<p class='error'>Ein Ordner mit dem Namen '$folderName' existiert bereits.</p>";
            }
        } else {
            echo "<p class='error'>Bitte füllen Sie beide Felder aus.</p>";
        }
    }
    ?>
</body>
</html>
