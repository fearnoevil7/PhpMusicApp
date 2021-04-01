<h4><u>Pending Friend Requests</u></h4>
        <?php
        // method = POST><input type = hidden name=boolean value=TRUE /><input type = Submit value = Accept /></form><form class=friendrequestbutton action = confirmRequest/
            foreach($loggedUser['pendingrequests'] as $friendRequest){
                // var_dump($friendRequest['Sender']);
                // var_dump($friendRequest['Receiver']);
                if($friendRequest['Sender']['UserId'] == $this->session->userdata('UserId')){
                    echo "<img class=userprofilepic src = " . $friendRequest['Receiver']['ProfilePicUrl'] .  "  />";
                    echo "<div class = waffles3><a class = waffles2   href = /user/show/" . $friendRequest['Receiver']['UserId'] . "><u>" . $friendRequest['Receiver']['FirstName'] . " " . $friendRequest['Receiver']['LastName'] . "</u></a><form class=friendrequestbutton  action = declineRequest/" . $this->session->userdata('UserId') . "/" .  $friendRequest['Receiver']['UserId'] . " method = POST><input type = hidden name=boolean value=TRUE /><input type = Submit value = 'Cancel Request' /></form></div>";
                }
                if($friendRequest['Receiver']['UserId'] == $this->session->userdata('UserId')){
                    echo "<img class=userprofilepic src = " . $friendRequest['Sender']['ProfilePicUrl'] .  "  />";
                    echo "<div class = waffles3><a class = waffles2 href = /user/show/" . $friendRequest['Sender']['UserId'] . "><u>" . $friendRequest['Sender']['FirstName'] . " " . $friendRequest['Sender']['LastName'] . "</u></a><form class=friendrequestbutton  action = confirmRequest/" . $this->session->userdata('UserId') . "/" .  $friendRequest['Sender']['UserId'] . " method = POST><input type = hidden name=boolean value=TRUE /><input type = Submit value = Accept /></form><form class=friendrequestbutton  action = declineRequest/" . $this->session->userdata('UserId') . "/" .  $friendRequest['Sender']['UserId'] . " method = POST><input type = hidden name=boolean value=FALSE /><input type = Submit value = Decline /></form></div>";
                }
            }
        ?>