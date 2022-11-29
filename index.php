<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" media="all">
    </head>
    <body>
    <div class="title">
    <h2>Brinkenridge Web Developer test</h2>
    </div>	
    <?php
    /***
    PHP curl call unsplash api
    **/
    $curl = curl_init();
    $client_id = 'smnGpQlrp9sC17-OtWZrOW4ZTDrty8gzWt5zE6rRlfs';
    $query = 'cats';
    $url = "https://api.unsplash.com/search/photos?query='.$query.'&per_page=12&page=1&client_id=".$client_id;
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    
    /***
    Get api response json 
    **/
    if( $response ){
        $response = json_decode($response,true);
        if( isset($response['errors']) ){
            /***
            API response errors
            **/
            foreach( $response['errors'] as $err ){
                echo '<div style="color:red;">'.$err.'</div>';
            }
        }else{
            /***
            API response images array
            **/
            echo '<div class="unsplash-gallery">';
            foreach( $response['results'] as $image ){
                echo '<a class="unsplash-gallery-item" href="'.$image['links']['html'].'" target="_blank">';
                    echo '<img src="'.$image['urls']['regular'].'">';
                    echo '<span class="icon-img"></span><span class="unsplash-credit">Credit: '.$image['user']['name'].'</span>';
                echo '</a>';
            }
            echo '</div>';
        }
    }
     ?>
</body>
</html>