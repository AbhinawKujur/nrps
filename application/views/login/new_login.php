<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" 
    media="screen,projection"/>

    <!-- QUERYMINE Page Center Css -->

    <style>
            html,
        body {
            height: 100%;
        }
        html {
            display: table;
            margin: auto;
        }
        body {
            display: table-cell;
            vertical-align: middle;
        }
        .card-panel {
            width: 374px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }
    </style>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body class="cyan">

        <!-- Form Section -->

      <form action="<?php echo base_url('login/loggedIn'); ?>" method="POST"> <!-- Change The Form Method From Here-->
    <div class="card-panel z-depth-5" width="50%">

        <!-- Form Logo Section  -->

        <div class="row margin">
            <div class="col s12 m12 l12 center">
                <img src="<?php echo base_url($schoolData['SCHOOL_LOGO']); ?>" alt="" class="responsive-img circle" style="width:100px;">
                <h5>Login Here</h5>
            </div>
        </div>

        <div class="row margin">
            <div class="col s12 m12 l12 center">
                  <?php if($this->session->flashdata('msg')){ ?>
                    <p class="alert alert-danger">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </p>
                <?php } ?>
            </div>
        </div>

        <!-- Form Username Input Section -->

        <div class="col s12 m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input type="text" name="Username" id="username" required="" style="text-transform: uppercase;" autocomplete="off">
                <label for="username">Username</label>
            </div>
        </div>

        <!-- Form Password Input Section -->

        <div class="col m12 l12">
            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input type="password" name="pass" id="pass" required="" autocomplete="off">
                <label for="password">Password</label>
            </div>
        </div>

            <!-- Form Chekbox (Remember Me) Input Section -->

        <!-- <div class="left">
            <input type="checkbox" id="checkbox">
            <label for="checkbox">Remember Me</label>
        </div> -->
        <br><br>

            <!-- Form Button Section  -->

        <div class="center">
            <button type="submit" name="login" 
            class="btn waves-effect waves-light " 
            style="width:100%; background-color: #ff4081;">Login</button>
        </div>

            <!-- Form "Register Now" And "Forgot Password" Link Section. -->

        <div class="" style="font-size:14px;"><br>
            <a href="<?php echo base_url('forgot_password/Forgot_password'); ?>" class="right ">Forgot Password?</a>
        </div><br>
    </div>
</form>



              
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" 
    src="https://code.jquery.com/jquery-2.1.1.min.js">
    </script>
    <script type="text/javascript" src=
"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js">
    </script>
  </body>
</html>