<!DOCTYPE html>
<!--
Aqui e onde a magia acontece... 
Calcula a similaridade das atraçoes considerando cosine e distancia euclidiana.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        

        
 <?php
        
        include 'fileManager.php';
        include 'user.php';
        include 'mathEngine.php';
        
        
        $ranking = array();
        $user = array();
    
        
        
        
        if($_GET['user_data']){
            $user = $_GET['user_data'];
            $user = explode(",",$user); 
        }

        
        //Ordena lista por Cosine
        function invenDescSort($item1,$item2)
        {
            if ($item1['decisionMatrix'] == $item2['decisionMatrix']) return 0;
            return ($item1['decisionMatrix'] < $item2['decisionMatrix']) ? 1 : -1;
        }
       
        
        $file = new fileManager();
        $file->openData();
        
        $array = $file->getItens();
        $userProfile = new user($user);

            
        for($i = 0 ; $i < (count($array)); $i++){
            $array[$i]['cosine'] = mathEngine::cosine($array[$i], $userProfile->getProfile());
            
        }
        for($i = 0 ; $i < (count($array)); $i++){
            $array[$i]['euclidean'] = mathEngine::euclidean($array[$i], $userProfile->getProfile());
        }
 
        mathEngine::decisionMatrix($array);
        
        usort($array,'invenDescSort');
        
       
        for($i = 0 ; $i < (count($array) ); $i++){
            echo($array[$i][0]." - Cosine: ".$array[$i]['cosine']." - Euclidean: ".$array[$i]['euclidean']." Decison Matrix: ".$array[$i]['decisionMatrix']."<br>");
        }
        
        

        ?>


    </body>
</html>
