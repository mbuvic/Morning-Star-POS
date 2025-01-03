<?php
session_start();

// Function to read the log file
function readLogFile($fileName) {
    if (file_exists($fileName)) {
        return file_get_contents($fileName);
    } else {
        return "Log file does not exist.";
    }
}

// Function to clear the log file
function clearLogFile($fileName) {
    if (file_exists($fileName)) {
        file_put_contents($fileName, '');
    }
}

$logFile = 'log.txt';

// Check if "Clear Logs" button is clicked
if (isset($_POST['clear_logs'])) {
    clearLogFile($logFile);
    // Redirect back to log viewer to avoid resubmission on page refresh
    header("Location: logviewer.php");
    exit;
}

$logContent = readLogFile($logFile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .container:hover {
            transform: scale(1.02);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        pre {
            background-color: #333;
            color: #f8f8f8;
            padding: 15px;
            border-radius: 5px;
            overflow: auto;
            max-height: 600px;
            white-space: pre-wrap; /* Ensure lines wrap inside the container */
            word-break: break-word; /* Prevent long words from overflowing */
        }
        .log-line {
            transition: transform 0.3s ease;
            padding: 2px 0;
        }
        .log-line:hover {
            transform: scale(1.05);
            background-color: #444;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Log Viewer</h1><br> 
        <h1>Log Viewer</h1><br> 
        <h1>Log Viewer</h1><br> 
        <pre>
            <?php
            $lines = explode("\n", htmlspecialchars($logContent));
            foreach ($lines as $line) {
                echo "<div class='log-line'>{$line}</div>";
            }
            ?>
        </pre>
        <div class="button-container">
            <form method="post" action="logviewer.php">
                <button type="submit" name="clear_logs" class="button">Clear Logs</button>
            </form><br>
            <button onclick="window.location.href='index.php'" class="button">Back to POS</button>
        </div>
    </div>
    <script>
        document.querySelectorAll('.button').forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
            });
            button.addEventListener('mouseout', () => {
                button.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>
