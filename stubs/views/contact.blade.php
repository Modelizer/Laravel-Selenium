<!DOCTYPE html>
<html>
<head>
    <title>Selenium Test HTML File</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
        }
    </style>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/tests/html/main.html">Start Testing Today!</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/tests/html/about.html">About</a>
                </li>
                <li>
                    <a href="/tests/html/forms.php">Forms</a>
                </li>
                <li>
                    <a href="/tests/html/contact.php">Contact Us</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12 text-center">
            <h1>Contact Us</h1>
            <iframe width="600" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-77.48382568359374%2C38.70533855257685%2C-76.71821594238281%2C39.08210619353512&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="http://www.openstreetmap.org/#map=11/38.8940/-77.1010&amp;layers=N">View Larger Map</a></small>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form method="post" action="/tests/html/contact.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" ></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <p>Developed by:</p>
            <ul class="list-unstyled">
                <li>Mohammed Mudasir (https://github.com/Modelizer)</li>
                <li>John Hoopes (https://github.com/jhoopes)</li>
            </ul>
        </div>
    </div>
    <!-- /.row -->

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>