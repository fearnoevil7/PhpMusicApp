<!doctype html>
<html lang="en">
    <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <style>
        #getArtistbutton{
                background: none!important;
                border: none;
                padding: 0!important;
                /*optional*/
                font-family: arial, sans-serif;
                /*input has OS specific font-family*/
                color: #069;
                text-decoration: underline;
                cursor: pointer;
            }
    </style> -->
    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
        <script>
            $(document).ready(function(){
                // $('#getArtist').submit(function() {
                //     $.get($(this).attr('action'), $(this).serialize(), function(res) {
                //         var html_string = "";
                //         if(res.results.length !== 0) {
                //             var_dump(res.results[0]);
                //         } else {
                //             html_string = "Not found";
                //         }
                //     }, 'json');
                //     // return false;
                // });
                $("#ArtistVinyls").click(function() {
                    $('#tunes').submit(function() {
                        $.get($(this).attr('action'), $(this).serialize(), function(res) {
                            // var html_string2 = "";
                            // if(res.results.length !== 0) {
                            //     var_dump(res.results[0]);
                            // } else {
                            //     html_string2 = "Not found";
                            // }
                        });
                    }, 'json');
                });
                
            });
        </script>
                <!-- Font Awesome -->
                <script defer src="/assets/fontawesome-free-5.13.0-web/js/all.js"></script>
        <link rel="stylesheet" href="/assets/css/Main.css">
        <!-- Owl Carousel Link Import -->
        <link rel="stylesheet" href="/assets/owl/owl.carousel.css">
        <link rel="stylesheet" href="/assets/owl/owl-redux3.carousel.css">
        <link rel="stylesheet" href="/assets/owl/owl.theme.default.css">
        <!-- Owl Carousel JavaScript script import -->
        <script src="/assets/owl/owl.carousel.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
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
                            <a href='/dashboard/<?= $this->session->userdata('UserId') ?>' class="list-group-item list-group-item-action">
                                <i class="far fa-user mr-3 nav-color"></i>
                                Dashboard
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
                                <form  action="/Song/getStation" method="POST" style="display: inline-block; margin: 0px 0px 0px 7px;">
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
                                    <input type="hidden" name="Station" value= "20">
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

                <div class="col-md-9 col-lg-10 order-1 order-md-2 content" style="margin: 0px 0px 0px 213px; background-color: #f8f9fa;">

                    <!-- Main row -->
                    <div class="row" style="margin: 25px 0px 0px 0px;">
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
                                        <?php
                                        for($e=0; $e < count($loggedUser['pendingrequests']); $e++){
                                            if( $e == 0 ) {
                                                if($loggedUser['pendingrequests'][$e]['Sender']['UserId'] == $this->session->userdata('UserId')) {
                                        ?>
                                                    <div class="carousel-item active">
                                                        
                                                        <img class="d-block w-100" src=<?= $loggedUser['pendingrequests'][$e]['Receiver']['ProfilePicUrl'] ?> >
                                                        <div class="waffles3">
                                                            <a class="waffles2" <?php echo "href = /user/show/" . $loggedUser['pendingrequests'][$e]['Receiver']['UserId'] ?>  ><button class="btn btn-primary">View Profile</button></a>
                                                            <form class="friendrequestbutton" <?php echo "action=/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Receiver']['UserId']?>  method="POST">
                                                                <input type="hidden" name="boolean" value="TRUE" />
                                                                <input type="submit" value="Cancel Request" />
                                                            </form>
                                                        </div>
                                                    </div>
                                        <?php
                                                } else
                                                if($loggedUser['pendingrequests'][$e]['Receiver']['UserId'] == $this->session->userdata('UserId')) {
                                        ?>
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src=<?= $loggedUser['pendingrequests'][$e]['Sender']['ProfilePicUrl'] ?> >
                                                    <div class="waffles3">
                                                        <a <?php echo "href = /user/show/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId'] ?>  ><button class="buttonize btn btn-primary" class="btn btn-secondary">View Profile</button></a>
                                                        <form class="friendrequestbutton" <?php echo "action=/dashboard/confirmRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']?>  method="POST">
                                                            <input type="hidden" name="boolean" value="TRUE" />
                                                            <input class="btn btn-success" type="submit" value="Accept" />
                                                        </form>
                                                        <form class="friendrequestbutton" <?php echo "action=/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']; ?> method="POST">
                                                            <input type="hidden" name="boolean" value="FALSE" />
                                                            <input class="btn btn-danger" type="submit" value="Decline" />
                                                        </form>
                                                    </div>
                                                </div>
                                        <?php
                                                }
                                        ?>

                                        <?php
                                            } else {
                                                if($loggedUser['pendingrequests'][$e]['Sender']['UserId'] == $this->session->userdata('UserId')) {
                                                    ?>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src=<?= $loggedUser['pendingrequests'][$e]['Receiver']['ProfilePicUrl'] ?> >
                                                        <div class="waffles3">
                                                            <a <?php echo "href = /user/show/" . $loggedUser['pendingrequests'][$e]['Receiver']['UserId'] ?>  ><button class="btn btn-primary">View Profile</button></a>
                                                            <form class="friendrequestbutton" <?php echo "action=/dashboard/confirmRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']?>  method="POST">
                                                                <input type="hidden" name="boolean" value="TRUE" />
                                                                <input class="btn btn-success" type="submit" value="Accept" />
                                                            </form>
                                                        <form class="friendrequestbutton" <?php echo "action=/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Receiver']['UserId']?>  method="POST">
                                                            <input type="hidden" name="boolean" value="TRUE" />
                                                            <input class="btn btn-danger" type="submit" value="Cancel Request" />
                                                        </form>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                if($loggedUser['pendingrequests'][$e]['Receiver']['UserId'] == $this->session->userdata('UserId')) {
                                                ?>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100 userprofilepic" src=<?= $loggedUser['pendingrequests'][$e]['Sender']['ProfilePicUrl'] ?> >
                                                        <div class="waffles3">
                                                            <a <?php echo "href = /user/show/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId'] ?>  ><button class="btn btn-primary">View Profile</button></a>
                                                            <form class="friendrequestbutton" <?php echo "action=/dashboard/confirmRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']?>  method="POST">
                                                                <input type="hidden" name="boolean" value="TRUE" />
                                                                <input class="btn btn-success" type="submit" value="Accept" />
                                                            </form>
                                                            <form class="friendrequestbutton" <?php echo "action=/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']; ?> method="POST">
                                                                <input type="hidden" name="boolean" value="FALSE" >
                                                                <input class="btn btn-danger" type="submit" value="Decline" >
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            }
                                        ?>
                                            <!-- <div class="carousel-item">
                                            <img class="d-block w-100" src="..." alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                            <img class="d-block w-100" src="..." alt="Third slide">
                                            </div> -->
                                            <?php
                                        }
                                        ?>
                                    </div>
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
                        <?php
                            if($this->session->userdata('FileTest') != null){
                                var_dump($this->session->userdata('FileTest'));
                            }

                            if($this->session->flashdata('errors') != null){
                                foreach($_SESSION['errors'] as $error){
                                    echo "<p style = color: red;>" . $error . "</p>";
                                }
                            }
                        ?>
                        <?php
                            if($this->session->userdata('Artist') != null) {
                                echo "  <h4 style='margin: 0px 0px 0px 430px;'>
                                            <b>" . $this->session->userdata('Artist')['name'] . "</b>
                                            <div class='HeadPhoneAnimation'>
                                                <div class='Musica'>
                                                    <span class='line superduperline1'></span>
                                                    <span class='line superduperline2'></span>
                                                    <span class='line superduperline3'></span>
                                                    <span class='line superduperline4'></span>
                                                    <span class='line superduperline5'></span>
                                                </div>
                                            </div>
                                        </h4>
                                        <br>";
                                echo "<img style='width: 160px; height: 187px; border-radius:50%; margin: 0px 0px 25px 430px;' src=" . $this->session->userdata('Artist')['picture'] . ">";
                                // var_dump($this->session->userdata('Artist'));
                                // echo "<form id=tunes action=/Song/getTunes  method=GET><input type=hidden name=tuneurl value= " . $this->session->userdata('Artist')['tracklist'] . "><input type = Submit value = Get Songs></form>";
                            }
                        ?>
    <form id="tunes" action="/Song/getTunes" method="GET">
        <button style="margin: 0px 0px 0px 471px;" class="superbtn btn1" id="ArtistVinyls">Refresh</button>
    </form>
    <?php if($this->session->userdata('Prestine') == FALSE) { ?>
    <script>
        window.onload=function(){
            document.getElementById("ArtistVinyls").click();
        };
    </script>
    <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <!-- pictures row -->
                    <div class="row mb-5">
                        <div class="col-12">
                            
                        </div>
                    </div>
                    <h3 style="margin: 0px 0px 97px 52px;">
                        Featured Hits
                        <div class='HeadPhoneAnimation'>
                            <div class='Musica'>
                                <span class='line superduperline1'></span>
                                <span class='line superduperline2'></span>
                                <span class='line superduperline3'></span>
                                <span class='line superduperline4'></span>
                                <span class='line superduperline5'></span>
                            </div>
                        </div>
                    </h3>
                    
                    <!-- end of first carousel -->
                    <!-- FriendsList and second carousel -->
                        <?php
        
        try{
            if($this->session->userdata('test') != null) { ?>
                <div id="top-songs" class="owl-carousel owl-theme" >
                <?php 
                for($v= 0; $v < count($this->session->userdata('test')['data']); $v++){
                    ?>
                    <!-- <div class="item text-center"> -->
                    
                    <br><div class = 'item text-center'><ul style='list-style-type: none;'><li><h4><b><?= $this->session->userdata('test')['data'][$v]['title'] ?></b><i style="margin: 0px 0px 0px 7px;" class='fa fa-music'></i></h4></li><br>
                    <li><h5><form action=/Song/getArtist   method=POST><input type=hidden name=Artist value='<?= $this->session->userdata('test')['data'][$v]['artist']['id'] ?>' ><input id=getArtistbutton type=submit value='<?= $this->session->userdata('test')['data'][$v]['artist']['name'] ?>' ></form></h5></li>
                    <?php
                    if(count($this->session->userdata('test')['data'][$v]['contributors']) > 1){
                        try{
                    ?>
                        <li><p>(Contributers)</p><li>
                    <?php
                            $contributors = array();
                            for($c=0; $c < count($this->session->userdata('test')['data'][$v]['contributors']); $c++){
                                // $string = "<ul style='list-style-type:none;'>";
                                // array_push($contributors, $string);
                                // var_dump($this->session->userdata('test')['data'][$v]['contributors'][$c]);
                                if($this->session->userdata('test')['data'][$v]['contributors'][$c]['name'] != $this->session->userdata('test')['data'][$v]['artist']['name']){
                    ?>
                                    <form action=/Song/getArtist   method=POST>
                                        <input type=hidden name=Artist value='<?=$this->session->userdata('test')['data'][$v]['contributors'][$c]['id']?>'>
                                        <input id=getArtistbutton type=submit value='<?=$this->session->userdata('test')['data'][$v]['contributors'][$c]['name']?>'>
                                    </form>
                                    <!-- array_push($contributors, $string2); -->
                    <?php
                                }
                            }
                            // echo implode($contributors);
                        }
                        catch(Exception $e){
                            // $contributors = null;
                        }
                        // $string3 = "</ul>";
                        // array_push($contributors, $string3);
                    }
                    ?>
                    
                        <li><form id=ArtistVinyls  action=/Song/getAlbum  method=POST>
                                    <input type=hidden name=songAlbum value='<?= $this->session->userdata('test')['data'][$v]['album']['tracklist'] ?>'>
                                    <input type=hidden name=thisAlbumTitle value='<?= $this->session->userdata('test')['data'][$v]['album']['title'] ?>'>
                                    <input type=hidden name=thisAlbumCover value='<?= $this->session->userdata('test')['data'][$v]['album']['cover'] ?>'>
                                    <input type=hidden name=album value='<?= $v ?>'>
                                    <?php if($v == $this->session->userdata('4count4')){ ?>
                                        <input id=getArtistbutton7  type = submit value = '<?= $this->session->userdata('test')['data'][$v]['album']['title'] ?>'>
                                    <?php }else{ ?>
                                        <input id=getArtistbutton  type = submit value = '<?= $this->session->userdata('test')['data'][$v]['album']['title'] ?>'>
                                    <?php } ?>
                                </form></li>
                    <?php if($this->session->userdata('2prestine2') == FALSE) { ?>
                        <script>
                            window.onload=function(){
                                document.getElementById("getArtistbutton7").click();
                            };
                        </script>
                    <?php } ?>
                        <li><img class=image1234 src='<?= $this->session->userdata('test')['data'][$v]['album']['cover'] ?>'><li><br>
                        <br><li><audio src='<?=$this->session->userdata('test')['data'][$v]['preview']?>'    controls></audio></li></ul><br>
                        
                        
                    
                    <!-- closing items div -->
                    
                    <!-- closing carousel div -->
                    </div>
                    <br>
                    
                    <?php
                    $contributors=array();
                    
                }
                // echo "<form id=tunes action=/Song/getTunes  method=GET><input type=hidden name=url3 value= " . $this->session->userdata('Artist')['tracklist'] . "><input type = Submit value = Get Songs></form>";
            }
        }
        catch(Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        
    ?>
                    
                        <!-- end of title -->
                        <!-- Friends List -->
                        

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
                    
                    <!-- end of table -->
                    

                </div>

            <!-- end of row -->
            <hr>
            <h3 style="margin: 0px 0px 70px 52px;">
                Album Tracks
                <div class='HeadPhoneAnimation'>
                    <div class='Musica'>
                        <span class='line superduperline1'></span>
                        <span class='line superduperline2'></span>
                        <span class='line superduperline3'></span>
                        <span class='line superduperline4'></span>
                        <span class='line superduperline5'></span>
                    </div>
                </div>
            </h3>
            
            <div id="ThisAlbums" class="owl-carousel2 owl-theme" >
            <?php
                // echo "Test!123!";
                
                for($r= 0; $r < count($this->session->userdata('AlbumSongs')['data']); $r++){
                    // var_dump($this->session->userdata('test')['data'][$v]['album']['tracklist']);
                    // echo "test";
            ?>
                    <div class = 'item text-center'>
                    <ul style='list-style-type: none;'><li><br><h3>Track <b><?=$this->session->userdata('AlbumSongs')['data'][$r]['track_position']?></b><i style="margin: 0px 0px 0px 7px;" class='fa fa-music'></i></h3></li><br>
                    <li><p><b><?=$this->session->userdata('AlbumSongs')['data'][$r]['title']?></b></p><li>
                    <li><form action=/Song/getArtist   method=POST><input type=hidden name=Artist value='<?=$this->session->userdata('AlbumSongs')['data'][$r]['artist']['id']?>'><input id=getArtistbutton type=submit value='<?=$this->session->userdata('AlbumSongs')['data'][$r]['artist']['name']?>'></form></li>
                    <li><h6><?=$this->session->userdata('AlbumTitle')?></h6></li>
                    <li><img class=image123 src='<?=$this->session->userdata('AlbumCover')?>'></li>
                    <li><audio class=audio123 src='<?=$this->session->userdata('AlbumSongs')['data'][$r]['preview']?>'    controls></audio></li></ul></div>
            <?php
                }
                // for($y= 0; $y < count($this->session->userdata('AlbumSongs')['data']); $y++){
                //     $string4 = "<div class ='item text-center'>";
                //     $string4 = $string4 . "<ul style='list-style-type: none;'><li><br><h3>Track <b>" . $this->session->userdata('AlbumSongs')['data'][$y]['track_position'] . "</b></li></h3><br>";
                //     $string4 = $string4 . "<li><h4><b>" . $this->session->userdata('AlbumSongs')['data'][$y]['title'] . "</b></h4><li>";
                //     $string4 = $string4 . "<li><h5>" . $this->session->userdata('AlbumSongs')['data'][$y]['artist']['name'] . "</h5></li></div>";
                //     // $string4 = $string4 . "<li><h6>" .  $this->session->userdata('AlbumSongs')['data'][$y]['album']['title'] . "</h6></li>";
                //     // $string4 = $string4 . "<li><img src=" . $this->session->userdata('AlbumSongs')['data'][$y]['album']['cover'] . "></li></div>";
                //     echo $string4;
                // }
            // } 
            ?>
            <!-- carousel closing div -->
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
                </div>
            </div> -->
        </div>












    
    
        
    <script src="/assets/owl/owl.js"></script>
    <script src="/assets/owl/owl-redux.js"></script>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>