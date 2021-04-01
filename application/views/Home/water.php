<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            * {
                margin: 0;
                padding: 0;
            }
            section
            {
                position: relative;
                width: 100%;
                height: 100vh;
                background-color: #3586ff;
                overflow: hidden;
            }
            section .wave
            {
                position: absolute;
                bottom: 0;
                top: 90%;
                left: 0;
                width: 100%;
                height: 100px;
                background: url('../assets/animationimages/drawnocean.png');
                background-size: 1000px 100px;
            }
            section .shark
            {
                /* position: absolute; */
                /* margin: 0px 0px 0px 0px; */
                width: 175px;
                height: 175px;
                /* bottom: 0; */
                /* left: -600; */
                background: url('../assets/animationimages/sharkfin4.png.svg');
                /* animation: animate 30s linear infinite;
                transform: scale(0.3);
                z-index: 1000;
                opacity: 1;
                animation-delay: 0s; */
                /* overflow: hidden; */
            }
            
            section .wave.wave1
            {
                animation: animate 30s linear infinite;
                z-index: 1000;
                opacity: 1;
                animation-delay: 0s;
                bottom: 5;
            }
            section .wave.wave2
            {
                animation: animate 25s linear reverse infinite;
                z-index: 999;
                opacity: 0.5;
                animation-delay: -5s;
                bottom: 10px;
            }
            section .wave.wave3
            {
                animation: animate 20s linear infinite;
                z-index: 998;
                opacity: 0.5;
                animation-delay: -2s;
                bottom: 15;
            }
            section .wave.wave4
            {
                animation: animate 25s linear infinite reverse;
                z-index: 997;
                opacity: 0.7;
                animation-delay: -5s;
                bottom: 20px;
            }
            @keyframes animate
            {
                0%
                {
                    background-position-x: 0;
                }
                100%
                {
                    background-position-x: 1000px;
                }
            }
            @keyframes slide
            {
                0%
                {
                    margin-left: -1000px;
                }
                100%
                {
                    margin-left: 100%;
                }
            }

            @keyframes animateCloud
            {
                0%{margin-left: -1000px;}
                100%{margin-left: 100%;}
            }
            /* @keyframes shimmy {
                0% {
                    transform: translate(0,0);
                }
                20% {
                    transform: translate(-10vh,-10vh);
                    opacity: .8;
                }
                40% {
                    transform: translate(10vh,-20vh);
                    opacity: .6;
                }
                60% {
                    transform: translate(-10vh,-30vh);
                    opacity: .4;
                }
                80% {
                    transform: translate(10vh,-40vh);
                    opacity: .2;
                }
                100% {
                    transform: translate(-10vh,-50vh);
                    opacity: 0;
                }
            } */
            @keyframes swim {
                0% {
                    margin-left: -1000px;
                }
                /* 20% {
                    transform: translate(-10vh,-10vh);
                    opacity: .8;
                }
                40% {
                    transform: translate(10vh,-20vh);
                    opacity: .6;
                }
                60% {
                    transform: translate(-10vh,-30vh);
                    opacity: .4;
                }
                80% {
                    transform: translate(10vh,-40vh);
                    opacity: .2;
                } */
                100% {
                    margin-left: 100%;
                }
            }
            .sharkswim
            {
                margin: 94px 0px 0px 0px;
                animation: swim 20s linear infinite reverse;
                transform: scale(0.43);
            }

            .x1
            {
                animation: animateCloud 35s linear infinite reverse;
                transform: scale(0.3);
            }
            .x2
            {
                animation: animateCloud 20s linear infinite;
                transform: scale(0.65);
            }
            .x3
            {
                animation: animateCloud 15s linear infinite;
                transform: scale(0.5);
            }
            .x4
            {
                animation: animateCloud 18s linear infinite;
                transform: scale(0.4);
            }
            .x5
            {
                animation: animateCloud 25s linear infinite;
                transform: scale(0.55);
            }

            .cloud
            {
                background: white;
                background: linear-gradient(top, white 5%, #f1f1f1 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="white", endColorstr='#f1f1f1', GradientType=0);
                border-radius: 100px;
                box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);
                height: 120px;
                position: relative;
                width: 350px;
            }

            .cloud:after, .cloud:before
            {
                background: white;
                content: "";
                position: absolute;
                z-index: -1;
            }

            .cloud:after
            {
                border-radius: 100px;
                height: 100px;
                left: 50px;
                top: -50px;
                width: 100px;
            }

            .cloud:before
            {
                border-radius: 200px;
                height: 180px;
                width: 180px;
                left: 50px;
                top: -90px;
            }

        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script>
            $(document).ready(function(){
                var boxWidth = $(".shark").width();
                $()
            })
        </script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <section>
            
            <div class="x1">
                <div class="cloud"></div>
            </div>
            
            <div class="x2">
                <div class="cloud"></div>
            </div>
            
            <div class="x3">
                <div class="cloud"></div>
            </div>
            
            <!-- <div class="x4">
                <div class="cloud"></div>
            </div>
            
            <div class="x5">
                <div class="cloud"></div>
            </div> -->
            
            
            <div class="sharkswim">
                <!-- <div class="shark"></div> -->
                <img src="../assets/animationimages/sharkfin4.png.svg">
            </div>

            <div class="wave wave1" id="1"></div>
            <div class="wave wave2" id="2"></div>
            <div class="wave wave3" id="3"></div>
            <div class="wave wave4" id="4"></div>
            
        </section>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>