<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feed | Vietgram</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
        include "koneksi.php";
        $result = mysqli_query($koneksi,"select * from profile");
        $data = mysqli_fetch_array($result);

        $result = mysqli_query($koneksi,"select * from photo where likes=12506");
        $photo1 = mysqli_fetch_array($result);
        $result = mysqli_query($koneksi,"select * from photo where likes=44512");
        $photo2 = mysqli_fetch_array($result);

        $keyword = "";
    ?>

    <?php    
    $keyword = "";  
    $queryCondition = "";
    if(!empty($_POST["search"])) {
        $keyword = $_POST["search"];
        $wordsAry = explode(" ", $keyword);
        $wordsCount = count($wordsAry);
        $queryCondition = " WHERE ";
        for($i=0;$i<$wordsCount;$i++) {
            $queryCondition .= "caption LIKE '%" . $wordsAry[$i] . "%'";
            if($i!=$wordsCount-1) {
                $queryCondition .= " OR ";
            }
        }
    }
    $sql = "SELECT * FROM photo " . $queryCondition;
    $result = mysqli_query($koneksi,$sql);
    //$d = mysqli_fetch_array($result);
    //highlightKeywords($d["caption"], $keyword);
    ?>

    <?php 
        function highlightKeywords($text, $keyword) {
            $wordsAry = explode(" ", $keyword);
            $wordsCount = count($wordsAry);
            //echo $text."<br>";
            for($i=0;$i<$wordsCount;$i++) {
                $highlighted_text = "<span style='font-weight:bold; background-color: #F9F902;'>$wordsAry[$i]</span>";
                $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
            }
            //echo $text;
            return $text;
        }
    ?>

    <nav class="navigation">
        <div class="navigation__column">
            <a href="feed.html">
                <!-- Master branch comment -->
                <img src="images/logo.png" />
            </a>
        </div>
        <div class="navigation__column">
            <i class="fa fa-search"> </i>
            <form name="frmSearch" method="post">
                <input type="text" name="search" placeholder="Search" value="<?php echo $keyword; ?>">
                <input type="submit" name="go" class="btnSearch" value="Search" style="color: transparent; background-color: transparent; border-color: transparent; cursor: default;">
            </form>
        </div>
        <div class="navigation__column">
            <ul class="navigations__links">
                <li class="navigation__list-item">
                    <a href="explore.html" class="navigation__link">
                        <i class="fa fa-compass fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="#" class="navigation__link">
                        <i class="fa fa-heart-o fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="profile.php" class="navigation__link">
                        <i class="fa fa-user-o fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="feed">
        <div class="photo">
            <header class="photo__header">
                <img src="images/jk.jpeg" class="photo__avatar" />
                <div class="photo__user-info">
                    <span class="photo__author">
                        <?php 
                            echo $data["username"];
                        ?>
                    </span>
                    <span class="photo__location">kookie, Seoul</span>
                </div>
            </header>
            <img src="<?php echo $photo1["url"]; ?>" />
            <div class="photo__info">
                <div class="photo__actions">
                    <span class="photo__action">
                        <i class="fa fa-heart-o fa-lg"></i>
                    </span>
                    <span class="photo__action">
                        <i class="fa fa-comment-o fa-lg"></i>
                    </span>
                </div>
                <span class="photo__likes">
                    <?php 
                        echo $photo1["likes"];
                    ?> likes
                </span>
                <div class="photo__cap">
                <?php 
                    if(isset($_POST["search"])) {
                        echo highlightKeywords($photo1["caption"], $keyword);
                    } else {
                        echo $photo1["caption"];
                    } 
                ?> </div>
                <ul class="photo__comments">
                    <li class="photo__comment">
                        <span class="photo__comment-author">its_rahmatrambe</span> Army!
                    </li>
                    <li class="photo__comment">
                        <span class="photo__comment-author">ramram25</span> BTS !
                    </li>
                    <li class="photo__comment">
                        <span class="photo__comment-author">kookielovers</span> I Purple BTS!
                    </li>
                    <li class="photo__comment">
                        <span class="photo__comment-author">btsarmy_</span>  BT21 MY LOVE!
                    </li>
                </ul>
                <span class="photo__time-ago">1 hours ago</span>
                <div class="photo__add-comment-container">
                    <textarea name="comment" placeholder="Add a comment..."></textarea>
                    <i class="fa fa-ellipsis-h"></i>
                </div>
            </div>
        </div>
        <div class="photo">
            <header class="photo__header">
                <img src="images/krist.jpg" class="photo__avatar" />
                <div class="photo__user-info">
                    <span class="photo__author">kit_turtle</span>
                    <span class="photo__location">Bangkok</span>
                </div>
            </header>
            <img src="<?php echo $photo2["url"]; ?>" />
            <div class="photo__info">
                <div class="photo__actions">
                    <span class="photo__action">
                            <i class="fa fa-heart-o fa-lg"></i>
                        </span>
                    <span class="photo__action">
                            <i class="fa fa-comment-o fa-lg"></i>
                        </span>
                </div>
                <span class="photo__likes">
                    <?php 
                        echo $photo2["likes"];
                    ?> likes
                </span>
                <div class="photo__cap">
                <?php 
                    if(isset($_POST["search"])) {
                        echo highlightKeywords($photo2["caption"], $keyword);
                    } else {
                        echo $photo2["caption"];
                    }  
                ?> </div>
                <ul class="photo__comments">
                    <li class="photo__comment">
                        <span class="photo__comment-author">sing_post</span>  Love Chicken!
                    </li>
                    <li class="photo__comment">
                        <span class="photo__comment-author">thitiphom.55</span> im hungry,55555!
                    </li>
                    <li class="photo__comment">
                        <span class="photo__comment-author">bangkokfood</span> Baked Honey Mustard Chicken!
                    </li>
                    <li class="photo__comment">
                        <span class="photo__comment-author">gmm.thai</span> 5555555!
                    </li>
                </ul>
                <span class="photo__time-ago">2 hours ago</span>
                <div class="photo__add-comment-container">
                    <textarea name="comment" placeholder="Add a comment..."></textarea>
                    <i class="fa fa-ellipsis-h"></i>
                </div>
            </div>
        </div>
        
    </main>
    <footer class="footer">
        <div class="footer__column">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">About Us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Language</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer__column">
            <span class="footer__copyright">© 2017 Vietgram</span>
        </div>
    </footer>
</body>

</html>