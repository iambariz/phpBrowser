<?php
$cmd = "dir main /a-d	";
//      DIR [pathname(s)] [display_format] [file_attributes] [sorted] [time] [options]
// $cmd = "ls"; Linux, Mac, Unix

$files = array();
$path = "none";


exec(escapeshellcmd($cmd), $output, $status);
if ($status) echo "Exec command failed";
else {
    $count = 0;
    echo "<pre>";
    foreach ($output as $line) {
        $parts = preg_split('/\s+/', $line);
        if ($count == 3) {
            $path = $line;
        }
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $parts[0])) {
            // echo htmlspecialchars("$line\n");
            array_push($files, $line);
        }
        $count++;
    };
}




// function insertItem($arr)
// {

//     echo
//     '<script type="text/JavaScript"> 
//     var js_variable = echo json_encode($php_variable); 
//     console.log(js_variable);

//     let arr = $arr;

//     const main = document.querySelector(".main");



//     </script>';
// }



// insertItem([]);


// (
//     [0] => 19/11/2021
//     [1] => 13:48
//     [2] => 0
//     [3] => testfile
//     [4] => -
//     [5] => Copy
//     [6] => (3).txt
// )


// $date = "06/01/1996";
// if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $date)) {
//     echo "succes";
// } else {
//     echo "fail";
// }


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
                <th>Size</th>
            </tr>
        </table>

    </div>
    <!-- <div id="dom-target" style="display: none;">
        <?php
        $output = "42"; // Again, do some operation, get the output.
        echo htmlspecialchars($output); /* You have to escape because the result
                                           will not be valid HTML otherwise. */
        ?>
    </div> -->

    <div class="Test"></div>
</body>
<script type="text/javascript">
    let files = <?= json_encode($files) ?>;
    let directory = <?= json_encode($path) ?>;

    let test = document.querySelector('.test');

    test.innerHTML = files;
    test.innerHTML += directory;

    // var cookies = document.cookie.split(";").
    // map(function(el) {
    //     return el.split("=");
    // }).
    // reduce(function(prev, cur) {
    //     prev[cur[0]] = cur[1];
    //     return prev
    // }, {});
    // alert(cookies["TestCookie"]); // Value set with PHP.


    // var div = document.getElementById("dom-target");
    // var myData = div.textContent;
</script>


</html>