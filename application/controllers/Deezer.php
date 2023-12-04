<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Deezer extends CI_Controller{
        public function getRadioStations(){
            // $url = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://deezerdevs-deezer.p.rapidapi.com/radio/genres",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
                $this->session->set_userdata('Station', $data);
                redirect('http://localhost:8888/Station/');
            }
        }


    }
?>