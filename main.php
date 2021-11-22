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
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            font-family: 'Roboto', sans-serif;
        }

        th:nth-of-type(2) {
            border-width: 0px 1px 0px 1px;
            border-color: #000;
            border-style: solid;
        }

        th {
            width: 10rem;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main">
        <table class="table">
            <tr>

                <th class="path" colspan="3">Path</th>

            </tr>
            <tr>
                <th>File Name</th>
                <th>Size</th>
                <th>Date Modified</th>

            </tr>
            <tr>

                <td colspan="3">...</td>


            </tr>
        </table>

    </div>

    <div class="Test"></div>
    <div class="output"></div>
</body>
<script type="text/javascript">
    let files = <?= json_encode($files) ?>;
    let directory = <?= json_encode($path) ?>;

    let output = document.querySelector('.table');
    let path = document.querySelector('.path');
    let main = document.querySelector('.main');

    path.innerHTML = directory;



    let outputData = files.forEach(element => {
        // console.log(element)
        const cut = element.split(/[ ,]+/);
        // console.log(cut)
        // Array(4)["19/11/2021", "13:48", "0", "testfile.txt"]​
        // 0: "19/11/2021"​
        // 1: "13:48"​
        // 2: "0"​
        // 3: "testfile.txt"​
        item = `
            <tr>
            <td>${cut[3]}</td>
                <td>${cut[2]} byte</td>
                <td>${cut[0]} ${cut[1]}</td>

            </tr>
        `;
        console.log(item);
        output.innerHTML += item;
    });




    // console.log(display);

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