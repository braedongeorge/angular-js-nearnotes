<?php
if (isset($_GET['longitude']) && isset($_GET['latitude']) && isset($_GET['input'])) {
  $longitude = $_GET['longitude'];
  $latitude = $_GET['latitude'];
  $input = urlencode($_GET['input']);
  }

function ProcessCurl($URL){ 
                    $ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $URL);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                  
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             
                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        print curl_error($ch);
                    } else {
                        curl_close($ch);
                    }
                    return $result;
                }

 $key = "AIzaSyDu8TsJIM1Ui3uNaWxh-OMkOgivYW2nsB4";
 $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?key=" . $key . "&location=" . $latitude . "," . $longitude . "&radius=1000&rankBy=distance&input=" . $input;
// echo $url;
// echo "test";
 $results = ProcessCurl($url);

                
				
header('Content-type: application/json');
echo $results;


?>