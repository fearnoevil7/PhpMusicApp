const makeRequestToBackend = (url) => {
    return new Promise(function (resolve,reject){
        const xhttpr = new XMLHttpRequest();

        xhttpr.open('GET', url, true); 
        xhttpr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        xhttpr.send();
        let response;
        xhttpr.onload = () => { 
            if (xhttpr.status === 200) { 
                console.log('GET request completed.');
                response = JSON.parse(xhttpr.response);
                console.log("Response: ", response);
                resolve(response);
            } else { 
                console.log(`Error: ${xhttpr.status}`);
                reject({"Status code" : `${xhttpr.status}`});
            }
        }
    })
};

const addToLikes = async(e) => {
    console.log("Entering addToLikes function!!!!!!");

    // console.log(JSON.parse(localStorage.getItem("selectedSong")));

    let currentSong = JSON.parse(localStorage.getItem("selectedSong"));

    let urlRegex = new RegExp('https://www.deezer.com/');
    let url;

    if(urlRegex.test(currentSong['song']['link']) === true)
        url = currentSong['song']['link'].replace('deezer.com', 'api.deezer.com');

    // const body = {
    //             Name: currentSong['song']['title'],
    //             Artist: currentSong['song']['artist']['name'],
    //             Url: currentSong['song']['preview'],
    //             AlbumTitle: currentSong['song']['album'] ? currentSong['song']['album']['title'] : null,
    //             Picture: currentSong['song']['album'] ? currentSong['song']['album']['cover_medium'] : null,
    //             ApiUrl: url
    //         };

    // // console.log("Sending body: ", JSON.parse(body));

    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.open("POST", "http://localhost:8888/song/add", true);
    // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // xmlhttp.send(`Name=${JSON.stringify(currentSong['song']['title'])}&Artist=${JSON.stringify(currentSong['song']['artist']['name'])}&Url=${JSON.stringify(currentSong['song']['preview'])}&AlbumTitle=${currentSong['song']['album'] ? JSON.stringify(currentSong['song']['album']['title']) : JSON.stringify(null)}&Picture=${currentSong['song']['album'] ? JSON.stringify(currentSong['song']['album']['cover_medium']) : JSON.stringify(null)}$ApiUrl=${JSON.stringify(url)}`);

    // xmlhttp.onload = () => {
    //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    //         console.log("Successfully posted to database.");
    //         console.log(xmlhttp.responseText);
    //     } else {
    //         console.log(`Error: ${xmlhttp.status}`);
    //     }
    // };

    let options = { 
        method: 'POST', 
        headers: { 
            'Content-Type':  
                'application/json'
        }, 
        body: JSON.stringify({
            Name: currentSong['song']['title'],
            Artist: currentSong['song']['artist']['name'],
            Url: currentSong['song']['preview'],
            AlbumTitle: currentSong['song']['album'] ? currentSong['song']['album']['title'] : null,
            Picture: currentSong['song']['album'] ? currentSong['song']['album']['cover_medium'] : null,
            ApiUrl: url
        })
    }

    let fetchRes = fetch( 
        "http://localhost:8888/like/create", options); 
        
    fetchRes.then(response => 
        response.json()).then(data => { 
            console.log(data) 
        }).catch((error) => {
            console.log("API Call failed: ", error);
        });


    console.log("Exiting addToLikes function!!!!!!");
};

let input = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelector("input[name='Name']");
let exitSVG = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelectorAll('svg')[1];

const positionSVG = () => {
    const position = input.getBoundingClientRect();
    const svgPosition = exitSVG.getBoundingClientRect();
    const sidebar = document.querySelector('.sidebar .sidebar_bottom');
    const sidebarPosition = sidebar.getBoundingClientRect();

    console.log("Exit svg: ", exitSVG);
    let test = position['right'] - sidebar.offsetWidth;
    console.log("Sidebar_bottom: ", sidebar, " width: ", sidebar.offsetWidth, " height: ", sidebar.offsetHeight);
    console.log(position, " window height: ", window.innerHeight, " window width: ", window.innerWidth, " exitSVG width: ", svgPosition['width'], " exitSVG height: ", svgPosition['height']);
    exitSVG.style.left = `${((position.right - sidebarPosition.left - (svgPosition.width * 0.75)) * 100 / sidebar.offsetWidth)}%`
};

positionSVG();

const resizeObserver = new ResizeObserver((entry) => {
    // for (let entry of entries) {
    //     const { target } = entry;
    //     console.log(target);
    //     console.log(entry);
    //     console.log(`Element size changed: ${target.clientWidth}x${target.clientHeight}`);
    // }
    
    const { target } = entry;
    console.log(entry)
    console.log(target);
    console.log(`Element size changed.`);
    positionSVG();
});
resizeObserver.observe(input);

// create playlists text input
const showPlaylistInput = () => {
    // let addSVG = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelectorAll('svg')[2];
    let addSVG = document.getElementById("addPlaylist");
    let div = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelector('div');
    let container =  document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0];
    let sendBtn = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelector('button');

    addSVG.style.display = "none";
    div.style.display = "none";
    container.style.right = "4%";
    input.style.display = "inline";
    sendBtn.style.display = "inline";
    exitSVG.style.display = "inline";

    console.log("svg: ", addSVG, " div: ", div, " input: ", input, " exitSVG ", exitSVG);
};

const closePlaylistInput = () => {
    let addSVG = document.getElementById("addPlaylist");
    let div = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelector('div');
    let sendBtn = document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0].querySelector('button');
    let container =  document.querySelectorAll('.sidebar .sidebar_bottom .menuItem')[0];

    addSVG.style.display = "inline";
    div.style.display = "contents";
    container.style.right = "0%";
    input.style.display = "none";
    sendBtn.style.display = "none";
    exitSVG.style.display = "none";
    console.log("svg: ", addSVG, " div: ", div, " input: ", input, " exitSVG ", exitSVG);
};

let Popup = document.querySelector('.popup');

const openPopup = () => {
    Popup.style.display = 'inline';
    console.log("Popup Button: ", Popup);
    
    setTimeout(() => {
            window.onclick = (e) => {
                let position = Popup.getBoundingClientRect();

                if(e.pageX < position['left'] || e.pageX > position['right'] || e.pageY < position['top'] || e.pageY > position['bottom']) {
                    Popup.style.display = "none"
                    window.onclick = null;
                };
            };
        }, 100);
};

let editMenu = document.getElementById('editMenu');
const closePlaylistEditMenu = () => {
    editMenu.style.display = 'none';
}

const createPlaylist = async() => {
    let name = document.querySelector('.sidebar .sidebar_bottom div .menuItem input').value;

    if(name != null && name.length > 0) {
        makeRequestToBackend(`http://localhost:8888/playlist/create/${encodeURIComponent(btoa(name))}`);
    } else {
        console.log("name is empty.");
        closePlaylistEditMenu();
        
        let count = 1; 
        let areThereDuplicates = true;
        while(areThereDuplicates != false) {
            name = "My Playlist #" + count;
            console.log(name);
            let response = await makeRequestToBackend(`http://localhost:8888/playlist/create/${encodeURIComponent(btoa(name))}`);
            console.log(response);
            response['Playlist With the Same Name'] === null ? areThereDuplicates = false : count++;
        };
    }

};

// Playlist edit menu
let playlistEditMenus = document.querySelectorAll('.editMenuBtn');
let editMenuToolTip = document.getElementById('editMenuToolTip');
let numberOfPlaylists = 0;
const sidebar = document.querySelector('.sidebar .sidebar_bottom');
let isMenuActive = false;

playlistEditMenus.forEach(editMenuSVG => {
    
    let playlistTitle = document.querySelectorAll('.Playlist')[numberOfPlaylists].querySelector('.description p');
    numberOfPlaylists++;
    
    editMenuSVG.onpointerover = (e) => {
        if(isMenuActive == false) {
                console.log("playlistTitle: ", playlistTitle);
                const svgPosition = editMenuSVG.getBoundingClientRect();
                editMenuToolTip.innerHTML = "More options for " + playlistTitle.innerHTML + "." ;
                editMenuToolTip.style.display = "inline";
                editMenuToolTip.style.left = (svgPosition['left'] - (editMenuToolTip.offsetWidth / 8) ) * 100 / window.innerWidth + "%";
                editMenuToolTip.style.top = (svgPosition['top'] - (editMenuToolTip.offsetHeight * 1.25)) * 100 / window.innerHeight  + "%";
        }
        window.onclick = null;
    }
    
    editMenuSVG.onpointerleave = (e) => {
        editMenuToolTip.style.display = "none";   
        window.onclick = (e) => {
            console.log("Testing1234567 ", editMenuSVG.dataset.id);

            setTimeout(() => {
                
                let editMenuPosition = editMenu.getBoundingClientRect();
                console.log("top: ", editMenuPosition['top'], " bottom: ", editMenuPosition['bottom'], " left: ", editMenuPosition['left'], " right: ", editMenuPosition['right']); 
                console.log("offsetX: ", e.pageX, "offsetY: ", e.pageY);

                if(e.pageX < editMenuPosition['left'] || e.pageX > editMenuPosition['right'] || e.pageY < editMenuPosition['top'] || e.pageY > editMenuPosition['bottom']) {
                    editMenu.style.display = "none";
                    isMenuActive = false;
                } else {
                    editMenu.style.display = "inline";
                    isMenuActive = true;
                };

                window.onclick = null;
            }, 100);
        };
    };

    editMenuSVG.onclick = () => {
        isMenuActive = true;
        editMenuToolTip.style.display = "none";
        editMenu.style.display = "inline";
        let svgPosition = editMenuSVG.getBoundingClientRect();
        editMenu.style.left = (svgPosition['left'] + (svgPosition['width'] / 2)) * 100 / window.innerWidth + "%";  
        editMenu.style.top = (svgPosition['top'] + (svgPosition['height'] * 1.125)) * 100 / window.innerHeight + "%";

        editMenu.dataset.playlistid = editMenuSVG.dataset.playlistid;
        editMenu.dataset.name = editMenuSVG.dataset.name;
        console.log("PlaylistId: ", editMenu.dataset.playlistid, "  ", editMenuSVG.dataset.playlistid);
        console.log(editMenuSVG);

        editMenu.onpointerleave = (e) => {
            isMenuActive = false;
            editMenu.style.display = "none";
        };
    };
});

const pinPlaylist = async() => {
    closePlaylistEditMenu();
    let response = await makeRequestToBackend(`http://localhost:8888/playlist/pin/${editMenu.dataset.playlistid}/${encodeURIComponent(btoa(editMenu.dataset.name))}`);
    console.log(response);
};

const deletePlaylist = () => {
    console.log(editMenu.dataset.playlistid);
    closePlaylistEditMenu();
    makeRequestToBackend(`http://localhost:8888/playlist/delete/${editMenu.dataset.playlistid}`);
};

let dropDownBtn = document.getElementById('playlistDisplay');
dropDownBtn.addEventListener('click', () => {
    console.log("Initiating click function.");
    console.log(active);
    let button = document.getElementById('playlistDisplay');
    let viewMenu = document.getElementById('viewMenu');
    viewMenu.classList.add('viewMenu');
    console.log("viewMenu: ", viewMenu);
    const buttonPosition = button.getBoundingClientRect();
    console.log(buttonPosition, buttonPosition.right * 100 / sidebar.offsetWidth);
    viewMenu.style.top = (buttonPosition.bottom - (buttonPosition.height * 2.5)) * 100 / sidebar.offsetHeight + "%";
    viewMenu.style.left = (buttonPosition.right - (buttonPosition.width * 0.8)) * 100 / window.innerWidth + "%";

    console.log("viewMenu: ", viewMenu.querySelectorAll('div'));

    let buttons = viewMenu.querySelectorAll('div');

    const changeCheckmark = (node) => {
        let previouslySelected = document.querySelectorAll('.checkmark')[1];
        console.log(previouslySelected);
        previouslySelected.remove();

        let newCheckmark = renderSvgIcon(node, "M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z");
        newCheckmark.setAttribute('fill', '#131313');
        newCheckmark.setAttribute('viewBox', '0 0 448 512');
        newCheckmark.setAttribute('stroke', '#131313');
        newCheckmark.setAttribute('height', '1em');
        newCheckmark.classList.add('checkmark');
    };

    let root = document.querySelector(':root');
    let playlists = document.querySelectorAll('.PlaylistHover');

    buttons[4].addEventListener('click', (e) => {
        changeCheckmark(buttons[4]);
        root.style.setProperty('--playlists-flex-direction', 'row');
        root.style.setProperty('--playlists-content-flex-direction', 'column');
        root.style.setProperty('--playlists-caption-display', 'inline');
        root.style.setProperty('--playlists-flex-wrap', 'wrap');

        playlists.forEach(playlist => {
            playlist.classList.remove('PlaylistHover');
            playlist.classList.add('PlaylistInRow');

            let picture = playlist.querySelector('.picture');
            picture.style.width = "8rem";

        });

        active = false;
    });

    buttons[5].addEventListener('click', (e) => {
        changeCheckmark(buttons[5]);
        root.style.setProperty('--playlists-flex-direction', 'column');
        root.style.setProperty('--playlists-content-flex-direction', 'row');
        root.style.setProperty('--playlists-caption-display', 'grid');
        root.style.setProperty('--playlists-flex-wrap', 'nowrap');
    
        playlists.forEach(playlist => {
            playlist.classList.remove('PlaylistInRow');
            playlist.classList.add('PlaylistHover');
        
            let picture = playlist.querySelector('.picture');
            picture.style.width = "3rem";
        });

        viewMenu.classList.remove('viewMenu');
    });


    viewMenu.addEventListener('pointerover', (e) => {
        active = true;
    });

    viewMenu.addEventListener('pointerleave', (e) => {
        viewMenu.classList.remove('viewMenu');
        active = false;
        window.onclick = null;
    });

    dropDownBtn.addEventListener('pointerleave', () => {
        console.log("setting up window click event. ");
        window.onclick = (e) => {
            console.log(active);
            if(active == false){
                console.log("Closing popup. ", active);
                viewMenu.classList.remove('viewMenu');
                window.onclick = null;
            }
        };
    });

});

const setPhotoState = (e) => {
    console.log("File(s) dropped.");

    // Prevent default behavior (Prevent file from being opened)
    e.preventDefault();

    // if(e.dataTransfer.items) {
    //     // Use DataTransferItemList interface to access the files(s)
    //     [...e.dataTransfer.items].forEach((item, i) => {
    //     // If dropped items aren't files, reject them
    //     if(item.kind === "file") {
    //         const file = item.getAsFile();
    //         console.log(`.. file[${i}].name = ${file.name}`);
    //     }; 
    //     });
    // } else {
    //     [...e.dataTransfer.files].forEach((files, i) => {
    //         console.log(`.. file[${i}].name = ${file.name}`);
    //     });
    // }

    console.log(e.dataTransfer.files);
};

const dragOverHandler = (e) => {
    console.log("File(s) in drop zone.")

    // Prevent default behavior (Prevent file from beig opened).
    e.preventDefault();
};

const deleteAccount = () => {
    const form = document.querySelector('.popup form');
    form.submit();
};

// Get the modal and buttons
var modal = document.getElementById('myModal');
var openModalBtn = document.getElementById('openModalBtn');
var closeModalBtn = document.getElementById('closeModalBtn');

// Open the modal
const openModal = (action) => {
    console.log(action);
    let uploadSongForm = document.querySelector('.uploadSongForm');
    let editPlaylistForm = document.querySelector('.editPlaylistForm');
    
    if(action === 'Upload Song') {
        editPlaylistForm.style.display = "none";
        uploadSongForm.style.display = "inline";
    } else {
        closePlaylistEditMenu();
        uploadSongForm.style.display = "none";
        editPlaylistForm.style.display = "inline";

        let input = editPlaylistForm.querySelector('div.inputs input[type="text"]');
        let textInput_label = document.querySelector('div.inputs label[for="Playlist Name"]');   

        let textarea = editPlaylistForm.querySelector('div.inputs textarea');
        let textarea_label = document.querySelector('div.inputs label[for="Playlist Description"]');

        const setUpInput = (element, label, boolean) => {
            console.log("setting up input ", boolean);
            hasPointerLeft = false;

            let pristine = true;
            let nameLabelTop = null;
            let descriptionLabelTop = null;

            const interactWithElement = async(element, label, boolean) => {
                console.log("Interacting with element!!!!");

                console.log(element.name);

                let position = element.getBoundingClientRect();
                console.log(label.offsetHeight, "  ", label.offsetHeight + position['top'] );

                label.style.visibility = "visible";

                label.style.left = (position['left'] + (document.querySelector('div.inputs label[for="Playlist Name"]').offsetWidth / 8)) * 100 / window.innerWidth + "%";
                console.log("Boolean: ", boolean);
            
                if(element.name == "Description" && pristine == true) {
                    label.style.top = (position['top'] - (label.offsetHeight / 2) - 1) * 100 / window.innerHeight + "%";
                } else if (element.name == "Name") {
                    if(nameLabelTop == null)
                        nameLabelTop = (position['top'] - (label.offsetHeight / 2) + 0) * 100 / window.innerHeight + "%";

                    label.style.top = nameLabelTop;
                }

                pristine = false;
                label.style.background = "linear-gradient(180deg, #131313 50%, rgba(37,37,37,1) 50%)";
                element.style.border = "1px solid #393939"; 
                element.style.background = "rgba(37,37,37,1)";
            };
        
            const leaveElement = (element, label) => {
                console.log("Leaving with element!!!!");
                element.style.border = "none";
                element.style.background = "#393939"; 
                // element.style.background = "rgba(37,37,37,1)";

                label.style.visibility = "hidden";
            };

            element.addEventListener('pointerdown', () => {
                console.log(boolean);
                interactWithElement(element, label, boolean);
            }, false);

            element.addEventListener('blur', () => {
                console.log(boolean);
                leaveElement(element, label, boolean);
            }, false);
        }

        setUpInput(input, textInput_label, false);
        setUpInput(textarea, textarea_label, true);


        let button = modal.querySelector('.options');
        console.log("Options Button: ", button);
        let menu = document.getElementById('playlistPhotoEditMenu');
        let picture = modal.querySelector('div.picture');

        picture.addEventListener('pointerenter', () => {
            button.style.visibility = "visible";
            let position = picture.getBoundingClientRect();
            button.style.top = (position.top + (button.offsetHeight / 4)) * 100 / window.innerHeight + "%";
            button.style.right = ((window.innerWidth - position.right) + (button.offsetWidth / 4)) * 100 / window.innerWidth + "%";
        });

        picture.addEventListener('pointerleave', () => {
            
            if(isMenuActive == false)
                button.style.visibility = "hidden"
            
        });

        button.addEventListener('pointerover', () => {
            button.style.visibility = "visible";
        });

        button.addEventListener('click', () => {
            console.log("Opening menu.");

            button.style.visibility = "visible";

            menu.addEventListener('pointerenter', () => {
                active = true;
                button.style.visibility = "visible";
            });

            menu.addEventListener('pointerleave', () => {
                active = false;
                button.style.visibility = "visible";
            });

            button.addEventListener('pointerleave', (e) => {
                console.log('leaving button. ', e.clientX, " ", e.clientY, button.getBoundingClientRect());
                setTimeout(window.onclick = (e) => {
                    let mousePositionX;
                    try {
                        mousePositionX = e.clientX;
                    } catch {
                        mousePositionX = null;
                    };

                    if(active === false && mousePositionX != null) {
                        let buttonPosition = button.getBoundingClientRect();
                        console.log("closing menu!!!");
                        if(e.clientX < buttonPosition.left || e.clientX > buttonPosition.right || e.clientY < buttonPosition.top || e.clientY > buttonPosition.bottom)
                            menu.style.display = "none";

                        isMenuActive = false;
                        let position = picture.getBoundingClientRect();
                        console.log(e);
                        // console.log(e.clientX)
                        console.log(e, " Left: ", picture.offsetLeft, " right: ", position.right, " Top: ", picture.offsetTop, " Bottom: ", position.bottom, " clientX: ", e.clientX, " clientY: ", e.clientY);
                        if(e.clientX > picture.offsetLeft && e.clientX < position.right && e.clientY > picture.offsetTop && e.clientY < position.bottom) {
                            console.log("show button!");
                            console.log('testing: ', e.clientX, " ", e.clientY, button.getBoundingClientRect());
                            button.style.visibility = "visible";
                        } else {
                            button.style.visibility = "hidden";
                        }

                        console.log("Exiting ****", getComputedStyle(button))

                        window.onclick = null;
                    }
                }, 300);
            })

            menu.style.display = "flex";
            menu.style.top = (button.offsetTop + button.offsetHeight + (button.offsetHeight / 4)) * 100 / window.innerHeight + "%";
            menu.style.left = button.offsetLeft * 100 / window.innerWidth + "%";

            isMenuActive = true;
        });
    }

    modal.style.display = 'flex';
};

// Close the modal
const closeModal = () => {
    modal.style.display = 'none';
};

let formGroups = document.querySelectorAll('.uploadSongForm .form-group');
formGroups.forEach(formGroup => {
    let input = formGroup.querySelector('input');

    if(input){
        input.addEventListener('pointerover', () => {

            console.log("dataset test: ", input.dataset.id);

            if(input.dataset.id < 3 && input.dataset.id != undefined && input.dataset.id != null) {
                input.style.background = "linear-gradient(#cbcbcb, #cbcbcb) padding-box, linear-gradient(135deg, #8A2387 20%, #E94057 78%,#F27121 97%) border-box";
            }

        });

        input.addEventListener('pointerleave', () => {

            console.log("dataset test: ", input.dataset.id);

            if(input.dataset.id < 3 && input.dataset.id != undefined && input.dataset.id != null)
                // input.style.background = "linear-gradient(#cbcbcb, #cbcbcb) padding-box, linear-gradient(313deg, #8A2387, #E94057, #F27121) border-box"; 
                input.style.background = "#cbcbcb";
                input.style.borderWidth = "3px";
        });
    } 
});

// const openEditPlaylistForm = () => {
//     let modal = document.getElementById('myModal');
//     let uploadSongForm = document.querySelector('.uploadSongForm');
//     let editPlaylistForm = document.querySelector('.editPlaylistForm');

//     console.log("uploadSongForm: ", uploadSongForm);
//     console.log("editPlaylistForm: ", editPlaylistForm);

//     uploadSongForm.style.display = "none";
//     editPlaylistForm.style.display = "flex"

//     let optionsMenu = modal.querySelector('.options');
//     console.log(optionsMenu);
// };