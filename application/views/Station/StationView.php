<?php  header("Access-Control-Allow-Origin: *"); ?>
<!doctype html>
<html lang="en">
    <head>
        <title></title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/assets/css/StationView.css">

        <!-- Font Awesome -->
        <script defer src="/assets/fontawesome-free-5.13.0-web/js/all.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script>
            function clearMain() {
                let mainDiv = document.querySelector('.main');

                let genreContainer = document.querySelector('.genreContainer');
                let tracksScrollMenu = document.querySelector('.tracksScrollMenu');
                let artistScrollMenu = document.querySelector('.artistScrollMenu');
                let albumScrollMenu = document.querySelectorAll('.albumScrollMenu')[0];
                let deezerPlaylists = document.querySelectorAll('.albumScrollMenu')[1];

                let h4s = document.querySelectorAll('h4');
                
                genreContainer.remove();
                tracksScrollMenu.remove();
                artistScrollMenu.remove();
                albumScrollMenu.remove();
                deezerPlaylists.remove();

                let x = 0;
                while(h4s[x] != null || h4s[x] != undefined) {
                    h4s[x] == null ? console.log('h4 is null.') : h4s[x] == undefined ? console.log('h4 is undefined.') : h4s[x].remove(); 
                    x++;
                };

            };

            function addLineBreak(node) {
                const linebreak = document.createElement('br');
                node.appendChild(linebreak);
            };

            const numberOfTracksInAlbum = async(url) => {
                console.log("Counting number of tracks in album.");
                await makeAPIcall(url).then((data) => {
                    // console.log("Album: ", data, "Length: ", data.length);
                    return data.length;
                }).catch((error) => {
                    return null;
                })
            };

            function makeAPIcall(url, requestBody){
                console.log("Making API call!");
                const body = {
                    url: url
                };


                return new Promise(function(resolve, reject){
                    $.post("http://localhost:8888/deezer", body, (data, status) => {
                    })
                    .done(function(data){
                        console.log("Receiving data from API call!", data);
                        resolve(data);
                    })
                    .fail(function(error) {
                        reject(error)
                    })
                    .always(function() {
                        console.log("API call has Finished.");
                    });
                });
            }

            let albumTrackListCurrentPage;
            let numberOfSongsExcluded;

            function nextPage(){
                console.log("Current page: ", pages[currentPage]);
                let tracklist = document.querySelector('.tracklist');
                tracklist.innerHTML = "";

                currentPage + 1 > pages.length ? currentPage = 1 : currentPage++;
                setPage();
            }

            function previousPage(){
                console.log("Current page: ", pages[currentPage]);
                let tracklist = document.querySelector('.tracklist');
                tracklist.innerHTML = "";

                currentPage - 1 == 0 ? currentPage = pages.length : currentPage--;
                setPage();
            }

            let songsPerPage = 3;

            async function setPage(){
                numberOfSongsExcluded = 0;

                console.log("****Entering setPage function.****");
                let tracks = pages[currentPage - 1];
                console.log("Entering setPage function : " + currentPage);
                console.log("Current Page: ", pages[currentPage - 1]);

                console.log("******tracks*****", tracks);
        
                for(let x = 0; x < tracks.length; x++){
                    console.log("Setting track: ", tracks[x]);

                    if(tracks[x]['preview'] && tracks[x]['preview'].length != 0){

                        let albumTitle = localStorage.getItem("selectedAlbum")["'title'"];
                        let artistName = localStorage.getItem("selectedAlbum")["name"];
                        
                        let track = document.createElement("div");

                        track.classList.add("track");

                        let playSvgIcon = await renderSvgIcon(track, "M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z");
                        playSvgIcon.setAttribute('viewBox', '0 0 384 512');
                        playSvgIcon.setAttribute('height', '1em');
                        playSvgIcon.classList.add('playBtn');

                        console.log("Test1");

                        let trackDetails = `
                            <span>${currentPage > 1 ? x + 1 + (songsPerPage * (currentPage - 1)) : x + 1}</span>
                            <p>${tracks[x]['title'].length > 15 ? tracks[x]['title'].substring(0, 15).trimEnd().concat("...") : tracks[x]['title']}</p>
                            <p>${albumTitle ? tracks[x]['artist']['name'] : tracks[x]['artist']['name'] == artistName ? tracks[x]['album']['title'] : tracks[x]['artist']['name']}</p>
                        `;

                        $(track).append(trackDetails);

                        let toolTip = document.getElementById('trackDetailsToolTip');
                        let element = track.querySelector('p');

                        console.log("Test2");

                        tracklist = document.querySelector(".tracklist");

                        if(tracks[x]['title'].length > 15){

                            console.log("Test3");

                            element.onpointermove = function(e){

                                toolTip.innerHTML = tracks[x]['title'];
                                toolTip.style.display = "inline";    
                                toolTip.style.top = (((e.pageY * 100) / window.innerHeight) - ((toolTip.offsetHeight * 100) / window.innerHeight)) - 0.35 + "%";
                                toolTip.style.left = ((e.pageX * 100) / window.innerWidth) - 0.2 + "%";

                            };

                            element.onpointerleave = function(e){
                                toolTip.style.display = "none";
                            };

                            tracklist.onscroll = function(e){
                                toolTip.style.display = "none";
                            }

                            toolTip.onpointerenter = function(){
                                toolTip.style.display = "inline";
                            }
                        }
                        
                        $(tracklist).append(track);


                        track.dataset.Id = x + ((currentPage - 1) * songsPerPage) - numberOfSongsExcluded;

                        console.log("Test4");


                        track.addEventListener("click", async function(){
                            console.log("Clicked on track!!!!");
                            let currentTrackName = document.querySelectorAll(".MusicPlayer .left div p")[0];
                            let currentTrackArtist = document.querySelectorAll(".MusicPlayer .left div p")[1];

                            let picture = document.querySelector(".MusicPlayer .left img");

                            let audioElement = document.getElementById("song");

                            console.log("Tracks: ", document.querySelectorAll(".sidebar .sidebar_bottom div .menuItem")[2].querySelector(".tracklist"));

                            console.log("trackNumber: ", Number(track.dataset.Id), " CurrentPage: ", currentPage , " calc: ", Number(track.dataset.Id) - ((currentPage - 1) * songsPerPage));
                            console.log(document.querySelectorAll(".sidebar .sidebar_bottom div .menuItem")[2].querySelectorAll(".tracklist .track")[Number(track.dataset.Id) - ((currentPage - 1) * songsPerPage)]);

                            let svg = document.querySelectorAll(".sidebar .sidebar_bottom div .menuItem")[2].querySelectorAll(".tracklist .track")[Number(track.dataset.Id) - ((currentPage - 1) * songsPerPage)].querySelector('.playBtn');
                            svg.style.display = "inline";

                            let indexSpan = document.querySelectorAll(".sidebar .sidebar_bottom div .menuItem")[2].querySelectorAll(".tracklist .track")[Number(track.dataset.Id) - ((currentPage - 1) * songsPerPage)].querySelector('span');
                            indexSpan.style.display = "none";

                            console.log("Track!!!!!: ", svg);

                            await setSelectedSong(track.dataset.Id);

                            keepPlaying();
                        });
                    } else {
                        numberOfSongsExcluded++;
                        continue;
                    }
                };

                addLineBreak(tracklist);
                addLineBreak(tracklist);


                console.log("Exiting setPage function.");
            }


            function getAlbum(url, title, cover, name, startOnTrackNumber){

                playPause(true);

                name ? name : name = "";

                const body = {
                    url: url,
                    title: title,
                    cover: cover,
                    name: name
                };

                console.log(body);

                let sidebar_top = document.querySelector('.sidebar_bottom div');

                console.log("Making api call from get album function.");
                makeAPIcall(url).then(function(data){
                    console.log(data);

                    const dictionary = new Map();

                    for(track of data){
                        dictionary.set(`${track.title}`, track);
                    };

                    console.log("Dictionary!!!!", dictionary);

                    pages = pagination(dictionary, songsPerPage);

                    console.log("Pages!!!!!", pages);

                    let selectedAlbum = {"title" : title, "cover" : cover, "name" : name, "tracks" : data};

                    localStorage.setItem("selectedAlbum", JSON.stringify(selectedAlbum));
                    localStorage.setItem("albumCover", cover);
                    
                    startOnTrackNumber != undefined ? setSelectedSong(startOnTrackNumber) : setSelectedSong(0);

                    // the song variable is declared in the customaudio&volume_interfaces.js file

                    let menuItem = document.querySelector('.albumView');

                    if(menuItem != null){
                        menuItem.innerHTML = "";
                    } else {

                        let closeWindowButton = document.createElement('div');
                        closeWindowButton.classList.add('closeWindowButton');

                        let closeWindowIcon = renderSvgIcon(closeWindowButton, "M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z");
                        closeWindowIcon.setAttribute('viewBox', '0 0 384 512');
                        closeWindowIcon.setAttribute('height', '1em');
                        closeWindowIcon.classList.add('windowButtonSVG');

                        let minimizeWindowButton = document.createElement('div');
                        minimizeWindowButton.classList.add('minimizeWindowButton');

                        let minimizeWindowIcon = renderSvgIcon(minimizeWindowButton, "M32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z");
                        minimizeWindowIcon.setAttribute('viewBox', '0 0 512 512');
                        minimizeWindowIcon.setAttribute('height', '0.6em');
                        minimizeWindowIcon.classList.add('windowButtonSVG');

                        let expandWindowButton = document.createElement('div');
                        expandWindowButton.classList.add('expandWindowButton');
                       
                        let upArrow = renderSvgIcon(expandWindowButton, "M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z");
                        upArrow.setAttribute('viewBox', '0 0 320 512');
                        upArrow.setAttribute('height', '0.2em');

                        let downArrow = renderSvgIcon(expandWindowButton, "M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z");
                        downArrow.setAttribute('viewBox', '0 0 320 512');
                        downArrow.setAttribute('height', '0.2em');

                        downArrow.classList.add('windowButtonSVG');
                        upArrow.classList.add('windowButtonSVG');


                        let btnContainer = document.createElement('div');
                        btnContainer.classList.add('paginationWindowBtns');

                        $(btnContainer).append(closeWindowButton);
                        $(btnContainer).append(minimizeWindowButton);
                        $(btnContainer).append(expandWindowButton);

                        $(sidebar_top).append(btnContainer);

                        menuItem = document.createElement("div");
                        menuItem.classList.add("menuItem");
                        menuItem.classList.add("albumView")

                        $(sidebar_top).append(menuItem);
                    };

                    let p = document.createElement('p');
                    p.innerHTML = `${title ? title : name}`;
                    p.classList.add('title');

                    $(menuItem).append(p);

                    // console.log("menuItemPosition: ", menuItemPosition, " btnContainer width: ", (btnContainer.offsetWidth * 100 / window.innerWidth), " width: ", menuItemPosition['right'] * 100 / window.innerWidth);


                    let nowPlayingSection = `
                            <img class="nowPlayingImg" onclick="playPause()" src="${cover}" />
                        `;
                    $(menuItem).append(nowPlayingSection);


                    let paginationNavButtons = document.querySelectorAll('.paginationButtons')[0];

                    setInterval(() => {
                        let img = document.querySelector('.nowPlayingImg');
                        let paginationWindowButtons = document.querySelector('.paginationWindowBtns');
                        if(img){
                            let img_position = img.getBoundingClientRect();

                            paginationNavButtons.style.left = (img_position['right'] * 100 / window.innerWidth) - (paginationNavButtons.offsetWidth * 100 / window.innerWidth) + "%";
                            paginationNavButtons.style.top = (img_position['bottom'] * 100 / window.innerHeight) - (paginationNavButtons.offsetHeight * 100 / window.innerHeight) + "%";
                            paginationNavButtons.style.display = "inline";

                            let menuItemPosition = menuItem.getBoundingClientRect();

                            paginationWindowButtons.style.left = ((menuItemPosition['right'] - (paginationWindowButtons.offsetWidth / 1.4)) * 100 / window.innerWidth) +  "%";
                            paginationWindowButtons.style.top = ((menuItemPosition['top'] - (paginationWindowButtons.offsetHeight / 3)) * 100 / window.innerHeight) + "%";
                        }
                    }, 5);

                    // let sidebar = document.querySelector('.sidebar .sidebar_bottom');
                    // let scrolling = false;

                    // sidebar.onscroll = () => {
                    //     scrolling = true;
                    //     let img = document.querySelector('.nowPlayingImg');
                    //     paginationNavButtons.style.left = (img_position['right'] * 100 / window.innerWidth) - (paginationNavButtons.offsetWidth * 100 / window.innerWidth) + "%";
                    //     paginationNavButtons.style.top = (img_position['bottom'] * 100 / window.innerHeight) - (paginationNavButtons.offsetHeight * 100 / window.innerHeight) + "%";
                    //     paginationNavButtons.style.display = "inline";
                    // };

                    // setInterval(() => {
                    //     if(scrolling)
                    //         scrolling = false;
                    // }, 300);

                    let tracklist = document.createElement("div");
                    tracklist.classList.add("tracklist");
                    $(menuItem).append(tracklist);

                    currentPage = 1;
                    
                    setPage();

                    console.log("pages: ", pages);

                    console.log("Successfully made API call to get album.");

                }).catch(function(error){
                    console.log("API call to get album failed. ", error);
                })
            };



            function playAudio(id){
                document.querySelectorAll('audio')[id].play();
                document.querySelectorAll('.playButton')[id].style.setProperty('display', 'none');

                document.querySelectorAll('.pauseButton')[id].style.setProperty('display', 'inline');
                document.querySelectorAll('audio')[id].addEventListener('ended', function() {
                    document.querySelectorAll('.playButton')[id].style.setProperty('display', 'inline');

                    document.querySelectorAll('.pauseButton')[id].style.setProperty('display', 'none');
                });
            };

            function pauseAudio(id){
                document.querySelectorAll('audio')[id].pause();
                document.querySelectorAll('.playButton')[id].style.setProperty('display', 'inline');

                document.querySelectorAll('.pauseButton')[id].style.setProperty('display', 'none');
            };
        </script>

    </head>

    <body style="background: black; color: #a3a3a3;">
    <?php

        // var_dump($DeezerApi['artists']);

        // $count = 1;
        // // foreach($DeezerApi['playlists'] as $artist){
        // //     echo "<p style='color: blue;'>$count podcast !!!!!!!!!!!!!!!</p>";
        // //     var_dump($artist);
        // //     $count++;
        // // }

        // $count = 1;
        // foreach($DeezerApi['playlists'] as $test){
        //     echo "<p style='color: blue;'>First Level: $count Index !!!!!!!!!!!!!!!</p>";
        //     $count++;
        //     var_dump($test);
        //     $count2 = 1;
        //     foreach($test as $minitest){
        //         echo "<p style='color: red;'>Second Level: $count2 Index !!!!!!!!!!!!!!!</p>";
        //         $count2++;
        //         var_dump($minitest);
        //         $count3 = 1;
        //         foreach($minitest as $tinytest){
        //             echo "<p style='color: green;'>Third Level: $count3 Index !!!!!!!!!!!!!!!</p>";
        //             $count3++;
        //             var_dump($tinytest);
        //         }
        //     }
        // }
    ?>
        <div class="sidebar">
            <div class="sidebar_top">
                <div class="menuItem">
                    <svg class="Icon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                        <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                    </svg>
                    <h5 class="Icon">Home</h5>
                </div>

                <div onclick="openModal('Upload Song');" class="menuItem">
                    <svg class="Icon" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/>
                    </svg>
                    <h5 class="Icon">Upload</h5>
                </div>
            </div>  

            <div class="sidebar_bottom">
                <span id="trackDetailsToolTip"></span>
                <div>
                    <div class="menuItem">
                        <div>
                            <svg class="library" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                            </svg>
                            <h6>Your Library</h6>
                        </div>
                        <svg class="closePlaylistSearch" onclick="closePlaylistInput(this)" name="exit" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                        </svg>
                        <input type="text" name="Name" placeholder="Playlist's name" autocomplete="off"/>
                        <button onclick="createPlaylist()"></button>
                        <svg class="Icon" id="addPlaylist" name="add" onclick="showPlaylistInput()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                        </svg>

                    </div>
                    <div class="menuItem">
                        <h6>Playlists</h6>
                        <div class="SearchAndArrangePlaylists">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#6e6e6e">
                                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                                </svg>
                            </button>
                            
                        <div class="editMenu" id="viewMenu">
                            <div>
                                <span>Sort by</span>
                            </div>
                            <div>
                                <span>Recently Added</span>
                                <svg class="checkmark" fill="#00ff00" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                </svg>
                            </div>
                            <div>
                                <span>Alphabetical</span>
                            </div>
                            <div>
                                <span>View as</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" viewBox="0 0 448 512">
                                    <path d="M384 96V224H256V96H384zm0 192V416H256V288H384zM192 224H64V96H192V224zM64 288H192V416H64V288zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/>
                                </svg>
                                <span>Compact</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" viewBox="0 0 512 512">
                                    <path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/>
                                </svg>
                                <span>List</span>
                                <svg class="checkmark" fill="#00ff00" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                </svg>
                            </div>
                        </div>

                            <svg id="playlistDisplay" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/>
                            </svg>
                        </div>
                        
                        <div class="Playlists">
                        <?php
                            $count = 0;
                            foreach($user['playlists'] as $playlist){
                            $count++;
                        ?>
                            <div class="Playlist PlaylistHover">
                                <div class="picture">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#ffffff">
                                        <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                    </svg>
                                </div>
                                <div class="description">
                                    <p><?php echo $playlist['Playlist']['Name'] ?></p>
                                    <div class="caption">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                            <path d="M32 32C32 14.3 46.3 0 64 0H320c17.7 0 32 14.3 32 32s-14.3 32-32 32H290.5l11.4 148.2c36.7 19.9 65.7 53.2 79.5 94.7l1 3c3.3 9.8 1.6 20.5-4.4 28.8s-15.7 13.3-26 13.3H32c-10.3 0-19.9-4.9-26-13.3s-7.7-19.1-4.4-28.8l1-3c13.8-41.5 42.8-74.8 79.5-94.7L93.5 64H64C46.3 64 32 49.7 32 32zM160 384h64v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384z"/>
                                        </svg>
                                        
                                        <!-- <span>Playlist</span> -->
                                        <!-- <div class="elipses"></div> -->
                                        <span>
                                            <?php
                                                $numberOfSongsInPlaylist = count($playlist['Songs']);
                                                if( $numberOfSongsInPlaylist == 1) {
                                                    echo "Playlist &bull; $numberOfSongsInPlaylist song";
                                                } else {
                                                    echo "Playlist &bull; $numberOfSongsInPlaylist songs";
                                                }
                                            ?>
                                        </span>   
                                    </div>
                                </div>
                                <svg data-id="<?php echo $count ?>" data-playlistid="<?php echo $playlist['Playlist']['PlaylistId'] ?>" data-name="<?php echo $playlist['Playlist']['Name'] ?>" onclick="openPlaylistEditMenu()" class="editMenuBtn" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512">
                                    <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                </svg>
                            </div> 
                        <?php
                            }
                        ?>
                        </div>
                        <div class="editMenu" id="editMenu">
                            <div onclick="openModal('Edit Playlist');">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/>
                                </svg>
                                <span>Edit details</span>
                            </div>
                            <div onclick="createPlaylist()">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256-96a96 96 0 1 1 0 192 96 96 0 1 1 0-192zm0 224a128 128 0 1 0 0-256 128 128 0 1 0 0 256zm0-96a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/>
                                </svg>
                                <span>Create Playlist</span>
                            </div>
                            <div onclick="pinPlaylist()">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                    <path d="M32 32C32 14.3 46.3 0 64 0H320c17.7 0 32 14.3 32 32s-14.3 32-32 32H290.5l11.4 148.2c36.7 19.9 65.7 53.2 79.5 94.7l1 3c3.3 9.8 1.6 20.5-4.4 28.8s-15.7 13.3-26 13.3H32c-10.3 0-19.9-4.9-26-13.3s-7.7-19.1-4.4-28.8l1-3c13.8-41.5 42.8-74.8 79.5-94.7L93.5 64H64C46.3 64 32 49.7 32 32zM160 384h64v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384z"/>
                                </svg>
                                <span>Pin playlist</span>
                            </div>
                            <div onclick="deletePlaylist()">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM184 232H328c13.3 0 24 10.7 24 24s-10.7 24-24 24H184c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/>
                                </svg>
                                <span>Delete</span>
                            </div>
                        </div>
                        <span id="editMenuToolTip">options</span>
                        <br>
                        <br>

                    </div>
                    <!-- <div class="menuItem">
                        <p>Agora Hills</p>
                        <img src="https://e-cdns-images.dzcdn.net/images/cover/aea5d295972a673a994d88a82fb8e83c/500x500-000000-80-0-0.jpg" />
                        <div class="tracklist">
                            <div>
                                <span>1</span>
                                <p>Paint the Town Red</p>
                                <p>Doja Cat</p>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="paginationButtons">
                        <button onclick="previousPage()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                            </svg> 
                        </button>
                        <button onclick="nextPage()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
            </div>
        </div>


        <div id="myModal" class="modal hidden">

                <div class="uploadSongForm">
                    <span class="close" onclick="closeModal();">&times;</span>
                    <h2>Upload a song</h2>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="Song Name">Song name: </label>
                            <input type="text" name="Name" data-id="0" required>
                        </div>

                        <div class="form-group">
                            <label for="Artist Name">Artist: </label>
                            <input type="text" name="Artist" data-id="1" required>
                        </div>

                        <div class="form-group">
                            <label for="Album Name">Album: </label>
                            <input type="text" name="Album" data-id="2" required>
                        </div>

                        <div class="form-group">
                            <label for="SongPhoto">Cover photo: </label>
                            <div id="dropZone" ondrop="setPhotoState(event);" ondragover="dragOverHandler(event);" class="pictureUpload" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#c5cad3" viewBox="0 0 512 512">
                                    <path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                <p><span>Upload a file</span> or drag and drop</p>  
                                <p>PNG, JPG, GIF up to 10 MB</p>
                            </div>
                            <input type="file" name="Picture">
                        </div>

                        <div class="form-group">
                            <button type="submit">Submit</button>
                        </div>

                    </form>
                </div>

                <div class="editMenu" id="playlistPhotoEditMenu">
                    <div>
                        <svg fill="#a3a3a3" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                        </svg>
                        <span>Change Photo</span>
                    </div>
                    <div>
                        <svg fill="#a3a3a3" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/>
                        </svg>
                        <span>Remove Photo</span>
                    </div>
                </div>

                <div class="editPlaylistForm">
                    <span class="close" onclick="closeModal();">&times;</span>
                    <h3>Edit Playlist</h3>
                    <form action="#" method="post">
                        <div class="options"></div>
                        <div class="picture defaultImage">
                            <svg class="choosePhoto" xmlns="http://www.w3.org/2000/svg" height="1em" fill="#ffffff" viewBox="0 0 512 512">
                                <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/>
                            </svg>
                           <h6 class="choosePhoto">Choose photo</h6>
                           <input class="file_upload" type="file" id="file" name="file">
                        </div>

                        <div class="inputs">
                            <div class="form-group">
                                <label for="Playlist Name">Name</label>
                                <input type="text" name="Name" data-id="0" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="Playlist Description">Description</label>
                                <textarea type="text" name="Description" data-id="1" rows="6" cols="29"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit">Submit</button>
                        </div>
                        
                        <p class="disclaimer">By proceeding, you agree to give Spotify access to the image you choose to upload. Please make sure you have the right to upload the image.</p>
                        
                    </form>
                </div>
        </div>


        <div class="main" style="background: #131313;">
            <span id="mainSearchbarToolTip"></span>
            <div id="mainSearchBarContainer">
                <input id="mainSearchBar" type="text" placeholder="Search artist, album, track..." autocomplete="off"/>
                
                <div id="searchResults"></div>
                <div class="handleBar"></div>
                <div class="paginationButtons">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                            <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                        </svg> 
                    </button>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                            <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="navBar">
                <!-- <button>
                    <svg class="mobileViewNavDropDown" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="#939393">
                        <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                    </svg>
                </button> -->
                <button onclick="showSearchBar()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#6e6e6e">
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                    </svg>
                </button>
                <div class="popup">
                    <div>
                        <p>Logout</p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                    </div>
                    <form action="/user/delete" method="GET" onclick="deleteAccount()">
                        <p>Delete Account</p>
                    </form>
                </div>
                <div class="right">
                    <button onclick="openPopup()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                        </svg>
                    </button>

                    <button>
                        <svg class="notificationSVG" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="#ecedec">
                            <path d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/>
                        </svg>
                    </button>
                    <div class="notificationAlert">
                        <span>2</span>
                    </div>

                </div>
            </div>
            
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
        </div>

        <div class="MusicPlayer">    
            <!-- Left -->
            <div class="left">
                <img />
                <div>
                    <p></p>
                    <p></p>
                </div>
                <svg onclick="addToLikes()" class="likeButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                    <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                </svg>
            </div>

            <!-- Middle -->
            <div class="middle">
                <!-- Top -->
                <div class="top controls">
                    <div onclick="skipOrPrevious(false)">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z"/>
                        </svg>
                    </div>
                    <div onclick="playPause()" id="ctrlIcon">
                        <svg id="play" xmlns="http://www.w3.org/2000/svg" fill="#131313" height="1em" viewBox="0 0 384 512">
                            <path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
                        </svg>
                        <svg id="pause" xmlns="http://www.w3.org/2000/svg" fill="#131313" height="1em" viewBox="0 0 320 512">
                            <path d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z"/>
                        </svg>
                    </div>
                    <div onclick="skipOrPrevious(true)">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4L224 214.3V256v41.7L52.5 440.6zM256 352V256 128 96c0-12.4 7.2-23.7 18.4-29s24.5-3.6 34.1 4.4l192 160c7.3 6.1 11.5 15.1 11.5 24.6s-4.2 18.5-11.5 24.6l-192 160c-9.5 7.9-22.8 9.7-34.1 4.4s-18.4-16.6-18.4-29V352z"/>
                        </svg>
                    </div>
                </div>
                

                <!-- Bottom -->
                <div class="bottom musicPlayer">
                    <audio controls id="song">
                        <source type="audio/mpeg" src="https://cdns-preview-f.dzcdn.net/stream/c-f64683cc83df9b7394afcb80ea85216e-2.mp3" />
                    </audio>
                    <span id="songCurrentTime">0:00</span>
                    <div>
                        <input type="range" value="0" id="progress">
                    </div>
                    <span id="songDuration"></span>
                </div>
            </div>

            <!-- Right -->
            <div class="right volumeControls">
                <svg onclick="mute()" id="volume-low" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M320 64c0-12.6-7.4-24-18.9-29.2s-25-3.1-34.4 5.3L131.8 160H64c-35.3 0-64 28.7-64 64v64c0 35.3 28.7 64 64 64h67.8L266.7 471.9c9.4 8.4 22.9 10.4 34.4 5.3S320 460.6 320 448V64z"/></svg>
                <svg onclick="mute()" id="volume-medium" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM412.6 181.5C434.1 199.1 448 225.9 448 256s-13.9 56.9-35.4 74.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C393.1 284.4 400 271 400 256s-6.9-28.4-17.7-37.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5z"/></svg>
                <svg onclick="mute()" id="volume-high" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M533.6 32.5C598.5 85.3 640 165.8 640 256s-41.5 170.8-106.4 223.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C557.5 398.2 592 331.2 592 256s-34.5-142.2-88.7-186.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zM473.1 107c43.2 35.2 70.9 88.9 70.9 149s-27.7 113.8-70.9 149c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C475.3 341.3 496 301.1 496 256s-20.7-85.3-53.2-111.8c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zm-60.5 74.5C434.1 199.1 448 225.9 448 256s-13.9 56.9-35.4 74.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C393.1 284.4 400 271 400 256s-6.9-28.4-17.7-37.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zM301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3z"/></svg>
                <svg onclick="mute()" id="volume-muted" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM425 167l55 55 55-55c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-55 55 55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-55-55-55 55c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l55-55-55-55c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0z"/></svg>
                <div>
                    <input type="range" id="volume-slider" max="1.0" value="0.5" step="0.05">
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- <div style="display: grid; grid-template-columns: repeat(2, 1fr); grid-gap: 5%; overflow: auto;">
            <h2>overflow-wrap: normal (default):</h2>
            <p class="a" style="width: 5vw; overflow-wrap:break-word;">acoustic afternoone</p>
        </div>
        
        <h1>The vertical-align property</h1>

        <div id="myDIV" style="height: 300px">
        In this paragraph, the <p style="background-color: blue; display: inline;">blue span</p> change the vertical-align value
        </div> -->
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

        <script type="text/javascript" src="../../../assets/javascript/customAudio&volume_interfaces.js"></script>
        <script type="text/javascript" src="../../../assets/javascript/Like.js"></script>

        <script>
            let sidebar_bottom = document.querySelector('.sidebar_bottom div');
            sidebar_bottom.onscroll = () => {
                let img = document.querySelector('.nowPlayingImg');
                let paginationWindowButtons = document.querySelector('.paginationWindowBtns');
                let img_position = img.getBoundingClientRect();

                paginationNavButtons.style.left = (img_position['right'] * 100 / window.innerWidth) - (paginationNavButtons.offsetWidth * 100 / window.innerWidth) + "%";
                paginationNavButtons.style.top = (img_position['bottom'] * 100 / window.innerHeight) - (paginationNavButtons.offsetHeight * 100 / window.innerHeight) + "%";
                paginationNavButtons.style.display = "inline";

                let menuItemPosition = menuItem.getBoundingClientRect();

                paginationWindowButtons.style.left = ((menuItemPosition['right'] - (paginationWindowButtons.offsetWidth / 1.4)) * 100 / window.innerWidth) +  "%";
                paginationWindowButtons.style.top = ((menuItemPosition['top'] - (paginationWindowButtons.offsetHeight / 3)) * 100 / window.innerHeight) + "%";
            };
          

            let mainSectionDiv = document.querySelector('body .main');
            mainSectionDiv.onscroll = function(){
                console.log(this.scrollTop);
                let navBar = document.querySelector('body .main .navBar');
                
                let opacity = (this.scrollTop * 100 / 175) / 100;
                
                opacity > 1 ? opacity = 1 : opacity = opacity; 

                navBar.style.backgroundColor = `rgba(19, 19, 19, ${opacity}`;
                // this.scrollTop >= 50 ? navbar.style.top = "0%" : navbar.style.top = "1%";
                if (this.scrollTop >= 50) {
                    navBar.style.top = "0%";
                } else {
                    navBar.style.top = "1%";
                }

            }
        </script>
    </body>
</html>