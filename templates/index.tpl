<!DOCTYPE html>
<html>
    <head>
        <title>SocialHub: Gronkh</title>

        <link rel="stylesheet" href="/css/materialize.css">
        <link rel="stylesheet" href="/css/custom.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container">
            <nav>
                <div class="nav-wrapper orange">
                    <a href="#!" class="brand-logo center">SocialHub</a>
                    <ul class="left hide-on-med-and-down">
                        <li>
                            <a href="index.php">Test</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="row">
                <div class="col l8 offset-l2">
                    <h3 class="center-align">Gronkhs Feed</h3>
                </div>
            </div>
            <div class="row" id="feed">
                <!--<div class="col l8 offset-l2">

                </div>-->
                {posts}
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="js/materialize.min.js"></script>
    </body>
</html>