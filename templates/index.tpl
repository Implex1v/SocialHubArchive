<!DOCTYPE html>
<html>
    <head>
        <title>SocialHub: Gronkh</title>

        <link rel="stylesheet" href="/css/materialize.css">
        <link rel="stylesheet" href="/css/custom.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container">
            <nav class="orange">
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo center">SocialHub - Gronkh</a>
                    <ul class="left hide-on-med-and-down">
                        <li>
                            <a href="index.php">Test</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="row" style="padding-top: 20px;">
                <div class="col l12">
                    <div class="col l12 orange z-depth-1" style=" padding: 10px;">
                        <div class="col l6 offset-l3">
                            <div class="col l3">
                                <a href="#" id="filterToggleTwitch" class="filter-button" onclick="toggleFilter('Twitch', this)">
                                    <i class="fa fa-twitch filter-icon" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col l3">
                                <a href="#" id="filterToggleTwitter" class="filter-button" onclick="toggleFilter('Twitter', this)">
                                    <i class="fa fa-twitter filter-icon" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col l3">
                                <a href="#" id="filterToggleInstagram" class="filter-button" onclick="toggleFilter('Instagram', this)">
                                    <i class="fa fa-instagram filter-icon" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col l3">
                                <a href="#" id="filterToggleYoutube" class="filter-button" onclick="toggleFilter('Youtube', this)">
                                    <i class="fa fa-youtube filter-icon" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="feed">
                {posts}
            </div>
        </div>

        <span style="display: none" id="lastPostTime">{lastPostTime}</span>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="js/materialize.min.js" type="application/javascript"></script>
        <script src="js/custom.js" type="application/javascript"></script>
    </body>
</html>