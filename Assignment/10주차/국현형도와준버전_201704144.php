<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Example</title>
    <style type="text/css">
        #linkContainer {
            display: flex;
            flex-wrap: wrap;
            width: 310px;
        }
    
        #linkContainer a  {
            display: block;
            list-style-type: none;
            text-align: center;
            font-size: 3em;
            border: 1px solid;
            width: 150px;
            float: left;
            margin: 1px;
        }        
        a   { 
            text-decoration: none;
        }
        .pagination {
            visibility: hidden;
            display: inline-block;
        }
        .pagination div {
            float: left;
            padding: 8px 16px;
        }
        .pagination div.active {
            background-color: #4CAF50;
            color: white;
        }
        .pagination div:hover:not(.active) {background-color: #ddd;}
        .maindiv {
            width: 320px;
            float: left;
        }
        iframe {
            width: 500px;
            height: 500px;
            float: left;
        }
    </style>
    <script type="text/javascript">
        var linkArr = new Array();
        var curPage = 0;

        function addLink()
        {
            if (linkArr.findIndex(checkTitle) >= 0)
            {
                window.alert("이미 있는 즐겨찾기 제목입니다. 다른 제목을 사용해주세요.");
                return;
            }
            linkArr.push({title: document.forms[0].linkTitle.value, src: document.forms[0].linkSrc.value});
            linkArr.sort(compareTitle);

            document.forms[0].reset();
            makePages();
            showLinks();
            updateData();
        }
        function checkTitle(link)
        {
            return link.title == document.forms[0].linkTitle.value;
        }
        function compareTitle(link1, link2)
        {
            if (link1.title > link2.title)
                return 1;
            else if (link1.title < link2.title)
                return -1;
            else
                return 0;
        }       
        function deleteLink()
        {
            var idx = linkArr.findIndex(checkTitle);
            if (idx < 0)
            {
                window.alert("일치하는 제목을 가진 즐겨찾기가 없습니다.");
                return;
            }
            linkArr.splice(idx, 1);
            makePages();
            showLinks();
            updateData();
        }
        function clearAll()
        {
            linkArr = Array();
            document.getElementById("linkContainer").innerHTML = "";
            updateData();
        }
        function showLinks()
        {
            var linkContainer = document.getElementById("linkContainer");
            linkContainer.innerHTML = "";

            var startIdx = curPage * 10;
            var endIdx = startIdx + 9;
            for(var idx = startIdx; idx <= endIdx && idx < linkArr.length; idx++)
            {
                var link = makeLink(linkArr[idx].title, linkArr[idx].src);
                linkContainer.innerHTML += link;
            }
        }
        function makeLink(title, src)
        {
            return "<a href='" + src + "' target=\"linkFrame\">" + title + "</a>";
        }
        function makePages()
        {
            if (linkArr.length > 10)
            {
                var pageNav = document.getElementById("pageNav");
                pageNav.style.visibility = "visible";
                pageNav.innerHTML = "";
                var nPage = Math.ceil(linkArr.length / 10);
                for(var i =0; i < nPage; i++)
                {
                    if (i == curPage)
                        pageNav.innerHTML += "<div class=\"active\" onclick=\"changePage(" + i +")\">" + (i + 1) + "</div>";
                    else
                        pageNav.innerHTML += "<div onclick=\"changePage(" + i +")\">" + (i + 1) + "</div>";

                }
            }
        }
        function changePage(pageNum)
        {
            curPage = pageNum;
            makePages();
            showLinks();
        }
        function updateData()
        {
            localStorage.removeItem("links");
            localStorage.setItem("links", JSON.stringify(linkArr));
        }
        function start()
        {
            var links = localStorage.getItem("links");
            if (links != null)
            {
                linkArr = JSON.parse(links);
                makePages();
                showLinks();
            }
        }
    </script>
    </head>
<body onload="start()">
    <div class="maindiv">
        <form name="form1" method="GET" action="김정도_201704144.php">
            <label>즐겨찾기 제목: <input type="text" name="linkTitle" id="linkTitle"></label><br>
            <label>즐겨찾기 링크: <input type="text" name="linkSrc" id="linkSrc"></label><br>
            <input type="submit" name="insertLink" id="addBtn" value="즐겨찾기 추가">
            <input type="submit" name="delete" id="delBtn" value="즐겨찾기 삭제">
            <input type="submit" name="deleteall" id="clearBtn" value="모두 삭제">
        </form>
        <?php
            if($_GET["insertLink"]){
                $host = 'localhost';
                $user = 'root';
                $pw = '000000';
                $dbName = '201704144';
                $conn = new mysqli($host, $user, $pw, $dbName);
                if($conn) {
                    echo "insert";
                    $title = $_GET["linkTitle"];
                    $link = $_GET["linkSrc"];
                    $sql_insert = "INSERT INTO bookmark (title, link) VALUES ('$title','$link')";
                    $result = mysqli_query($conn, $sql_insert);
                }
            }
            if($_GET["delete"]){
                $host = 'localhost';
                $user = 'root';
                $pw = '000000';
                $dbName = '201704144';
                $conn = new mysqli($host, $user, $pw, $dbName);
                if($conn) {
                    echo "delete";
                    $title = $_GET["linkTitle"];
                    $link = $_GET["linkSrc"];
                    $sql_insert = "delete from bookmark where title='$title'";
                    $result = mysqli_query($conn, $sql_insert);
                }
            }
            if($_GET["deleteall"]) {
                $host = 'localhost';
                $user = 'root';
                $pw = '000000';
                $dbName = '201704144';
                $conn = new mysqli($host, $user, $pw, $dbName);
                if($conn) {
                    echo "delete all";
                    $title = $_GET["linkTitle"];
                    $link = $_GET["linkSrc"];
                    $sql_insert = "delete from bookmark";
                    $result = mysqli_query($conn, $sql_insert);
                    $conn.close();
                }
            }

            $host = 'localhost';
            $user = 'root';
            $pw = '000000';
            $dbName = '201704144';
            $conn = new mysqli($host, $user, $pw, $dbName);

            if($conn) {
                $sql = "SELECT * FROM bookmark";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    // echo $row['Title']." ".$row['Link']."<br>";
                    echo "<div><a href='".$row['Link']."'>".$row['Title']."</a></div>";
                }
            }
            ?>
        <br>
        <div id="linkContainer">
        </div>
        <nav class="pagination" id="pageNav">
        </nav>
    </div>
    <iframe title="iframe for link" name="linkFrame"></iframe>
</body>
</html>