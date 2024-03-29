<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Awesome -->
        <script defer src="/assets/fontawesome-free-5.13.0-web/js/all.js"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/Main.css">
        <!-- Inline CSS -->
        <!-- JQuery Initialization Script -->
        <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
        <!-- JQuery Script to bring in Deezer Music API -->
        <script>
            $(document).ready(function(){
                $('#getArtist').submit(function() {
                    $.get($(this).attr('action'), $(this).serialize(), function(res) {
                        var html_string = "";
                        if(res.results.length !== 0) {
                            var_dump(res.results[0]);
                        } else {
                            html_string = "Not found";
                        }
                    }, 'json');
                    // return false;
                });
                // $('#tunes').submit(function() {
                //     $.get($(this).attr('action'), $(this).serialize(), function(res) {
                //         var html_string2 = "";
                //         if(res.results.length !== 0) {
                //             var_dump(res.results[0]);
                //         } else {
                //             html_string2 = "Not found";
                //         }
                //     });
                // }, 'json');
                // $('#pendingrequestsmodal').on('show.bs.modal', function (event) {
                //     var button = $(event.relatedTarget) // Button that triggered the modal
                //     var recipient = button.data('whatever') // Extract info from data-* attributes
                //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                //     var modal = $(this)
                //     modal.find('.modal-title').text('New message to ' + recipient)
                //     modal.find('.modal-body input').val(recipient)
                // });
            });
        </script>
        <!-- Owl Carousel Link Import -->
        <link rel="stylesheet" href="/assets/owl/owl.carousel.css">
        <link rel="stylesheet" href="/assets/owl/owl.theme.default.css">
        <!-- Owl Carousel JavaScript script import -->
        <script src="/assets/owl/owl.js"></script>
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php
            // for($x = 0; $x < count($loggedUser['pendingrequests']); $x++){
            //     // var_dump($loggedUser['pendingrequests'][$x]['Sender']);
            //     // var_dump($x);
            // }
            // var_dump($loggedUser['pendingrequests']);
            // var_dump($loggedUser['sentRequests']);
            // var_dump($loggedUser['receivedRequests']);
        ?>
        <div class="container-fluid">
            <div class="row">
                <!-- sidebar -->
                <div class="no-padding sidebar">
                    <!-- music col -->
                    <div class="music mt-0">
                        <ul class="list-group list-group-flush">
                            <div  class="list-group-item nav-logo py-2" style="height: 114px;" id="sidebartop">
                                <!-- <h1>Test Beta</h1> -->
                                <section>
                                    
                                    <div style="margin: 0px 0px 0px 0xp;" class="cloud"></div>
                                    
                                    
                                    <div style="margin: 0px 0px 0px 0xp;" class="cloud"></div>
                                    
                                    <div style="margin: 0px 0px 20px 43px;" class="balloon">
                                        <div class="bottom"></div>
                                        <div class="basket"></div>
                                        <div class="rope"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="list-group-item text-uppercase nav-color mt-3">
                                Welcome, <?= $loggedUser['FirstName'] ?> <i style="color: #fa3a66;" class="fab fa-angellist"></i>
                            </div>
                            <a <?php echo "href=/user/show/" . $this->session->userdata('UserId') ?> class="list-group-item list-group-item-action">
                                <i class="far fa-user mr-3 nav-color"></i>
                                View Profile
                            </a>
                            <a href="/song/new" class="list-group-item list-group-item-action">
                                <i class="fa fa-music mr-3 nav-color"></i>
                                Upload Song
                            </a>
                            <a href="/signout" class="list-group-item list-group-item-action">
                                <i class="fas fa-sign-out-alt mr-3 nav-color"></i>
                                Logout
                            </a>
                            <a href="/edit" class="list-group-item list-group-item-action">
                                <i class="far fa-id-card mr-3 nav-color"></i>
                                Manage Pofile
                            </a>
                            <!-- <a href="" class="list-group-item list-group-item-action">
                                <i class="fa fa-music mr-3 nav-color"></i>
                                Liked
                            </a>
                            <a href="" class="list-group-item list-group-item-action">
                                <i class="fa fa-music mr-3 nav-color"></i>
                                Download
                            </a> -->
                            <!-- <a href="" class="list-group-item list-group-item-action">
                                <i class="fa fa-music mr-3 nav-color"></i>
                                Play History
                            </a> -->
                        </ul>
                    </div>
                    <!-- My Music column -->
                    <!-- My Music List -->
                    <div class="my-music-list">
                        <ul class="list-group list-group-flush">
                            <div class="list-group-item text-uppercase nav-color mt-3">
                                Radio
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Station" method="GET" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "20">
                                    <input id="getArtistbutton2" type="submit" value="Rap">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "33">
                                    <input id="getArtistbutton2" type="submit" value="R&B">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "10">
                                    <input id="getArtistbutton2" type="submit" value="Rock">
                                </form>
                            </div>
                            <!-- <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "7">
                                    <input id="getArtistbutton2" type="submit" value="Electro">
                                </form>
                            </div> -->
                            <!-- <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "13">
                                    <input id="getArtistbutton2" type="submit" value="Indie Pop">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "16">
                                    <input id="getArtistbutton2" type="submit" value="Pop">
                                </form>
                            </div> -->
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "17">
                                    <input id="getArtistbutton2" type="submit" value="Hard Rock">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "18">
                                    <input id="getArtistbutton2" type="submit" value="Dance">
                                </form>
                            </div>
                            <!-- <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "19">
                                    <input id="getArtistbutton2" type="submit" value="Soul">
                                </form>
                            </div> -->
                            <!-- <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "21">
                                    <input id="getArtistbutton2" type="submit" value="Funk">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "31">
                                    <input id="getArtistbutton2" type="submit" value="Punk">
                                </form>
                            </div> -->
                            <!-- <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "27">
                                    <input id="getArtistbutton2" type="submit" value="Classic">
                                </form>
                            </div> -->
                            <!-- <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "22">
                                    <input id="getArtistbutton2" type="submit" value="Metal">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "20">
                                    <input id="getArtistbutton2" type="submit" value="Vocal Jazz">
                                </form>
                            </div>
                            <div class="list-group-item list-group-item-action text-uppercase">
                                <i class="fas fa-broadcast-tower" style="color: #ced0ce;"></i>
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
                                    <input type="hidden" name="Station" value= "25">
                                    <input id="getArtistbutton2" type="submit" value="Disco">
                                </form>
                            </div> -->
                            
                        </ul>
                        <!-- <a href="" class="btn nav-btn w-50 mt-4 mx-3 d-block">Explore</a> -->
                    </div>
                </div>
                <!-- end of sidebar -->

                <!-- Main content -->

                <div class="col-md-9 col-lg-10 order-1 order-md-2 content bg-light p-5" style="margin: 0px 0px 0px 213px;">

                    <!-- Main row -->
                    <div class="row">
                        <div class ="col d-flex flex-wrap justify-content-between pb-5">
                            <!-- nav search -->

                            <div class="nav-search d-flex flex-wrap">
                                <!-- form -->

                                <div class="soundWaveAnimation2">
                                        <div class="superduperbars superduperbars--paused">
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                            <div class="bar"></div>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        const bars = document.querySelectorAll('.bar');
                                        let intervalValue = 0;

                                        const delay = time => new Promise(resolve => setTimeout(resolve, time));

                                        [...bars].map((bar) => {
                                            delay(0).then(() => {
                                                setTimeout(() => {
                                                    bar.style.animation = 'sound 500ms linear infinite alternate'
                                                }, intervalValue += 100)
                                            })
                                        })
                                    </script>
                                
                                    
                                    <!-- <h4 style="display: block;" class="align-self-center">Featured Artists <i style="color: #6c757d;" class="fas fa-microphone"></i></h4>
                                    <br>
                                    <form id="getArtist" action="/Song/getArtist" method="POST">
                                        <select style="background: #f7174c; color: #fff; padding: 10px; width: 250px; height: 50px; border: none; font-size: 20px; box-shadow: 0 5px 25px; -webkit-appearance: button; outline: none;" name="Artist">
                                            <option>Please Select Artist</option>
                                            <option class="artistSearchBox" value="3"><i class="fas fa-music"></i> Snoop Dogg</option>
                                            <option class="artistSearchBox" value="4937383"><i class="fas fa-music"></i> Ozuna</option>
                                            <option class="artistSearchBox" value="211190">Pharrell</option>
                                            <option class="artistSearchBox" value="4962010">Migos</option>
                                            <option class="artistSearchBox" value="413596">Meek Mill</option>
                                            <option class="artistSearchBox" value="12178">Calvin Harris</option>
                                            <option class="artistSearchBox" value="1">Beatles</option>
                                        </select>
                                        <button style="background-color: transparent; border: none;" type="submit" value="View Artist"><i id="buttonAnimation" class="fa fa-search ButtonToggle"></i></button>
                                    </form> -->
                                

                            </div>

                            <!-- Avatar -->
                            <div class="avatar-icon.d-flex.flex-wrap">
                                <h6 class="mr-3 align-self-center" style="margin: 0px 0px 0px 25px;"><?php echo $loggedUser['FirstName'] . " " . $loggedUser['LastName'] ?><i style="color: #6c757d; margin: 0px 0px 0px 7px;" class="fab fa-android"></i></h6>
                                <br>
                                <div style="display: grid; grid-template-columns: repeat(5, 1fr);">
                                    <a style="grid-column: 2; grid-row: 1/2;" href=""><img class="img-fluid rounded-circle" width="34" <?php echo "src=" . $loggedUser['user']['ProfilePicUrl']  ?>></a>
                                    <button style="margin: 10px 0px 0px 0px; grid-column: -1 / 3; grid-row: 1 / 2; background: transparent; border: none;" data-toggle="modal" data-target="#pendingrequestsmodal" ><i style="height: 43px; width: 50px;" class="fas fa-user-friends"></i></button>

                                    
                                    <?php if(count($loggedUser['pendingrequests']) > 0) { ?>
                                    <div style="color: white; background-color: #fa3a66; transform: scale(0.7); height: 27px; grid-row: 1/2; grid-column: -1 / 3; width: 25px; margin: -6px 0px 0px 63px;"><p style="margin: 0px 0px 0px 8px;"><?php echo count($loggedUser['pendingrequests']); ?></p></div>
                                    <?php } ?>
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="modal fade" id="pendingrequestsmodal" tabindex="-1" role="dialog" aria-labelledby="test" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Lato', sans-serif; font-weight: bolder;" class="modal-title" id="test"><?= count($loggedUser['pendingrequests']); ?> Pending Friend Requests</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                        <h1>Received Requests</h1>
                                        <?php
                                            for($e=0; $e < count($loggedUser['receivedRequests']); $e++){
                                        ?>
                                            <div class="carousel-item active">
                                                
                                                <img style="border-radius: 7px;" class="d-block w-100" src=<?= $loggedUser['receivedRequests'][$e]['ProfilePicUrl'] ?> >
                                                <div class="waffles3">
                                                    <a class="waffles2" <?php echo "href = /user/show/" . $loggedUser['receivedRequests'][$e]['UserId'] ?>  ><button class="btn btn-primary">View Profile</button></a>
                                                    <form class="friendrequestbutton" <?php echo "action = declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['receivedRequests'][$e]['UserId']?>  method="POST">
                                                        <input type="hidden" name="boolean" value="TRUE" />
                                                        <input type="submit" value="Accept Request" />
                                                    </form>
                                                </div>
                                            </div>
                                        
                                        <?php
                                            }
                                        ?>

                                            
                                                <!-- <div class="carousel-item">
                                                <img class="d-block w-100" src="..." alt="Second slide">
                                                </div>
                                                <div class="carousel-item">
                                                <img class="d-block w-100" src="..." alt="Third slide">
                                                </div> -->
                                        </div>
                                        <h1>Sent Requests</h1>
                                        <?php 
                                            for($e=0; $e < count($loggedUser['sentRequests']); $e++){
                                        ?>
                                            <div class="carousel-item active">  
                                                <img style="border-radius: 7px;" class="d-block w-100" src=<?= $loggedUser['sentRequests'][$e]['ProfilePicUrl'] ?> >
                                                <div class="waffles3">
                                                    <a class="waffles2" <?php echo "href = /user/show/" . $loggedUser['sentRequests'][$e]['UserId'] ?>  ><button class="btn btn-primary">View Profile</button></a>
                                                    <form class="friendrequestbutton" <?php echo "action = declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['sentRequests'][$e]['UserId']?>  method="POST">
                                                        <input type="hidden" name="boolean" value="TRUE" />
                                                        <input type="submit" value="Cancel Request" />
                                                    </form>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    <!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a> -->
                                    </div>
                                </div>
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    

                    <!-- End of top row -->
                    <hr>
                    <!-- pictures navigation-->

                    <div class = "row">
                        <div class = "col pt-4 pb-2">
                            <h4 style="margin: 0px 0px 0px 52px;">Recently Uploaded <i style="color: #6c757d;" class="fa fa-music"></i></h4>
                        </div>
                    </div>
                    <br>
                    <!-- pictures row -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div id="top-songs" class="owl-carousel owl-theme" style="margin: 0px 0px 0px 40px;">
                                <?php
                                for($x = 0; $x < count($songs['AllSongs']); $x++){ ?>
                                <div class="item text-center" style="margin: 0px 0px 0px 0xp;">
                                    <h6 class="mb-0"><?= $songs['AllSongs'][$x]['Artist'] ?></h6>
                                    <p class="text-muted mb-0"><?= $songs['AllSongs'][$x]['Name'] ?></p>
                                    <!-- <div class="img-container"> -->
                                        <img src="/assets/images/musicicon.jpg" style="width: 200px; height: 170px; display: block; border-radius: 7px;">
                                        <audio style="width: 200px; border-radius: 7px;" <?php echo "src=" . $songs['AllSongs'][$x]['Url'] ?> controls></audio>
                                        <div>
                                            <a id="buttonAnimation" class="ButtonToggle" <?php echo "href=/song/show/" . $songs['AllSongs'][$x]['SongId'] ?> style="margin: 0px 20px 0px 0px;"><i class="fa fa-music"></i></a>
                                            <a id="buttonAnimationLike" class="ButtonToggle" style="margin: 0px 0px 0px 7px;" <?php echo "href=/like/create/" . $this->session->userdata('UserId') . "/" . $songs['AllSongs'][$x]['SongId'] ?> ><i class="far fa-thumbs-up"></i></a>
                                            <a id="buttonAnimation" class="ButtonToggle" style="margin: 0px 0px 0px 7px;" <?php echo "href=/dislike/" . $this->session->userdata('UserId') . "/" . $songs['AllSongs'][$x]['SongId'] ?> ><i class="far fa-thumbs-down"></i></a>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end of first carousel -->
                    <hr>
                    <!-- FriendsList and second carousel -->
                    <div class="row align-items-center" style="margin: 0px 0px 0px 52px;">
                        <div class="col-sm-6 no-padding my-5">
                            <div class="d-flex justify-content-between mb-3">
                                    <h4 style="margin: 0px 0px 0px 7px;" class="align-self-center">Friends <i style="color: #6c757d;" class="fas fa-user-friends"></i></h4>
                            </div>
                            <!-- end of title -->
                            <!-- Friends List -->

                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php for($t=0; $t < count($loggedUser['friends']); $t++){ 
                                    if($t == 0){
                                    ?>
                                    <div class="carousel-item active">
                                        <a <?php echo "href=/user/show/" . $loggedUser['friends'][$t]['UserId'] ?>  ><img style="width: 175px; height: 250px; border-radius: 7px;" class="d-block w-100" src=<?php echo "" . $loggedUser['friends'][$t]['ProfilePicUrl'] ?> alt="First slide"></a>
                                    </div>
                                    <?php } else { ?>
                                    <div class="carousel-item">
                                        <a <?php echo "href=/user/show/" . $loggedUser['friends'][$t]['UserId'] ?>  > <img style="width: 175px; height: 250px; border-radius: 7px;" class="d-block w-100" src=<?php echo "" . $loggedUser['friends'][$t]['ProfilePicUrl'] ?> alt="Second slide"></a>
                                    </div>
                                    <!-- <div class="carousel-item">
                                    <img class="d-block w-100" src="..." alt="Third slide">
                                    </div> -->
                                    <?php 
                                        }
                                    } ?>
                                </div>
                            </div>

                            <!-- <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col" class="text-muted">Song</th>
                                            <th scope="col" class="text-muted"></th>
                                            <th scope="col" class="text-muted"></th>
                                            <th scope="col" class="text-muted"></th>
                                        </tr>
                                    </thead>
                            </table> -->
                        <!--  closing table container div  -->
                        </div>
                        <!-- end of table -->

                        
                        <!-- Deezer Api Content Featured Artists and Playlist -->
                        <div class="col-sm-6">
                        <div class="d-flex justify-content-between mb-3">
                                <h4 style="margin: 0px 0px 0px 133px;" class="align-self-center">Playlist <i style="color: #6c757d;" class="fa fa-music"></i></h4>
                            </div>
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                
                                <div class="carousel-inner">
                                    <?php
                                    for($u=0; $u < count($liked_songs['Playlist']); $u++){
                                        if($u == 0){
                                    ?>
                                        <div class="carousel-item active">
                                            <div style="margin: 0px 0px 0px 70px;">
                                                <h6 class="mb-0"><?= $liked_songs['Playlist'][$u]['Name'] ?></h6>
                                                <p class="text-muted mb-0"><?= $liked_songs['Playlist'][$u]['Artist'] ?></p>
                                                <br>
                                                <!-- <img src="/assets/images/musicicon.jpg" style="width: 270px; height: 170px; display: block; border-radius: 7px;"> -->
                                                <audio style="border-radius: 7px;" controls src=<?php echo "" . $liked_songs['Playlist'][$u]['Url'] ?>></audio>
                                                <div style="display: block;">
                                                    <a id="buttonAnimation" class="ButtonToggle playlistButton"  href=""><i class="fa fa-music"></i></a>
                                                    <a id="buttonAnimation" class="ButtonToggle playlistButton2"  <?php echo "href=/dislike/" . $this->session->userdata('UserId') . "/" . $liked_songs['Playlist'][$u]['SongId'] ?> ><i class="far fa-thumbs-down"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="carousel-item">
                                            <div style="margin: 0px 0px 0px 70px;">
                                                <h6 class="mb-0"><?= $liked_songs['Playlist'][$u]['Name'] ?></h6>
                                                <p class="text-muted mb-0"><?= $liked_songs['Playlist'][$u]['Artist'] ?></p>
                                                <br>
                                                <audio style="border-radius: 7px;" controls src=<?php echo "" . $liked_songs['Playlist'][$u]['Url'] ?>></audio>
                                                <div style="display: block;">
                                                    <a id="buttonAnimation" class="ButtonToggle playlistButton"  href=""><i class="fa fa-music"></i></a>
                                                    <a id="buttonAnimation" class="ButtonToggle playlistButton2"  <?php echo "href=/dislike/" . $this->session->userdata('UserId') . "/" . $liked_songs['Playlist'][$u]['SongId'] ?> ><i class="far fa-thumbs-down"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                
                            </div>
                            
                            <br>
                            <br>
                            <br>
                            <div class="d-flex justify-content-between mb-3" style="margin: 0px 0px 0px 106px;">
                                <h4 class="align-self-center">Featured Artists <i style="color: #6c757d;" class="fas fa-microphone"></i></h4>
                            </div>
                            <div style="margin: 0px 0px 0px 25px;">
                                <form id="getArtist" action="/Song/getArtist" method="POST">
                                    <select class="custom-select" id="supercustomselect" name="Artist">
                                        <option selected>Please Select An Artist</option>
                                        <option value="3">Snoop Dogg</option>
                                        <option value="73">Nas</option>
                                        <option value="211190">Pharrell</option>
                                        <option value="246791">Drake</option>
                                        <option value="92">Linkin Park</option>
                                        <option value="1309">Jay-Z</option>
                                        <option value="1">Beatles</option>
                                        <option value="398521">Lil Baby</option>
                                    </select>
                                    <button class="superbtn btn1">
                                        View Artist
                                    </button>
                                </form>
                            </div>
                            
                        </div>
                        <!-- <div class="soundWaveAnimation">
                            <div class="wrapper">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div> -->
                    </div>

                </div>

            <!-- end of row -->
            </div>
        </div>
        
        
        <script src="/assets/owl/owl.carousel.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>