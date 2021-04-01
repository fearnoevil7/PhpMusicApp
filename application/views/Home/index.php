<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Awesome -->
        <script defer src="/assets/fontawesome-free-5.13.0-web/js/all.js"></script>

        <link rel="stylesheet" href="/assets/css/LoginAndRegistration.css">


        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet"> 
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
                <?php
                    // var_dump($test['ProfilePic']);
                    // var_dump($test['test']);
                    // if($this->session->userdata('test') != null){
                    //     var_dump($this->session->userdata('test'));
                    // }
                ?>
                <?php
                    if($this->session->flashdata('EncryptPassCheck') != null){
                        echo "<p style = color: red;>" . $this->session->flashdata('EncryptPassCheck') . "</p>";
                    }
                    if($this->session->flashdata('message') != null){
                        echo "<p>" . $_SESSION['message'] . "</p>";
                    }
                    if($this->session->flashdata('errors') != null){
                        foreach($_SESSION['errors'] as $error){
                            echo "<p style = color: red;>" . $error . "</p>";
                        }
                    }
                ?>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="register" method="POST" enctype="multipart/form-data">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="FirstName" placeholder="First Name"/>
                <input type="text" name="LastName" placeholder="Last Name"/>
                <input type="text" name="Email" placeholder="Email"/>
                <input type="text" name="Password" placeholder="Password"/>
                <input type="text" name="ConfirmPassword" placeholder="Confirm Password"/>
                <p><u>Upload Profile Pic(optional)</u></p>
                <input type="file" name="profilepic" />
                <button style="margin: 25px 0px 25px 0px; border-radius: 20px;">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="signin" method="POST">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <span>Email: </span><input type="text" name="Email" placeholder="Email"/>
                <span>Password</span><input type="text" name="Password" placeholder="Password"/>
                <a href="#">Forgot your password?</a>
                <button style="margin: 25px 0px 0px 0px; border-radius: 20px;">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Greetings, please create an account!</h1>
                    <p>Please fill out all the necessary information needed!</p>
                    <button class="ghost" id="signIn" style="border-radius: 20px;">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>If you are already a member please sign in!</h1>
                    <p>Dont have an account? Sign up!!!</p>
                    <button class="ghost" id="signUp" style="border-radius: 20px;">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
        <!-- <div class="formContainer" id="formContainer">
            <h1>Welcome!</h1>
            <div>
                
                <div class="form-container sign-up-container">
                    <form action="register" method="POST" enctype="multipart/form-data">
                        <h1>Register</h1>
                        <span>First Name: </span><input type="text" name="FirstName" />
                        <span>Last Name: </span><input type="text" name="LastName" />
                        <span>Email: </span><input type="text" name="Email" />
                        <span>Password</span><input type="text" name="Password" />
                        <span>Confirm Password</span><input type="text" name="ConfirmPassword" />
                        <p><u>Upload Profile Pic(optional)</u></p>
                        <input type="file" name="profilepic" />
                        <button>Register</button>
                    </form>
                </div>
            </div>
            <div class="form-container sign-in-container">
                <form action="signin" method="POST">
                    <h1>Login</h1>
                    <span>Email: </span><input type="text" name="Email" />
                    <span>Password</span><input type="text" name="Password" />
                    <button style="border-radius: 20px;">Login</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="login">Login</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="register">Register</button>
                    </div>
                </div>
            </div>
        </div> -->
        <script src="/assets/javascript/loginAndRegistration.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>