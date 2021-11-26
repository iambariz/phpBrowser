<?php
// print_r($_POST);

$lastDir = isset($_POST['pickedDir']) ? $_POST['pickedDir'] : 'C:\\xampp\\htdocs\\projects\\phpBrowser\\main';

// echo $lastDir;

$parts = array('dir', ' ', $lastDir, ' ', "/a-d");
$parts2 = array('dir', ' ', $lastDir, ' ', "/a:d ", "/b");
// print_r($parts);

$cmd = implode($parts);
$cmd2 = implode($parts2);

echo "\n";

// print_r($cmd);
// print_r($cmd2);

//      DIR [pathname(s)] [display_format] [file_attributes] [sorted] [time] [options]
// $cmd = "ls"; Linux, Mac, Unix

$files = array();
$path = "none";
$dirs = array();

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

// $cmd2 = "dir C:\\xampp\\htdocs\\projects\\phpBrowser\\main /a:d /b";

exec(escapeshellcmd($cmd2), $output2, $status2);
if ($status2) echo "Exec command failed";
else {
    foreach ($output2 as $line) {
        array_push($dirs, $line);
    };
    // foreach ($dirs as $item) {
    //     echo "<pre>";
    //     echo htmlspecialchars("$item\n");
    // };
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url(https://example.com/MaterialIcons-Regular.eot);
            /* For IE6-8 */
            src: local('Material Icons'),
                local('MaterialIcons-Regular'),
                url(https://example.com/MaterialIcons-Regular.woff2) format('woff2'),
                url(https://example.com/MaterialIcons-Regular.woff) format('woff'),
                url(https://example.com/MaterialIcons-Regular.ttf) format('truetype');
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            /* Preferred icon size */
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;

            /* Support for all WebKit browsers. */
            -webkit-font-smoothing: antialiased;
            /* Support for Safari and Chrome. */
            text-rendering: optimizeLegibility;

            /* Support for Firefox. */
            -moz-osx-font-smoothing: grayscale;

            /* Support for IE. */
            font-feature-settings: 'liga';
        }

        * {
            font-family: 'Roboto', sans-serif;
        }

        th:nth-of-type(1) {
            width: 2rem;
        }


        th:nth-of-type(3) {
            border-width: 0px 1px 0px 1px;
            border-color: #000;
            border-style: solid;
        }

        th {
            width: 10rem;
            cursor: pointer;

        }

        td {
            text-align: center;
            cursor: pointer;

        }

        .row-item.active {
            background-color: #000;
            color: #fff;
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
                <th></th>
                <th>File Name</th>
                <th>Size</th>
                <th>Date Modified</th>
            </tr>
            <tr>

                <td colspan="4"><span class="material-icons">
                        more_horiz
                    </span></td>


            </tr>
        </table>
    </div>

    <div class="Test"></div>
    <div class="output"></div>


    <form id="TheForm" method="post" action="main.php" target="TheWindow">
        <input type="hidden" id="dirName" name="pickedDir" value="undefinied" />
        <button onclick="submitMe()"></button>
    </form>

    <!-- <script type="text/javascript">
        window.open('', 'TheWindow');
        document.getElementById('TheForm').submit();
    </script> -->
</body>
<script type="text/javascript">
    function submitMe() {
        window.open('', 'TheWindow');
        document.getElementById('TheForm').submit();
    }

    let files = <?= json_encode($files) ?>;
    let directory = <?= json_encode($path) ?>;
    let lastDir = <?= json_encode($lastDir) ?>;

    console.log(lastDir);

    let dirs = <?= json_encode($dirs) ?>;

    let output = document.querySelector('.table');
    let path = document.querySelector('.path');
    let main = document.querySelector('.main');
    let dirName = document.querySelector('#dirName');

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
            <tr class="row-item file" data-value="${cut[3]}">
            <td><span class="material-icons">description</span></td>
            <td>${cut[3]}</td>
                <td>${cut[2]} byte</td>
                <td>${cut[0]} ${cut[1]}</td>

            </tr>
        `;
        // console.log(item);
        output.innerHTML += item;
    });
    let outputDir = dirs.forEach(element => {
        item = `
            <tr class="row-item dir" data-value="${element}">
            <td ><span class="material-icons">
            folder
            </span></td>
            <td colspan="4">${element}</td>

            </tr>
        `;
        // console.log(item);
        output.innerHTML += item;
    });

    const rowItems = document.querySelectorAll('.row-item');

    // console.log(rowItems)

    rowItems.forEach(item => {
        item.addEventListener('dblclick', function() {
            console.log("doubleClick!");
            console.log(this.dataset.value);
            dirName.value = lastDir + "\\" + this.dataset.value;
            console.log(dirName.value)
            submitMe();
        })

        item.addEventListener('click', function() {
            const item = document.querySelector('.active');
            // console.log(item == this);
            if (item) {
                item.classList.remove('active');
            }
        })
        // dblclick
        item.addEventListener('click', function() {
            if (this.classList.contains('active')) {
                console.log("asd")
            } else {
                this.classList.add('active');
                console.log(this.classList)
            }
        })

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