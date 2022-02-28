<?php
// print_r($_POST);

$lastDir = isset($_POST['pickedDir']) ? $_POST['pickedDir'] : 'C:\\xampp\\htdocs\\projects\\phpBrowser\\main\\';
$txtPath = isset($_POST['txtPath']) ? $_POST['txtPath'] : 'none';
$newFile = isset($_POST['newFile']) ? $_POST['creatingMode'] : 'none';
$fileText = null;

// echo $lastDir;

// echo "<pre>";

if($newFile == "none"){
    file_put_contents($newFile, $fileText);
}


if($txtPath != "none"){
    $myfile = fopen($txtPath, "r") or die("Unable to open file!");
    $fileText = fread($myfile,filesize($txtPath));
    fclose($myfile);
}


//cmd commands
$parts = array('dir', ' ', $lastDir, ' ', "/a-d");
$parts2 = array('dir', ' ', $lastDir, ' ', "/a:d ", "/b");
// print_r($parts);

$cmd = implode($parts);
$cmd2 = implode($parts2);

// print_r($cmd);
// echo "<pre>";
// print_r($cmd2);
// echo "<pre>";

//      DIR [pathname(s)] [display_format] [file_attributes] [sorted] [time] [options]
// $cmd = "ls"; Linux, Mac, Unix

$files = array();
$path = $lastDir;
$dirs = array();

//Get files
exec(escapeshellcmd($cmd), $output, $status);
if ($status){
    //No files command should come here
}
else {
    $count = 0;
    foreach ($output as $line) {
        $parts = preg_split('/\s+/', $line);
        // if ($count == 3) {
        //     $path = $line;
        // }
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $parts[0])) {
            // echo htmlspecialchars("$line\n");
            array_push($files, $line);
        }
        $count++;
    };
    // print_r($files);
}

// $cmd2 = "dir C:\\xampp\\htdocs\\projects\\phpBrowser\\main /a:d /b";


//Get directories
exec(escapeshellcmd($cmd2), $output2, $status2);
if ($status2) return;
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

    .main {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    th.path {
        width: 523px !important;
        margin: 0 auto;
        text-align: center;
        font-size: 14px;
        font-weight: 800;
        padding-bottom: 1rem;
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

    button {
        display: none;
    }

    h2 {
        text-align: center;
    }

    .editArea button {
        display: block;
    }

    .addfile {
        font-size: 2rem;
    }
    </style>
</head>

<body>
    <div class="main">

        <div class="tableArea">
            <table class="table">
                <tr>
                    <th class="path" colspan="4">Path</th>
                </tr>
                <tr>
                    <th></th>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Date Modified</th>
                </tr>
                <tr>

                    <td colspan="4">
                        <span class="material-icons " onClick="previousDir()">
                            more_horiz
                        </span>
                    </td>
                </tr>
                <tr>

                    <td colspan="1">
                        <span class="material-icons addfile" onClick="previousDir()">
                            note_add
                        </span>

                    </td>
                </tr>
            </table>
        </div>


        <div class="editArea">
            <h2>Editable file</h2>
        </div>


    </div>

    <div class="Test"></div>
    <div class="output"></div>



    <form id="TheForm" method="post" action="main.php" target="TheWindow">
        <input type="hidden" id="dirName" name="pickedDir" value="undefinied" />
        <input type="hidden" id="txtPath" name="txtPath" value="undefinied" />
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
let fileText = <?= json_encode($fileText) ?>;


let dirs = <?= json_encode($dirs) ?>;

let output = document.querySelector('.table');
let path = document.querySelector('.path');
let main = document.querySelector('.main');
let dirName = document.querySelector('#dirName');
let txtPath = document.querySelector('#txtPath');
let backButton = document.querySelector('.material-icons');


path.innerHTML = directory;

if (fileText != null) {
    let div = document.querySelector(".editArea");
    let input = document.createElement("textarea");
    let button = document.createElement("button");
    button.innerHTML = "Done editing";
    input.name = "post";
    input.maxLength = "50000";
    input.value = fileText;
    input.cols = "80";
    input.rows = "30";
    div.appendChild(input); //appendChild
    div.appendChild(button);
}


let outputData = files.forEach(element => {
    // console.log(element)
    const cut = element.split(/[ ]+/);
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
    item.addEventListener('dblclick', function(e) {
        // console.log("doubleClick!");
        // console.log(this.dataset.value);

        if (e.currentTarget.classList.contains("dir")) {
            dirName.value = lastDir + this.dataset.value + "\\";
            // console.log(dirName.value)
            submitMe();
        } else {
            let fileFormat = e.currentTarget.dataset.value.split(".");
            fileFormat = fileFormat[fileFormat.length - 1];
            if (fileFormat == "txt") {
                dirName.value = lastDir;
                txtPath.value = directory + e.currentTarget.dataset.value;
                submitMe();
                // console.log(txtName.value)
            }
        }

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
            // console.log("asd")
        } else {
            this.classList.add('active');
            // console.log(this.classList)
        }
    })


});

function previousDir() {
    // console.log(directory.split("\\"))
    //Array(7) [ "C:", "xampp", "htdocs", "projects", "phpBrowser", "main", "" ]
    let splitted = directory.split("\\");
    if (splitted[splitted.length - 2] != "main") {
        // splitted = splitted.splice(splitted[splitted.length - 2], 1);
        let tar = splitted.length - 2;
        splitted.splice(tar, 1);
        splitted = splitted.join("\\");
        dirName.value = splitted;
        submitMe();
    } else {
        return;
    }
}



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