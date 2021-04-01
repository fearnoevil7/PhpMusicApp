<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/assets/css/Main.css">
        <!-- Font Awesome -->
        <script defer src="/assets/fontawesome-free-5.13.0-web/js/all.js"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <link rel="stylesheet" href="/assets/css/style.php">
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
                                                            <form class="friendrequestbutton" <?php echo "action =/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Receiver']['UserId']?>  method="POST">
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
                                                        <form class="friendrequestbutton" <?php echo "action =/dashboard/confirmRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']?>  method="POST">
                                                            <input type="hidden" name="boolean" value="TRUE" />
                                                            <input class="btn btn-success" type="submit" value="Accept" />
                                                        </form>
                                                        <form class="friendrequestbutton" <?php echo "action =/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']; ?> method="POST">
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
                                                            <form class="friendrequestbutton" <?php echo "action =/dashboard/confirmRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']?>  method="POST">
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
                                                            <form class="friendrequestbutton" <?php echo "action =/dashboard/confirmRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']?>  method="POST">
                                                                <input type="hidden" name="boolean" value="TRUE" />
                                                                <input class="btn btn-success" type="submit" value="Accept" />
                                                            </form>
                                                            <form class="friendrequestbutton" <?php echo "action =/dashboard/declineRequest/" . $this->session->userdata('UserId') . "/" . $loggedUser['pendingrequests'][$e]['Sender']['UserId']; ?> method="POST">
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
                            <div style="display: inline-bock;">
                                <div style="display: inline-block; margin: 0px 56px 0px 50px;">
                                    <h4 style="margin: 0px 0px 0px 52px;"><?= $UserToBeShown['Name'] ?>
                                        <div class="HeadPhoneAnimation">
                                            <div class="Musica">
                                                <span class="line superduperline1"></span>
                                                <span class="line superduperline2"></span>
                                                <span class="line superduperline3"></span>
                                                <span class="line superduperline4"></span>
                                                <span class="line superduperline5"></span>
                                            </div>
                                        </div>
                                    </h4>
                                    <img style="width: 160px; height: 187px; border-radius:50%; margin: 25px 0px 43px 75px;" src=<?= $UserToBeShown['Url'] ?>>
                                    <form <?php echo "action=/sendFriendRequest/" . $this->session->userdata('UserId') . "/" . $UserToBeShown['Id'] ?> method="POST">
                                        <button class="superbtn-redux btn1">Friends +</button>
                                    </form>
                                </div>
                                <div style="display: inline-block; margin: 0px 0px 160px 0px">
                                    <div class='carousel slide' data-ride="carousel">
                                        <h4 style="margin: 0px 0px 25px 0px;">
                                            <?= $UserToBeShown['FirstName']?>'s Playlist
                                            <div class="HeadPhoneAnimation">
                                                <div class="Musica">
                                                    <span class="line superduperline1"></span>
                                                    <span class="line superduperline2"></span>
                                                    <span class="line superduperline3"></span>
                                                    <span class="line superduperline4"></span>
                                                    <span class="line superduperline5"></span>
                                                </div>
                                            </div>
                                        </h4>
                                        <div class="carousel-inner">
                                        <?php for($m = 0; $m < count($UserToBeShown['Playlist']); $m++){ 
                                            if($m == 0){
                                        ?>
                                            <div class="carousel-item active">
                                                <!-- <p>test</p> -->
                                                <h6 style="margin: 0px 0px 0px 96px;" class="mb-0"><?= $UserToBeShown['Playlist'][$m]['Name'] ?></h6>
                                                <p style="margin: 0px 0px 0px 79px;" class="text-muted mb-0"><?= $UserToBeShown['Playlist'][$m]['Artist'] ?></p>
                                                <img src="/assets/images/musicicon.jpg" style="width: 270px; height: 170px; display: block; border-radius: 7px;">
                                                <audio <?php echo 'src=' . $UserToBeShown['Playlist'][$m]['Url'] ?> controls></audio>
                                            </div>
                                        <?php } else { ?>
                                            <div class="carousel-item">
                                                <!-- <p>test</p> -->
                                                <h6 style="margin: 0px 0px 0px 96px;" class="mb-0"><?= $UserToBeShown['Playlist'][$m]['Name'] ?></h6>
                                                <p style="margin: 0px 0px 0px 88px;" class="text-muted mb-0"><?= $UserToBeShown['Playlist'][$m]['Artist'] ?></p>
                                                <img src="/assets/images/musicicon.jpg" style="width: 270px; height: 170px; display: block; border-radius: 7px;">
                                                <audio <?php echo 'src=' . $UserToBeShown['Playlist'][$m]['Url'] ?> controls></audio>
                                            </div>
                                        
                                        <?php }
                                                } ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div style="margin: 0px 0px 0px 340px;">
                                    <h4 style="margin: 160px 0px 52px 0px;"><?php echo count($UserToBeShown['Friends']); ?> Friends <i style="margin: 0px 0px 0px 7px;" class="fas fa-user-friends"></i></h4>
                                    <div class="pic-ctn">
                                    <?php for($k = 0; $k < count($UserToBeShown['Friends']); $k++){ ?>
                                        <div <?php echo 'style=animation-delay:' . $k * 2 . 's' ?> >
                                            <h4><?= $UserToBeShown['Friends'][$k]['FirstName'] ?> <?= $UserToBeShown['Friends'][$k]['LastName'] ?></h4>
                                            <img style="width: 160px; height: 187px; border-radius:50%;" <?php echo "src=" . $UserToBeShown['Friends'][$k]['ProfilePicUrl'] ?>>
                                        </div>

                                    <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <!-- pictures row -->
                    <div class="row mb-5">
                        <div class="col-12">
                            
                            
                        </div>
                    </div>
                    <div style="margin: 0px 0px 0px 250px;">
                        <h1 style="color: #6c757d; margin: 0px 0px 0px 7px; font-size: 20pt;">Leave <?=$UserToBeShown['FirstName']?> a Message <i style="margin: 0px 0px 0px 52px; color: #bebebe;" class="far fa-comment-alt"></i></h1>
                        <form <?php echo "action=/Message/Create/" . $this->session->userdata('UserId') . "/" . $UserToBeShown['Id'] . "/" ?> method = POST >
                            <input type="hidden" name="MessageTypeBoolean" value="TRUE">
                            <textarea cols=43 rows = 3 name = Content class="form-control" style="width: 430px; margin: 16px 0px 0px 0px;"></textarea>
                            <button class="superbtn btn1" style="margin: 34px 0px 0px 370px;">
                                Post
                            </button>
                            <!-- <input style="margin: 34px 0px 0px 370px;" class= 'btn btn-primary' type= submit value = Post /> -->
                        </form>
                    </div>
                    <div style="margin: 0px 0px 0px 124px;">
                        <?php
                            // echo gettype(date("m")) . "<br>";
                            date_default_timezone_set('America/Chicago');
                            // if(date("H") > 12) {
                            //     // echo date("H") - 12 . ":" . date("i") . "<br>";
                            //     if(date("m") == "01"){
                            //         echo "January " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "02"){
                            //         echo "February " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "03"){
                            //         echo "March " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "04"){
                            //         echo "April " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "05"){
                            //         echo "May " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "06"){
                            //         echo "June " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "07"){
                            //         echo "July " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "08"){
                            //         echo "August " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "09"){
                            //         echo "September " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "10"){
                            //         echo "October " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "11"){
                            //         echo "November " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            //     if(date("m") == "12"){
                            //         echo "December " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") - 12 . ":" . date("i") . " PM <br>";
                            //     }
                            // }
                            // else
                            // {
                            //     if(date("m") == "01"){
                            //         echo "January " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "02"){
                            //         echo "February " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "03"){
                            //         echo "March " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "04"){
                            //         echo "April " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "05"){
                            //         echo "May " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "06"){
                            //         echo "June " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "07"){
                            //         echo "July " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "08"){
                            //         echo "August " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "09"){
                            //         echo "September " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "10"){
                            //         echo "October " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "11"){
                            //         echo "November " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            //     if(date("m") == "12"){
                            //         echo "December " . date("d") . ", " . date("Y") . "  ";
                            //         echo date("H") . ":" . date("i") . " AM <br>";
                            //     }
                            // }
                            // if(date("m" == 1)){

                            // }
                            // echo date("m-d-Y, H:i");
                            // echo $message['CreatedAt']['Date']['Month'];
                            foreach($messages4song['Messages'] as $message){
                        ?>
                                <div class = waffles id = UserProfilePic2 style="margin: 70px 0px 34px 70px;">
                                            <img class=UserProfilePic <?php echo "src=" . $message['PosterPicUrl'] ?> >
                                        </div>
                                        <div class = waffles>
                                            <div style="width: 300px;">
                                                <a class = messagedate <?php echo "href = /user/show/" . $message['UserId']?>> <b> <?= $message['PosterName'] ?></b></a>
                                                <span class = messagedate style="margin: 0px 0px 0px 7px;">
                                                    <?php
                                                    
                                                    // echo json_decode($message['CreatedAt'])->Date->Month; 
                                                    if(json_decode($message['CreatedAt'])->Date->Year == date("Y")){
                                                        if(json_decode($message['CreatedAt'])->Date->Year == date("Y") && json_decode($message['CreatedAt'])->Date->NumericalMonth == date("m")){
                                                            if(json_decode($message['CreatedAt'])->Date->Year == date("Y") && json_decode($message['CreatedAt'])->Date->NumericalMonth == date("m") && json_decode($message['CreatedAt'])->Date->Day == date("d")){
                                                                $hour;
                                                                if(date("H") > 12){
                                                                    $hour = date("H") - 12;
                                                                    if(json_decode($message['CreatedAt'])->Time->Hour == $hour){
                                                                        if(json_decode($message['CreatedAt'])->Time->Minutes == date("i")){
                                                                            echo "now";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo date("i") - json_decode($message['CreatedAt'])->Time->Minutes . " min ago";
                                                                            // echo json_decode($message['CreatedAt'])->Date->Day;
                                                                            // echo number_format(date("d"));
                                                                            // echo date("d");
                                                                        }
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Hour);
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Minutes);
                                                                        // var_dump(date("H"));
                                                                        // var_dump(date("i"));
                                                                    }
                                                                    else
                                                                    {
                                                                        if($hour - json_decode($message['CreatedAt'])->Time->Hour > 1){
                                                                            echo $hour - json_decode($message['CreatedAt'])->Time->Hour . " hours ago";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $hour - json_decode($message['CreatedAt'])->Time->Hour . " hour ago";
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    if(json_decode($message['CreatedAt'])->Time->Hour == date("H")){
                                                                        if(json_decode($message['CreatedAt'])->Time->Minutes == date("i")){
                                                                            echo "now";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo date("i") - json_decode($message['CreatedAt'])->Time->Minutes . " min ago";
                                                                        }
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Hour);
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Minutes);
                                                                        // var_dump(date("H"));
                                                                        // var_dump(date("i"));
                                                                    }
                                                                    else
                                                                    {
                                                                        if($hour - json_decode($message['CreatedAt'])->Time->Hour > 1){
                                                                            echo $hour - json_decode($message['CreatedAt'])->Time->Hour . " hours ago";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $hour - json_decode($message['CreatedAt'])->Time->Hour . " hour ago";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                
                                                                if(number_format(date("d")) - json_decode($message['CreatedAt'])->Date->Day >= 7){
                                                                    echo "1 week ago";
                                                                } elseif(number_format(date("d")) - json_decode($message['CreatedAt'])->Date->Day >= 14){
                                                                    echo "2 weeks ago";
                                                                } elseif(number_format(date("d")) - json_decode($message['CreatedAt'])->Date->Day >= 21){
                                                                    echo "3 weeks ago";
                                                                }
                                                                else
                                                                {
                                                                    if(number_format(date("d")) - json_decode($message['CreatedAt'])->Date->Day > 1){
                                                                        echo number_format(date("d")) - json_decode($message['CreatedAt'])->Date->Day . " days ago";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo number_format(date("d")) - json_decode($message['CreatedAt'])->Date->Day . " day ago";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if(number_format(date("m")) - json_decode($message['CreatedAt'])->Date->Month > 1){
                                                                echo number_format(date("m")) - json_decode($message['CreatedAt'])->Date->Month . " months ago";
                                                            }
                                                            else
                                                            {
                                                                echo number_format(date("m")) - json_decode($message['CreatedAt'])->Date->Month . " month ago";
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if(number_format(date("Y")) - json_decode($message['CreatedAt'])->Date->Year > 1){
                                                            echo number_format(date("Y")) - json_decode($message['CreatedAt'])->Date->Year . " years ago";
                                                        }
                                                        else
                                                        {
                                                            echo number_format(date("Y")) - json_decode($message['CreatedAt'])->Date->Year . " year ago";
                                                        }
                                                    }

                                                    
                                                    ?>
                                                </span>
                                            </div>
                                            <br>
                                            <p style="width: 673px;"><?= $message['Content'] ?></p>
                                            
                                            <div style="width: 700px;">
                                                <div class = dropdown style="display: inline-block; margin: 0px 52px 0px 0px;">
                                                    <a id=commentdropdown class = 'dropbtn' data-toggle = dropdown aria-haspopup = true aria-expanded = false  >Reply</a>
                                                    <div class = dropdown-menu>
                                                        <span><u>Reply To <?= $message['PosterName'] ?></u></span>
                                                        <div class = dropdown-divider></div>
                                                        <form class = dropdown-item <?php echo "action=/comment/" . $message['PosterId'] . "/" . $message['PostId'] . "/" . $UserToBeShown['Id'] ?> method=POST>
                                                            <img class=UserProfilePic2 src =<?= $loggedUser['Url']?> >
                                                            <textarea class=commenttextbox cols = 34 rows = 1 name = Content></textarea>
                                                            <input type="hidden" name="IsWallPostComment" value="TRUE">
                                                            <button type=submit class='btn btn-primary'>Post</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="dropdown" style="display: inline-block; width: 480px;">
                                                    <a id=commentdropdown class = 'dropbtn' data-toggle = dropdown aria-haspopup=true aria-expanded = false>View Replies</a>
                                                    <div class = dropdown-menu style="background-color: #f8f9fa; border: none;">
                                                    <?php
                                                        for($z=0; $z<count($comments['allcomments']); $z++){
                                                            if($comments['allcomments'][$z]['WallPostId'] == $message['PostId']){
                                                    ?>
                                                                <div style="display: inline-block;">
                                                                    <img style="height: 43px; width: 43px; margin: 0px 25px 25px 0px;" <?php echo "src=" . $comments['allcomments'][$z]['PosterPicUrl'] ?> >
                                                                </div>
                                                                <div style="display: inline-block; width: 400px;">
                                                                    <a class = messagedate <?php echo "href = /user/show/" . $message['UserId']?>> <b> <?= $comments['allcomments'][$z]['PosterName'] ?> </b></a>
                                                                    <span class = messagedate style="margin: 0px 0px 0px 7px;">
                                                    <?php
                                                    
                                                    // echo json_decode($message['CreatedAt'])->Date->Month; 
                                                    if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Year == date("Y")){
                                                        if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Year == date("Y") && json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->NumericalMonth == date("m")){
                                                            if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Year == date("Y") && json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->NumericalMonth == date("m") && json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day == date("d")){
                                                                $hour;
                                                                if(date("H") > 12){
                                                                    $hour = date("H") - 12;
                                                                    if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour == $hour){
                                                                        if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Minutes == date("i")){
                                                                            echo "now";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo date("i") - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Minutes . " min ago";
                                                                            // echo json_decode($message['CreatedAt'])->Date->Day;
                                                                            // echo number_format(date("d"));
                                                                            // echo date("d");
                                                                        }
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Hour);
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Minutes);
                                                                        // var_dump(date("H"));
                                                                        // var_dump(date("i"));
                                                                    }
                                                                    else
                                                                    {
                                                                        if($hour - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour > 1){
                                                                            echo $hour - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour . " hours ago";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $hour - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour . " hour ago";
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour == date("H")){
                                                                        if(json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Minutes == date("i")){
                                                                            echo "now";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo date("i") - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Minutes . " min ago";
                                                                        }
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Hour);
                                                                        // var_dump(json_decode($message['CreatedAt'])->Time->Minutes);
                                                                        // var_dump(date("H"));
                                                                        // var_dump(date("i"));
                                                                    }
                                                                    else
                                                                    {
                                                                        if($hour - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour > 1){
                                                                            echo $hour - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour . " hours ago";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $hour - json_decode($comments['allcomments'][$z]['CreatedAt'])->Time->Hour . " hour ago";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                if(number_format(date("d")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day >= 7){
                                                                    echo "1 week ago";
                                                                } elseif(number_format(date("d")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day >= 14){
                                                                    echo "2 weeks ago";
                                                                } elseif(number_format(date("d")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day >= 21){
                                                                    echo "3 weeks ago";
                                                                }
                                                                else
                                                                {
                                                                    if(number_format(date("d")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day > 1){
                                                                        echo number_format(date("d")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day . " days ago";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo number_format(date("d")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Day . " day ago";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if(number_format(date("m")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Month > 1){
                                                                echo number_format(date("m")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->NumericalMonth . " months ago";
                                                            }
                                                            else
                                                            {
                                                                echo number_format(date("m")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->NumericalMonth . " month ago";
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if(number_format(date("Y")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Year > 1){
                                                            echo number_format(date("Y")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Year . " years ago";
                                                        }
                                                        else
                                                        {
                                                            echo number_format(date("Y")) - json_decode($comments['allcomments'][$z]['CreatedAt'])->Date->Year . " year ago";
                                                        }
                                                    }

                                                    
                                                    ?>
                                                                    </span>
                                                                    <p class = dropdown-item > <?= $comments['allcomments'][$z]['Content'] ?> </p>
                                                                </div>
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        $string3 = "<div></div>";
                                        echo $string3;
                                        // var_dump($string3);
                            }
                        ?>
                    </div>
                    
                    <!-- end of first carousel -->
                    <!-- FriendsList and second carousel -->
                    
                    
                        <!-- end of title -->
                        <!-- Friends List -->
                        <div class="soundWaveAnimation" style="margin: 0px 0px 25px 0px;">
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
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>