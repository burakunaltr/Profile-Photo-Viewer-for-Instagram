<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Instagram Profile Photo Viewer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-header text-center">
    <div class="container">
        <h1 style="color:#333;text-shadow: 2px 2px 1px #aaa;">Instagram Profile Photo Viewer</h1>
        <p style="color:#777;">View larger instagram profile photos with InstaPPV.</p>
    </div>
</div>
<div style="width:260px;margin:0 auto;">
    <form action="" method="POST">
        <input type="text" class="form-control" style="width:190px;margin:auto 10px 20px auto; float:left;" name="profileid" placeholder="Profile username .." />
        <button type="submit" class="btn btn-info" style="margin:auto auto 20px auto;float:left;" name="submittt">Send</button>
    </form>
</div>
<div style="clear:both;"></div>
<div class="container text-center">
    <?php
    error_reporting(0);
    require "simple_html_dom.php";
    if (isset($_POST['submittt']) AND !empty($_POST['profileid'])) {
        if (!preg_match('/[^abcdefghijklmnoprstuvyzxwq_.0123456789ABCDEFGHIJKLMNOPRSTUVYZXWQ]/', $_POST['profileid'])) {
            if($html = str_get_html(file_get_contents(htmlspecialchars("https://www.instagram.com/".$_POST['profileid'])))) {
                foreach($html->find('meta[property=og:image]') as $element) {
                    $link = explode("/",$element->content);
                    $newlink = $link[0]."//".$link[2]."/".$link[3]."/cf1eaaa749692a0d0180d3d8e5dc1887//".$link[6]."/";
                    if ($link[7]!="s150x150") {
                        $newlink .= $link[7];
                    }
                    else{
                        $newlink .= $link[8];
                    }
                    echo "<div class=\"alert alert-success\">
                    <strong>Success!</strong> The Photo Was Successfully Displayed.
                    </div>";
                    echo "<img src=\"".$newlink."\" class=\"img-responsive\" style=\"display: inline-block;margin-bottom:20px;\">";
                }
            }
            else{
                echo"<div class=\"alert alert-danger\">
                <strong>Warning!</strong> No Such User.
                </div>";
            }
        }
        else{
            echo "<div class=\"alert alert-danger\">
            <strong>Warning!</strong> You Have Entered an Invalid Username. Please, Don't Use ".htmlspecialchars("\";#()[]'^-\<>/")." etc.
            </div>";
        }
    }
    else{
        echo "<div class=\"alert alert-info\">
        <strong>Info!</strong> Fill in The Box with Instagram Profile ID, pls..
        </div>";
    }
    ?>
</div>
</body>
</html>
