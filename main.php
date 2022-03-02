<?php
$lastDir = isset($_POST['pickedDir']) ? $_POST['pickedDir'] : 'C:\\xampp\\htdocs\\projects\\phpBrowser\\main\\';
$txtPath = isset($_POST['txtPath']) ? $_POST['txtPath'] : "undefinied";
$newFile = isset($_POST['newFile']) ? $_POST['newFile'] : "undefinied";
$fileTextInput = isset($_POST['fileTextInput']) ? $_POST['fileTextInput'] : "undefinied";
$fileText = null;

// echo $newFile;

if($newFile != "undefinied"){
    file_put_contents($newFile, $fileText);
}


if($txtPath != "undefinied"){
    $myfile = fopen($txtPath, "r") or die("Unable to open file!");
    $fileText = fread($myfile,filesize($txtPath));
    fclose($myfile);
}


//cmd commands
$parts = array('dir', ' ', $lastDir, ' ', "/a-d");
$parts2 = array('dir', ' ', $lastDir, ' ', "/a:d ", "/b");

$cmd = implode($parts);
$cmd2 = implode($parts2);



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
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $parts[0])) {
            array_push($files, $line);
        }
        $count++;
    };
}



//Get directories
exec(escapeshellcmd($cmd2), $output2, $status2);
if ($status2) return;
else {
    foreach ($output2 as $line) {
        array_push($dirs, $line);
    };

}

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

    /* Box sizing rules */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .tableWrapper {
        position: relative;
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

    .main>div {
        flex-shrink: 1;
        width: 33%;
        /* default 1 */

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

    .add-btn {
        font-size: 2rem;
        position: absolute;
        cursor: pointer;
        bottom: -3rem;
        right: 0;
        transition: .6s ease all;
    }

    .add-btn:hover {
        color: #00008B;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        max-width: 25rem;
        max-height: 25rem;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .wrapper {
        margin: 2rem 1rem;
    }

    .menu-option {
        margin: .25rem .5rem;
        padding: .5rem;
        background-color: #fff;
        color: #000;
        cursor: pointer;
        font-weight: 800;
        display: flex;
        align-items: center;
    }

    .menu-option:hover {
        background-color: #000;
        color: #fff;
    }

    .addfile {
        padding-right: 1rem;
    }

    .menu-option>* {
        padding: 0;
        margin: 0;
    }

    h4 {
        padding: .25rem 0rem;
    }

    .createWrapper {
        display: none;
    }

    #newItemText {
        display: none;
    }

    #createButton {
        margin: 2rem 0rem;
        float: right;
        display: block;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="main">

        <div class="tableArea">
            <div class="tableWrapper">


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

                </table>

                <span class="material-icons add-btn " onClick="previousDir()">
                    add_circle
                </span>
            </div>
        </div>

        <div class="createArea">
            <div class="createWrapper">
                <h2>Create area</h2>
                <h4>File name</h4>
                <input type="text" id="newFileName" name="newFileName">
                <h4>Content</h4>
                <textarea name="newItemText" id="newItemText" cols="50" rows="10"></textarea>
                <button id="createButton" onclick="">Submit</button>
            </div>
        </div>

        <div class="editArea">
            <h2>Editable file</h2>
        </div>



        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="wrapper">
                    <div class="menu-option">
                        <span class="material-icons addfile">
                            note_add
                        </span>
                        <span>Create new file</span>
                    </div>
                    <div class="menu-option">
                        <span class="material-icons addfile">
                            create_new_folder
                        </span>
                        <span>Create new folder</span>
                    </div>

                    </ul>
                </div class="wrapper">

            </div>

        </div>

        <form id="TheForm" method="post" action="main.php" target="TheWindow">
            <input type="hidden" id="dirName" name="pickedDir" value="undefinied" />
            <input type="hidden" id="txtPath" name="txtPath" value="undefinied" />
            <input type="hidden" id="newFile" name="newFile" value="undefinied" />
            <input type="hidden" id="fileTextInput" name="fileTextInput" value="undefinied" />
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

const files = <?= json_encode($files) ?>;
const directory = <?= json_encode($path) ?>;
const lastDir = <?= json_encode($lastDir) ?>;
const fileText = <?= json_encode($fileText) ?>;


const dirs = <?= json_encode($dirs) ?>;

const output = document.querySelector('.table');
const path = document.querySelector('.path');
const main = document.querySelector('.main');
const dirName = document.querySelector('#dirName');
const txtPath = document.querySelector('#txtPath');
const backButton = document.querySelector('.material-icons');
const addBtn = document.querySelector('.add-btn');
const modal = document.getElementById("myModal");
const menuOptions = document.querySelectorAll('.menu-option');
const createWrapper = document.querySelector('.createWrapper');
const newFileName = document.querySelector('#newFileName');
const newItemText = document.querySelector('#newItemText');


// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
addBtn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

path.innerHTML = directory;

if (fileText != null) {
    let div = document.querySelector(".editArea");
    let input = document.createElement("textarea");
    let button = document.createElement("button");
    button.innerHTML = "Done editing";
    input.name = "post";
    input.maxLength = "50000";
    input.value = fileText;
    input.cols = "50";
    input.rows = "30";
    div.appendChild(input);
    div.appendChild(button);
}


let outputData = files.forEach(element => {
    const cut = element.split(/[ ]+/);
    // Array(4)["19/11/2021", "13:48", "0", "testfile.txt"]​
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

    output.innerHTML += item;
});

const rowItems = document.querySelectorAll('.row-item');

rowItems.forEach(item => {
    item.addEventListener('dblclick', function(e) {

        if (e.currentTarget.classList.contains("dir")) {
            dirName.value = lastDir + this.dataset.value + "\\";
            submitMe();
        } else {
            let fileFormat = e.currentTarget.dataset.value.split(".");
            fileFormat = fileFormat[fileFormat.length - 1];
            if (fileFormat == "txt") {
                dirName.value = lastDir;
                txtPath.value = directory + e.currentTarget.dataset.value;
                submitMe();
            }
        }

    })

    item.addEventListener('click', function() {
        const item = document.querySelector('.active');
        if (item) {
            item.classList.remove('active');
        }
    })
    // dblclick
    item.addEventListener('click', function() {
        if (this.classList.contains('active')) {} else {
            this.classList.add('active');
        }
    })


});

function previousDir() {
    //Array(7) [ "C:", "xampp", "htdocs", "projects", "phpBrowser", "main", "" ]
    let splitted = directory.split("\\");
    if (splitted[splitted.length - 2] != "main") {
        let tar = splitted.length - 2;
        splitted.splice(tar, 1);
        splitted = splitted.join("\\");
        dirName.value = splitted;
        submitMe();
    } else {
        return;
    }
}

menuOptions[0].addEventListener('click', function(e) {
    // 2,4,7    console.log(createWrapper.childNodes);
    switchTags("text");

})

menuOptions[1].addEventListener('click', function(e) {
    switchTags("folder");
})

function switchTags(mode) {
    createWrapper.style.display = "block";
    if (mode == "text") {
        createWrapper.childNodes[1].textContent = "Create document";
        createWrapper.childNodes[3].textContent = "Document's name";
        newItemText.style.display = "block";
    }
    if (mode == "folder") {
        createWrapper.childNodes[1].textContent = "Create folder";
        createWrapper.childNodes[3].textContent = "Folder's name";
        createWrapper.childNodes[7].style.display = "none";
        newItemText.style.display = "none";
    }
    modal.style.display = "none";
}
</script>


</html>