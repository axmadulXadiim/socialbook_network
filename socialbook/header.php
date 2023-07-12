
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<title>Socialbook - html css template</title>
<script src="https://kit.fontawesome.com/ef7e2b893b.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar">
        <div class="nav-left"><img class="logo" src="images/logo.png" alt="">
            <ul class="navlogo">
                <li><img src="images/notification.png"></li>
                <li><img src="images/inbox.png"></li>
                <li><img src="images/video.png"></li>
            </ul>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="images/search.png" alt="">
                <input type="text" placeholder="Search">
            </div>
            <div class="profile-image online" onclick="UserSettingToggle()">
                <img src="images/profile-pic.png" alt="">
            </div>

        </div>
        <div class="user-settings">
            <div class="profile-darkButton">
                <div class="user-profile">
                    <img src="images/profile-pic.png" alt="">
                    <div>
                        <p> Alex Carry</p>
                        <a href="#">See your profile</a>
                    </div>
                </div>
                <div id="dark-button" onclick="darkModeON()">
                    <span></span>
                </div>
            </div>
            <hr>
            <div class="user-profile">
                <img src="images/feedback.png" alt="">
                <div>
                    <p> Give Feedback</p>
                    <a href="#">Help us to improve</a>
                </div>
            </div>
            <hr>
            <div class="settings-links">
                <img src="images/setting.png" alt="" class="settings-icon">
                <a href="#">Settings & Privary <img src="images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="images/help.png" alt="" class="settings-icon">
                <a href="#">Help & Support <img src="images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="images/Display.png" alt="" class="settings-icon">
                <a href="#">Display & Accessibility <img src="images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="images/logout.png" alt="" class="settings-icon">
                <a href="login.php">Logout <img src="images/arrow.png" alt=""></a>
            </div>

        </div>
    </nav>

    <!-- content-area------------ -->

    <div class="container">
        <div class="left-sidebar">
            <div class="important-links">
                <a href="#"><img src="images/news.png" alt="">Latest News</a>
                <a href="#"><img src="images/friends.png" alt="">Friends</a>
                <a href="#"><img src="images/group.png" alt="">Groups</a>
                <a href="#"><img src="images/marketplace.png" alt="">marketplace</a>
                <a href="#"><img src="images/watch.png" alt="">Watch</a>
                <a href="#">See More</a>
            </div>

            <div class="shortcut-links">
                <p>Your Shortcuts</p>
                <a href="#"> <img src="images/shortcut-1.png" alt="">Web Developers</a>
                <a href="#"> <img src="images/shortcut-2.png" alt="">Web Design Course</a>
                <a href="#"> <img src="images/shortcut-3.png" alt="">Full Stack Development</a>
                <a href="#"> <img src="images/shortcut-4.png" alt="">Website Experts</a>
            </div>
        </div>