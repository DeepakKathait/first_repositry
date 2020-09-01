<form action="" method="get">
  <input type="text" name="data" />
  <br>
  <input type="submit" name="search" value="Search" />
</form>

<?php
    if(isset($_GET['search'])){
        $api_url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&titles=".ucwords($_GET['data'])."&redirects=true";
        $api_url = str_replace(' ','%20',$api_url);
        if($data=json_decode(file_get_contents($api_url))){
             foreach($data->query->pages as $key=>$val){
                 $pageId = $key;
                 break;
             }
             $content = $data->query->pages->$pageId->extract;
             header('Content-Type:text/html; charset=utf-8');
             echo $content;
        }
        else{
            echo 'Data not found';
        }
    }
?>
