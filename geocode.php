<?php
if (isset($_GET['reference'])) {
  $reference = $_GET['reference'];

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
 $url = "https://maps.googleapis.com/maps/api/place/details/json?key=" . $key . "&reference=" . $reference;
// echo $url;
// echo "test";
 $results = ProcessCurl($url);

                
				
header('Content-type: application/json');
echo $results;


?>