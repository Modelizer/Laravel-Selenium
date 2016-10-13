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
            <h1>Forms Test</h1>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php
                        if (!empty($_POST)) {
                            ?>

                        <h3>Form successfully submitted</h3>
                    <?php

                        } else {
                            ?>
                        <form class="form-horizontal" method="post" id="newAccount">
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="inputEmail">Email:</label>
                                <div class="col-xs-9">
                                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="inputPassword">Password:</label>
                                <div class="col-xs-9">
                                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="confirmPassword">Confirm Password:</label>
                                <div class="col-xs-9">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="firstName">First Name:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="lastName">Last Name:</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="phoneNumber">Phone:</label>
                                <div class="col-xs-9">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Date of Birth:</label>
                                <div class="col-xs-3">
                                    <select class="form-control" name="dateDOB">
                                        <option>Date</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <select class="form-control" name="monthDOB">
                                        <option>Month</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <select class="form-control" name="yearDOB">
                                        <option>Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="postalAddress">Address:</label>
                                <div class="col-xs-9">
                                    <textarea rows="3" class="form-control" id="postalAddress" name="postalAddress" placeholder="Postal Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" for="ZipCode">Zip Code:</label>
                                <div class="col-xs-9">
                                    <input type="number" class="form-control" id="ZipCode" name="zipCode" placeholder="Zip Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Gender:</label>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="genderRadios" value="male" name="gender"> Male
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="genderRadios" value="female" name="gender"> Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="news" name="news"> Send me latest news and updates.
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="agree" name="terms_and_conditions">  I agree to the <a href="#">Terms and Conditions</a>.
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-xs-offset-3 col-xs-9">
                                    <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                                    <input type="reset" class="btn btn-default" value="Reset">
                                </div>
                            </div>
                        </form>
                            <?php

                        }
                    ?>
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