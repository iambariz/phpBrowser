<?php
$cmd = "dir main /a-d	";
//      DIR [pathname(s)] [display_format] [file_attributes] [sorted] [time] [options]
// $cmd = "ls"; Linux, Mac, Unix

exec(escapeshellcmd($cmd), $output, $status);
if ($status) echo "Exec ommand failed";
else {
    echo "<pre>";
    foreach ($output as $line) echo htmlspecialchars("$line ---\n");
}

$date = "06/01/1996";
if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $date)) {
    echo "succes";
} else {
    echo "fail";
}


?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>

    <style>
        th:nth-of-type(2) {
            border-width: 0px 1px 0px 1px;
            border-color: #000;
            border-style: solid;
        }

        th {
            width: 10rem;
        }
    </style>
</head>

<body>
    <div class="main">
        <table>
            <tr>
                <th>File Name</th>
                <th>Date Modified</th>
                <th>Type</th>
            </tr>
        </table>

    </div>

</body>

</html>