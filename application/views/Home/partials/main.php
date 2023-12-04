<div class="genreContainer">
    <div class="genreScrollMenu">
<?php
    $numberOfRadioStations = count($DeezerApi['RadioStations']);
    echo
    "<script>
        let root = document.querySelector(':root');
        let numberOfRadioStations;

        '$numberOfRadioStations' % 2 == 1 ?
            numberOfRadioStations = Math.ceil('$numberOfRadioStations' / 2)
            :
            numberOfRadioStations = '$numberOfRadioStations' / 2;
        
        console.log(numberOfRadioStations);
        root.style.setProperty('--test', numberOfRadioStations);
    </script>";

    foreach($DeezerApi['RadioStations'] as $genre){ ?>
    <div onClick="getAlbum(this.getAttribute('data-url'), this.getAttribute('data-title'), this.getAttribute('data-radioCover'))" data-url='<?php echo $genre['tracklist'] ?>' data-title='<?php echo $genre['title'] ?>' data-radioCover='<?php echo $genre['picture_big'] ?>'>
        <img class="radioPic" src='<?php echo $genre["picture_medium"] ?>' />
        <p class="radioTitle">
            <?php echo $genre["title"] ?>
        </p>
        <button class="radioButton">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <path d="M494.8 47c12.7-3.7 20-17.1 16.3-29.8S494-2.8 481.2 1L51.7 126.9c-9.4 2.7-17.9 7.3-25.1 13.2C10.5 151.7 0 170.6 0 192v4V304 448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H218.5L494.8 47zM368 240a80 80 0 1 1 0 160 80 80 0 1 1 0-160zM80 256c0-8.8 7.2-16 16-16h96c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16zM64 320c0-8.8 7.2-16 16-16H208c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm16 64c0-8.8 7.2-16 16-16h96c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16z"/>
            </svg>
        </button>
    </div>
<?php
}
?>
    </div>
</div>

<br>
<br>
<br>

<h4>Trending Tracks</h4>
<br>
<div class="tracksScrollMenu">
<?php
$index = 0;
foreach($DeezerApi['tracks'] as $track){
    // var_dump($track);
    // echo "<p style='color: blue;'>$count Track !!!!!!!!!!!!!!!</p>";
    // $preview = $track[0]['preview'];
    // echo "$preview";
?>
    <div>
        <div class="top">
            <div class="left">
                <img src="<?php echo $track['track']['artist']['picture_medium'] ?>" data-url="<?php echo $track['track']['artist']['tracklist'] ?>" data-artistName="<?php echo $track['track']['artist']['name'] ?>" data-artistPicture="<?php echo $track['track']['artist']['picture_big'] ?>" onClick="getAlbum(this.getAttribute('data-url'), null, this.getAttribute('data-artistPicture'), this.getAttribute('data-artistName'))" />
            </div>
            <div class="right">
                <p><?php echo $track['track']['artist']['name'] ?></p>
                
            <?php
                $title = $track['track']['album']['title'];
                if($track['numberOfTracksInAlbum'] > 1){
                    echo "<a>$title</a>";
                } else {
                    echo "<p>$title</p>";
                }
            ?>
            </div>
        </div>
        <div class="bottom" id="tracksScrollMenuBottom">
            <div class="left">
                <img <?php if($track['numberOfTracksInAlbum'] > 1) {echo "class='albumCover' onClick='getAlbum(this.getAttribute(`data-url`), this.getAttribute(`data-albumTitle`), this.getAttribute(`data-albumCover`), this.getAttribute(`data-artistName`))'";} ?> src="<?php echo $track['track']['album']['cover_medium'] ?>" data-url='<?php echo $track['track']['album']['tracklist'] ?>' data-albumTitle='<?php echo $track['track']['album']['title']?>' data-albumCover='<?php echo $track['track']['album']['cover_big']?>' data-artistName='<?php echo $track['track']['artist']['name']?>' />
            </div>
            <div class="right">
                <p><?php echo $track['track']['title'] ?></p>
                <?php
                    $numberOfTracksInAlbumTracklist = $track['numberOfTracksInAlbum'];
                    if($track['numberOfTracksInAlbum'] > 1){
                        echo "<p style='font-size: x-small;'>Album &emsp; $numberOfTracksInAlbumTracklist songs</p>";
                    } else {
                        echo "<p style='font-size: x-small;'>Single</p>";
                    }
                ?>

                <div>
                    <svg class="likeButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                    </svg>
                    <audio>
                        <source type="audio/mpeg" src="<?php echo $track['track']['preview'] ?>">
                    </audio>
                    <button class="playButton" onClick="playAudio(<?php echo $index ?>)">
                        <svg class="playButtonSvg" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512" fill="white">
                            <path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                    </button>
                    <button class="pauseButton" onClick="pauseAudio(<?php echo $index?>)">
                        <svg class="pauseButtonSvg" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512" fill="white">
                            <path d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php
$index++;
}
?>
</div>

<h4>Hottest Albums</h4>

<div class="albumScrollMenu">
<?php foreach($DeezerApi['albums'] as $album){ ?>

    <div class="container">
        <img onClick='getAlbum(this.getAttribute("data-url"), this.getAttribute("data-albumTitle"), this.getAttribute("data-albumCover"), this.getAttribute("data-albumArtistName"))' src="<?php echo $album['cover_medium'] ?>" data-url="<?php echo $album['tracklist'] ?>" data-albumCover="<?php echo $album['cover_big'] ?>" data-albumTitle="<?php echo $album['title'] ?>" data-albumArtistName="<?php echo $album['artist']['name'] ?>"/>
        <div>
            <p class="title"><?php echo $album['title'] ?></p>
            <p><?php echo $album['artist']['name'] ?></p>
        </div>
    </div>

<?php } ?>
</div>

<br>

<h4>Popular Artists</h4>
<div class="artistScrollMenu">
<?php foreach($DeezerApi['artists'] as $artist){ ?>

    <div>
        <img src="<?php echo $artist['picture_big'] ?>"  onClick="getAlbum(this.getAttribute('data-url'), null, this.getAttribute('data-artistPicture'), this.getAttribute('data-artistName'))" data-url='<?php echo $artist['tracklist'] ?>' data-artistName='<?php echo $artist['name'] ?>' data-artistPicture='<?php echo $artist['picture_big']?>'/>
        <p><?php echo $artist['name'] ?></p>
    </div>

<?php } ?>
</div>

<br>
<br>

<h4>Recommended Playlists</h4>

<div class="albumScrollMenu">
<?php foreach($DeezerApi['playlists'] as $playlist){ ?>

    <div class="container">
        <img src="<?php echo $playlist['picture_medium'] ?>" onClick="getAlbum(this.getAttribute('data-url'), this.getAttribute('data-playlistTitle'), this.getAttribute('data-playlistPicture'), this.getAttribute('data-playlistCreator'))" data-url='<?php echo $playlist['tracklist'] ?>' data-playlistTitle='<?php echo $playlist['title'] ?>' data-playlistPicture='<?php echo $playlist['picture_big']?>' data-playlistCreator='<?php echo $playlist['user']['name']?>' />
        <p class="title"><?php echo $playlist['title'] ?></p>
        <p><?php echo $playlist['user']['name'] ?></p>
    </div>

<?php } ?>
</div>