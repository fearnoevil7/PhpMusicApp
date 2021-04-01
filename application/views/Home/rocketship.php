<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            *{
                padding: 0;
                margin: 0;
                background-color: #330066;
            }
            .container{
                height: 500px;
                width: 500px;
                /* border: 2px solid white; */
                position: absolute;
                margin: auto;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }
            .cloud{
                background-color: white;
                height: 50px;
                width: 200px;
                border-radius: 50px;
                position: absolute;
                opacity: 0.1;
            }
            .cloud:before{
                position: absolute;
                content: "";
                height: 100px;
                width: 100px;
                background-color: white;
                border-radius: 50%;
                bottom: 25px;
                left: 80px;
            }
            .cloud:after{
                position: absolute;
                content: "";
                height: 80px;
                width: 80px;
                background-color: white;
                border-radius: 50%;
                bottom: 25px;
                left: 25px;
            }
            .cloud:nth-child(1){
                top: 230px;
                left: 0;
            }
            .cloud:nth-child(2){
                top: 340px;
                left: 260px;
                transform: scale(0.8);
            }
            .balloon{
                height: 200px;
                width: 200px;
                background-color: #f7174c;
                border-radius: 50%;
                position: absolute;
                top: 100px;
                left: 140px;
                animation: float 4.5s infinite;
            }

            @keyframes float{
                50%{
                    transform: translateY(50px);
                }
            }

            .balloon:before{
                position: absolute;
                content: "";
                height: 200px;
                width: 140px;
                background-color: #fb84a0;
                border-radius: 50%;
                left: 30px;
            }
            .balloon:after{
                position: absolute;
                content: "";
                height: 200px;
                width: 80px;
                background-color: #f7174c;
                border-radius: 50%;
                left: 60px;
                top: 0;
            }

            .bottom{
                background-color: #f7174c;
                height: 20px;
                width: 90px;
                position: relative;
                top: 188px;
                left: 53px;
            }
            .basket{
                height: 50px;
                width: 70px;
                background-color: #fa3a66;
                position: relative;
                top: 240px;
                left: 62.5px;
                border-radius: 0 0 10px 10px;
            }

            .basket:before{
                position: absolute;
                content: "";
                background-color: #f7174c;
                height: 7px;
                width: 80px;
                border-radius: 7px;
                left: -5px;
            }
            .rope{
                background-color: #db343c;
                height: 55px;
                width: 3px;
                position: relative;
                top: 137px;
                left: 96.5px;
            }
            .rope:before{
                position: absolute;
                content: "";
                background-color: #db343c;
                height: 55px;
                width: 3px;
                top: 0;
                left: -38px;
                transform: rotate(-8deg);
            }
            .rope:after{
                position: absolute;
                content: "";
                background-color: #db343c;
                height: 55px;
                width: 3px;
                top: 0;
                left: 38px;
                transform: rotate(8deg);
            }

        </style>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="cloud"></div>
            <div class="cloud"></div>
            <div class="balloon">
                <div class="bottom"></div>
                <div class="basket"></div>
                <div class="rope"></div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>