console.log("javascript for media player successfully loaded.");

let isPlaying = false;

let progress = document.getElementById("progress");

 let currentTimeCaption = document.getElementById("songCurrentTime");

let song = document.getElementById("song");
console.log("current song selected: " + song);

let ctrlIcon = document.getElementById("ctrlIcon");

song.onloadedmetadata = () => {
  progress.max = Math.round(song.duration);
  progress.value = Math.round(song.currentTime);
  document.getElementById("songDuration").innerHTML = progress.max;
  
  let remainder = (progress.max / 60) % 1;
  document.getElementById("songDuration").innerHTML = remainder.toString().charAt(0) + ":" + Math.round(song.duration) % 60;
}

const playPause = (justResetTheBtn) => {
    let playSvg = document.getElementById("play");
    
    let pauseSvg = document.getElementById("pause");


    pauseSvg.style.display = "none";
    playSvg.style.display = "inline";
    
    if(isPlaying === false && justResetTheBtn === undefined){
        playSvg.style.display = "none";
        pauseSvg.style.display = "inline";
        song.play();  
        isPlaying = true;
    } else {
        song.pause();
        isPlaying = false;
    };

}

const keepPlaying = () => {
    console.log("entering keep playing function")
    let playSvg = document.getElementById("play");
    let pauseSvg = document.getElementById("pause");
    playSvg.style.display = "none";
    pauseSvg.style.display = "inline";
    song.play();
    isPlaying = true;
    console.log(song);
    console.log("Exiting keep playing function.");
}

let minutes = 0;
let startedOnce = false;

song.onstalled = () => {
    console.log("****************Song was interrupted!!!!!");
};

song.onplaying = () => {
    setInterval(() => {
        progress.value = Math.round(song.currentTime);
        
        const percentOfSongPlayed = (song.currentTime * 100) / song.duration;
        
        if(percentOfSongPlayed < 50) {
         progress.style.background = `linear-gradient(to left, #484848 ${(((song.duration - Math.round(song.currentTime)) * 100) / song.duration)}%, var(--progressBar-color) ${percentOfSongPlayed}%)`; 
        } else {
          progress.style.background = `linear-gradient(to right, var(--progressBar-color) ${((Math.round(song.currentTime) * 100) / song.duration)}%, #484848 ${(((song.duration - song.currentTime) * 100) / song.duration)}%)`;
        }
        
        
        
        let seconds = Math.round(song.currentTime) % 60;
        
        if(Math.round(song.currentTime % 60) === 0 & startedOnce == true){
          minutes++;
          startedOnce = true;
        }
        
        
       seconds.toString().length > 1 ? 
          currentTimeCaption.innerHTML = minutes + ":" +           seconds
        :
           currentTimeCaption.innerHTML = minutes + ":0" +            seconds;
         
      }, 600);
};

progress.onchange = (e) => {
    song.currentTime = Number(progress.value);
    console.log("Progress bar was clicked ", progress.value);
    console.log(e);
    isPlaying = true;
    document.getElementById("play").style.display = "none";
    document.getElementById("pause").style.display = "inline";
    song.play();
}

song.onended = () => {    
     document.getElementById("play").style.display = "inline";
     document.getElementById("pause").style.display = "none";
     playPause();
     skipOrPrevious(true);
}

const skipOrPrevious = async(skip) => {
    console.log("Entering skipOrPrevious function**********");
    let currentSong = JSON.parse(localStorage.getItem("selectedSong"));

    console.log(currentSong);

    console.log("skip: ", skip);

    if(skip == true) {
        await setSelectedSong(Number(currentSong["trackNumber"]) + 1, skip);
    } else {
        await setSelectedSong(Number(currentSong["trackNumber"]) - 1, skip);
    }
    isPlaying == false ? playPause() : keepPlaying();

    console.log("Is it playing? ", isPlaying);

    console.log("Exiting skipOrPrevious function**********");

}


// volume

let volumeSlider = document.getElementById("volume-slider");

console.log("Volume Slider: " + volumeSlider);

let volumePercentage = ((volumeSlider.value * 100) / volumeSlider.max);

let volumeProgress = document.getElementById("volume-progress");

let lowVolume = document.getElementById("volume-low");
let mediumVolume = document.getElementById('volume-medium');
let highVolume = document.getElementById('volume-high');



volumeSlider.style.background = `linear-gradient(to right, var(--progressBar-color) ${volumePercentage}%, #484848 ${100 - volumePercentage}%)`;

volumeSlider.onchange = () => {
  song.volume = volumeSlider.value;
  
  volumePercentage = ((volumeSlider.value * 100) / volumeSlider.max);
  
  if(song.volume < .333){
    lowVolume.style.display = "inline";
    mediumVolume.style.display = "none";
    highVolume.style.display = "none";
    
    volumeSlider.style.marginLeft = "1.8%";
    
  } else if(song.volume > .333 && song.volume < .666){
    lowVolume.style.display = "none";
    mediumVolume.style.display = "inline";
    highVolume.style.display = "none";
    
    volumeSlider.style.marginLeft = "1%";
  } else {
    lowVolume.style.display = "none";
    mediumVolume.style.display = "none";
    highVolume.style.display = "inline";
    
    volumeSlider.style.marginLeft = "0.2%";
  }
  
  if(volumePercentage < 50){
    volumeSlider.style.background = `linear-gradient(to left, #484848 ${100 - volumePercentage}%, var(--progressBar-color) ${volumePercentage}%)`;
  } else {
    volumeSlider.style.background = `linear-gradient(to right, var(--progressBar-color) ${volumePercentage}%, #484848 ${100 - volumePercentage}%)`;
  }
}


const mute = () => {
  let muteButton = document.getElementById("volume-muted");
  
  if(song.volume > 0){
    song.volume = 0;
    volumeSlider.value = 0;
    lowVolume.style.display = "none";
    mediumVolume.style.display = "none";
    highVolume.style.display = "none";
    muteButton.style.display = "inline";
    
  } else {
    song.volume = 0.5;
    volumeSlider.value = 0.5;
    muteButton.style.display = "none";
    mediumVolume.style.display = "inline";
  }
}

async function setSelectedSong(index, skip){

    console.log("Entering setSelectedSong function.....");

    document.querySelector('.MusicPlayer .left').style.visibility = 'visible';

    console.log("TrackNumber: ", index);

    let album = JSON.parse(localStorage.getItem("selectedAlbum"))['tracks'];

    console.log(album);

    console.log("TrackNumber: ", index, " skip: ", skip);

    let currentTrackName = document.querySelectorAll(".MusicPlayer .left div p")[0];
    let currentTrackArtist = document.querySelectorAll(".MusicPlayer .left div p")[1];
    let picture = document.querySelector(".MusicPlayer .left img");


    skip == true ?
        index >= album.length ? index = 0 : index = index
        :
        index < 0 ? index = album.length - 1 : index = index;
    
    const isEmpty = () => {
        isItEmpty = false;
        if(album[index]['preview'] != null || album[index]['preview'].length != 0) {
            index = index;
            isItEmpty = false;
        } else {
            index++;
            isItEmpty = true;
        }

        isItEmpty == false ? isEmpty() : "";
    };

    album[index]['album'] ? picture.src = album[index]['album']['cover'] : picture.src = JSON.parse(localStorage.getItem("selectedAlbum"))['cover'];

    album[index]['title'].length > 20 ? currentTrackName.innerHTML = album[index]['title'].substring(0, 20).trimEnd().concat("...") : currentTrackName.innerHTML = album[index]['title'];

    let albumSize;

    if (album[index]['album']){
        albumSize = await numberOfTracksInAlbum(album[index]['album']['tracklist']);
    }
    
    if(albumSize != null) {
        album[index]['album'] && albumSize > 1 ? currentTrackArtist.innerHTML = album[index]['album']['title'] : currentTrackArtist.innerHTML = album[index]['artist']['name'];
    } else {
        currentTrackArtist.innerHTML = album[index]['artist']['name'];
    };

    let selectedSong;
    try {
        selectedSong = JSON.parse(localStorage.getItem(("selectedSong")));

        let svg = document.querySelectorAll(".sidebar .sidebar_bottom div .menuItem")[2].querySelectorAll(".tracklist .track")[Number(selectedSong['trackNumber']) - ((currentPage - 1) * songsPerPage)].querySelector('.playBtn');
        svg.style.display = "none";

        let indexSpan = document.querySelectorAll(".sidebar .sidebar_bottom div .menuItem")[2].querySelectorAll(".tracklist .track")[Number(selectedSong['trackNumber']) - ((currentPage - 1) * songsPerPage)].querySelector('span');
        indexSpan.style.display = "inline";
        
        console.log("Previous Song Selected!!!!! ", selectedSong);
    } catch {
        console.log("No song previously selected!!!!!");
    } finally {
        selectedSong = {"song" : album[index], "trackNumber" : index};
    };

    song.src = album[index]['preview'];

    localStorage.setItem("selectedSong", JSON.stringify(selectedSong));

    console.log("Selected song: ", selectedSong);

    console.log("Exiting setSelectedSong function.....");
};

const renderSvgIcon = (node, path) => {
    const iconSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    const iconPath = document.createElementNS(
        'http://www.w3.org/2000/svg',
        'path'
    );


    iconPath.setAttribute(
        'd',
        `${path}`
    );
    // iconPath.setAttribute('stroke-linecap', 'round');
    // iconPath.setAttribute('stroke-linejoin', 'round');

    iconSvg.appendChild(iconPath);
    node.appendChild(iconSvg);

    return iconSvg;
}

let mainSearchBar = document.getElementById('mainSearchBar');
let searchBarWrapper = document.getElementById('mainSearchBarContainer');

mainSearchBar.onpointerdown = (e) => {
    window.onclick = null;    
};

mainSearchBar.onpointercancel = (e) => {
    console.log("Pointer cancel has fired!!!!!!");
    setTimeout(() => {
        window.onclick = (e) => {
            let position = mainSearchBar.getBoundingClientRect();
            if(e.pageX < position['left'] || e.pageX > position['right'] || e.pageY < position['top'] || e.pageY > position['bottom']) {
                searchBarWrapper.style.display = 'none';
                window.onclick = null;           
            };
        };
    }, 700); 
};

const showSearchBar = () => {
    
    getComputedStyle(searchBarWrapper)['display'] == 'none' ?
        searchBarWrapper.style.display = 'inline'
            :
        searchBarWrapper.style.display = 'none';
   
    setTimeout(() => {
        window.onclick = (e) => {
            let position = mainSearchBar.getBoundingClientRect();
            if(e.pageX < position['left'] || e.pageX > position['right'] || e.pageY < position['top'] || e.pageY > position['bottom']) {
                searchBarWrapper.style.display = 'none';
                window.onclick = null;           
            };
        };
    }, 500); 
};

let searchResultsToolTip = document.getElementById('mainSearchbarToolTip');
let searchResults = document.getElementById('searchResults');


searchResults.onpointerdown = (e) => {
    console.log(e);
}

searchResultsToolTip.onpointerenter = () => {
    searchResultsToolTip.style.display = "inline";
}

searchResultsToolTip.onpointerleave = () => {
    searchResultsToolTip.style.display = "none";
}


const createAndAppendSearchResult = (url, title, cover, name, albumTitle, index) => {
    let searchResult = document.createElement('div');

    searchResult.classList.add('searchResult');

    let albumCover = document.createElement('img');
    albumCover.classList.add('albumCover');
    albumCover.src = cover;

    let trackName = document.createElement('p');
    trackName.id = "searchResultDescription";
    
    title.length > 14 ? trackName.innerHTML = title.substring(0, 14).trimEnd().concat("...") : trackName.innerHTML = title;

    if(title.length > 14){
        trackName.dataset.trackNumber = x;

        trackName.addEventListener('pointermove', (e) => {

            searchResultsToolTip.innerHTML = title;
            
            // (mouse position from top) - (toolTip height) && (mouse position from left) - (toolTip width) = (toolTip bottom right corner screen coordinates)
            // searchResultsToolTip.style.top = ((e.pageY * 100) / window.innerHeight) - ((searchResultsToolTip.offsetHeight * 100) / window.innerHeight) + "%";
            // searchResultsToolTip.style.left = ((e.pageX * 100) / window.innerWidth) - ((searchResultsToolTip.offsetWidth * 100) / window.innerWidth) + "%";

            searchResultsToolTip.style.top = (((e.pageY * 100) / window.innerHeight) - ((searchResultsToolTip.offsetHeight * 100) / window.innerHeight)) - 0.25 + "%";
            searchResultsToolTip.style.left = (((e.pageX * 100) / window.innerWidth) - ((searchResultsToolTip.offsetWidth * 100) / window.innerWidth)) + "%";

            searchResultsToolTip.style.display = "inline-block";
        });

        trackName.onpointerleave = () => {
            searchResultsToolTip.style.display = "none";
        }
    };

    let artistName = document.createElement('p');
    artistName.classList.add('artistName');
    artistName.id = "searchResultDescription";

    name.length > 14 ? artistName.innerHTML = name.substring(0, 14).trimEnd().concat("...") : artistName.innerHTML = name;

    if(name.length > 14){
        artistName.dataset.trackNumber = x;

        artistName.addEventListener('pointermove', (e) => {

            searchResultsToolTip.innerHTML = artistName.innerHTML + "";

            searchResultsToolTip.style.top = ((e.pageY * 100) / window.innerHeight) - ((searchResultsToolTip.offsetHeight * 100) / window.innerHeight) - 0.25 + "%";
            searchResultsToolTip.style.left = ((e.pageX * 100) / window.innerWidth) - ((searchResultsToolTip.offsetWidth * 100) / window.innerWidth) + "%";

            searchResultsToolTip.style.display = "inline-block";

        });

        artistName.onpointerleave = function(){
            searchResultsToolTip.style.display = "none";
        }

    }


    let description = document.createElement('div');

    let svg = document.createElement('svg');

    description.append(trackName);
    description.append(artistName);


    searchResult.append(albumCover);
    searchResult.append(description);

    let musicSvgIcon = renderSvgIcon(searchResult, 'M499.1 6.3c8.1 6 12.9 15.6 12.9 25.7v72V368c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V147L192 223.8V432c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V200 128c0-14.1 9.3-26.6 22.8-30.7l320-96c9.7-2.9 20.2-1.1 28.3 5z');

    musicSvgIcon.setAttribute('fill', '#131313');
    musicSvgIcon.setAttribute('viewBox', '0 0 512 512');
    musicSvgIcon.setAttribute('stroke', '#131313');
    musicSvgIcon.setAttribute('height', '1em');
    musicSvgIcon.classList.add('post-icon');


    searchResult.dataset.trackNumber = index;
    searchResult.dataset.url = url;
    searchResult.dataset.trackName = title;
    searchResult.dataset.cover = cover;
    searchResult.dataset.artistName = name;
    searchResult.dataset.albumTitle = albumTitle;

    searchResult.addEventListener('click', async() => {
        console.log("Clicked on search result.");
        const album = await makeAPIcall(searchResult.dataset.url);
        const dictionary = new Map();

        for(track of album){
            dictionary.set(`${track.title}`, track);
        };

        console.log("Dictionary!!!!", dictionary);
        
        let currentTrack = dictionary.get(`${searchResult.dataset.trackName}`);
        console.log("Current Track: ", currentTrack);
        if(currentTrack){
            currentTrack['track_position'] ? searchResult.dataset.trackNumber = currentTrack['track_position'] : currentTrack['trackNumber'] ? searchResult.dataset.trackNumber = currentTrack['trackNumber'] : searchResult.dataset.trackNumber = searchResult.dataset.trackNumber;
        };


        console.log(searchResult);
        console.log(searchResult.dataset.url);
        console.log(searchResult.dataset.trackName);
        console.log(searchResult.dataset.cover);
        console.log(searchResult.dataset.artistName);
        getAlbum(searchResult.dataset.url, searchResult.dataset.albumTitle, searchResult.dataset.cover, searchResult.dataset.artistName, searchResult.dataset.trackNumber - 1);
    })

    searchResults.append(searchResult);
};

// let searchResultsPagination = new Array();
// let numberOfElementsPerPagintionPage = 5;
// let numberOfPaginationPages;
// let currentPage;

let paginationButtons = document.querySelector('#mainSearchBarContainer .paginationButtons');

let handlebar = document.querySelector('.handleBar');
let handlebar_position = document.querySelector('.handleBar').getBoundingClientRect();
let height = 14.5;
let active = false;

handlebar.onpointerdown = (e) => {

    console.log('Dragging the menu.');
    handlebar.setPointerCapture(e.pointerId);
    active = true
    let mouseCurrentPositionY = e.pageY;

    handlebar.onpointermove = (e) => {
        handlebar.style.visibility = 'visible';
        paginationButtons.style.visibility = 'visible';
        searchResults.style.visibility = 'visible';
        
        if(active == true){
            let mediaPlayer_position = document.querySelector('.MusicPlayer').getBoundingClientRect()['top'];
            console.log(document.querySelector('.MusicPlayer'));

            e.pageY > mouseCurrentPositionY && searchResults.getBoundingClientRect()['bottom'] < mediaPlayer_position ? height += 0.25 : height > 14.5 ? height -= 0.255555 : height = 14.5;

            mouseCurrentPositionY = e.pageY;
            
            searchResults.style.height = height + "rem";
            let position = searchResults.getBoundingClientRect();
            paginationButtons.style.top = ((position['bottom'] * 100) / window.innerHeight) - (paginationButtons.offsetHeight * 100 / window.innerHeight) + 1 + "%"
            paginationButtons.style.left = ((position['right'] * 100) / window.innerWidth ) - (paginationButtons.offsetWidth * 100 / window.innerWidth) + 0.55 + "%";
        }
    };
};

handlebar.onpointerup = (e) => {
    console.log("Stop resizing window!!!!!");
    setTimeout((e) => {
        handlebar.onpointermove = null;
        active = false
    }, 200);
};

window.onresize = () => {
    let position = searchResults.getBoundingClientRect();
    paginationButtons.style.top = ((position['bottom'] * 100) / window.innerHeight) - (paginationButtons.offsetHeight * 100 / window.innerHeight) + 1 + "%"
    paginationButtons.style.left = ((position['right'] * 100) / window.innerWidth ) - (paginationButtons.offsetWidth * 100 / window.innerWidth) + 0.55 + "%";
    // console.log("Window is resizing.");
};

mainSearchBar.oninput = (e) => {

    let url = "https://api.deezer.com/search?q=" + e.target.value;

    // console.log("Search Bar has input!!!!!!!  length: ", e.target.value.length, " value: ", e.target.value);


    if(e.target.value.length > 0) {
        makeAPIcall(url).then(function(data){

            console.log(data);

            searchResults.innerHTML = "";

            for(x = 0; x < data.length; x++){
                createAndAppendSearchResult(data[x]['album']['tracklist'], data[x]['title'], data[x]['album']['cover_big'], data[x]['artist']['name'], data[x]['album']['title'], x);
            }

            searchResults.onscroll = () => {
                searchResultsToolTip.style.display = "none";
            }

            let position = searchResults.getBoundingClientRect();

            console.log(paginationButtons);
            console.log(position);

            console.log("paginationButtons height: ", paginationButtons.offsetHeight * 100 / window.innerHeight);
            console.log("paginationButtons width: ", paginationButtons.offsetWidth * 100 / window.innerWidth);      

            paginationButtons.style.top = ((position['bottom'] * 100) / window.innerHeight) - (paginationButtons.offsetHeight * 100 / window.innerHeight) + 1 + "%"
            paginationButtons.style.left = ((position['right'] * 100) / window.innerWidth ) - (paginationButtons.offsetWidth * 100 / window.innerWidth) + 0.55 + "%";
            
            paginationButtons.style.visibility = 'visible';
            searchResults.style.visibility = 'visible';
            handlebar.style.visibility = 'visible';

            window.onclick = () => {
                if(active == false){
                    handlebar.style.visibility = 'hidden';
                    paginationButtons.style.visibility = 'hidden';
                    searchResults.style.visibility = 'hidden';
                    searchBarWrapper.style.display = 'none';
                    window.onclick = null;
                }
            };

        }).catch(function(error){
            console.log("API call to search for input failed: ", error);
        })
    } else {
        console.log("Search input is empty.");
    };
};

mainSearchBar.onblur = (e) => {
    setTimeout(() => {
        handlebar.style.visibility = 'hidden';
        paginationButtons.style.visibility = 'hidden';
        searchResults.style.visibility = 'hidden';
    }, 200);
};

const pagination = (data, num) => {
    let pages = new Array();
    const itemsPerPage = num;                
    let page = new Array();

    let count = 0;
    data.forEach((value, key, map) => {
        page.push(value);

        count++;
        if(page.length === itemsPerPage || count === data.size - 1){
            pages.push(page);
            page = new Array();
            count = 0;
        };
    });

    if(page.length > 0)
        pages.push(page);

    return pages;
};

let pages;
let currentPage = 0;