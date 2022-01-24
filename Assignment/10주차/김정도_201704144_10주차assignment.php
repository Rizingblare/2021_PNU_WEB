<?php
    $conn = new mysqli("localhost", "root", "000000", "201704144"); 
    // 즐겨찾기 제목의 유일값 처리는 DB에서 Title을 속성을 Primary Key로 설정함으로 처리하였습니다.
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>김정도_201704144</title>
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
        /* .pagination {
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
        .pagination div:hover:not(.active) {background-color: #ddd;} */
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
    </head>
<body>
    <div class="maindiv">
        <form name="form1" method="GET" action="김정도_201704144.php">
            <label>즐겨찾기 제목: <input type="text" name="linkTitle" id="linkTitle"></label><br>
            <label>즐겨찾기 링크: <input type="text" name="linkSrc" id="linkSrc"></label><br>
            <input type="submit" name="action" id="addBtn" value="즐겨찾기 추가">
            <input type="submit" name="action" id="delBtn" value="즐겨찾기 삭제">
            <input type="submit" name="action" id="clearBtn" value="모두 삭제">
        </form>
        <br>
        <div id="linkContainer">
        <?php
            if ($conn->correct_errno){
                echo "DB 연결 실패";
            }
            else {
                $action = $_GET['action'];
                $linkTitle = $_GET['linkTitle'];
                $linkSrc = $_GET['linkSrc'];
                if ($action == "즐겨찾기 추가"){
                    if (!empty($linkTitle)&&!empty($linkSrc)){
                        $sql = "INSERT INTO bookmark(Title,Link) VALUES ('$linkTitle','$linkSrc')";
                        $result = mysqli_query($conn,$sql);
                    }
                }
                else if ($action == "즐겨찾기 삭제"){
                    if (isset($linkTitle)){
                        $sql = "DELETE FROM bookmark WHERE Title='$linkTitle'";
                        $result = mysqli_query($conn,$sql);
                    }
                }
                else if ($action == "모두 삭제"){
                    $sql = "DELETE FROM bookmark";
                    $result = mysqli_query($conn,$sql);
                }
                $sql = "SELECT * FROM bookmark";
                $result = mysqli_query($conn,$sql);
                $rNum = mysqli_num_rows($result);

                $curPage = 1;
                if (is_numeric($action)) $curPage = $action;
                $start = ($curPage - 1) * 10;
                $sql = "SELECT * FROM bookmark ORDER BY Title LIMIT $start,10";
                $result = mysqli_query($conn,$sql);
                
                while ($row = mysqli_fetch_array($result)){
                        echo "<a href='". $row['Link'] ."' target='linkFrame'>". $row['Title']. "</a>";
                }
            }           
        ?>
        </div>
        <form name="form2" method="GET" action="김정도_201704144.php">
        <?php
            if ($rNum > 10){
                $pNum = ceil($rNum/10);
                
                for ($i =1; $i <= $pNum; $i++){
                    if ($i == $curPage)
                        echo "<input type='submit' class='active' name='action' value='$i'>";
                    else
                        echo "<input type='submit' name='action' value='$i'>";
                }
            }
        ?>
        </form>
        <!-- <nav class="pagination" id="pageNav"></nav> -->
    </div>
    <iframe title="iframe for link" name="linkFrame">
    </iframe>
</body>
</html>
<?php $conn.close(); ?>