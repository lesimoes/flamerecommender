<!DOCTYPE html>
<!--
Aqui e onde a magia acontece... 
Calcula a similaridade das atraçoes considerando apenas distancia euclidiana.
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

        
        //Ordena lista por Euclidean Distance
        function invenDescSort($item1,$item2)
        {
            if ($item1['decisionMatrix'] == $item2['decisionMatrix']) return 0;
            return ($item1['decisionMatrix'] < $item2['decisionMatrix']) ? 1 : -1;
        }
       
        //Abre o dataset
        $file = new fileManager();
        $file->openData();
        $array = $file->getItens();
        
        //Cria o perfil do usuario por GET
        $userProfile = new user($user);

        //Criar a chave "euclidean" no array de itens
        for($i = 0 ; $i < (count($array)); $i++){
            $array[$i]['euclidean'] = mathEngine::euclidean($array[$i], $userProfile->getProfile());
        }
 
        
        //Ordena o array de itens
        usort($array,'invenDescSort');
        
       //Mostra resultados
        for($i = 0 ; $i < (count($array) ); $i++){
            echo($array[$i][0]." - Euclidean: ".$array[$i]['euclidean']."<br>");
        }
        
        

        ?>


    </body>
</html>
