<?php



/**
 * Classe com as operaçoes matematica necessarias.
 * Similaridade de coseno, Distancia Euclidiana, Produto escalar, Matriz de decisao,
 * Maior valor (cosine e euclidean), tambem executa os fatiamento (slice) dos vetores.
 * 
 * @author lesimoes
 */


 class mathEngine {
    
    
     //Produto Escalar 
      static private function dotProduct ($vectorA, $vectorB){
            $dot_product = array_sum(array_map('bcmul', $vectorA, $vectorB));     
            return $dot_product;
        }
        
        
      static private function cosineSlice($vector){
          $arrayItem = array();
          $arrayItem = array_slice($vector, 1, 74);

        return $arrayItem;

      }
      
      
      static private function userConsineSlice($vector){
          $arrayItem = array();
          $arrayItem = array_slice($vector, 0, 74);

          return $arrayItem;
      }


      static  private function euclideanSlice($vector){
          $arrayItem = array();
          $arrayItem = array_slice($vector, 76, 2);

          return $arrayItem;
      }

        static private function userEuclideanSlice($vector){
          $arrayItem = array();
          $arrayItem = array_slice($vector, 75, 2);
          
          return $arrayItem;
      }
      
      
      static function euclidean($itens, $user){
          
          $userSimiliarity = array();
          $itensSimilarity = mathEngine::euclideanSlice($itens);
          $userSimiliarity = mathEngine::userEuclideanSlice($user);

          $sum = pow($userSimiliarity[0] - $itens[76], 2) + pow($userSimiliarity[1] - $itens[77], 2);
          $euclidean = sqrt($sum);
          

          return $euclidean;
      }

      
      static function cosine($itens, $user){

          $itensSimilarity = mathEngine::cosineSlice($itens);
          $userSimilarity = mathEngine::userConsineSlice($user);
          
          $dot_Product = mathEngine::dotProduct($userSimilarity, $itensSimilarity);
          $dot_Product2 = sqrt(mathEngine::dotProduct($userSimilarity, $userSimilarity)) * sqrt(mathEngine::dotProduct($itensSimilarity, $itensSimilarity));
          $cosine = round($dot_Product/$dot_Product2, 2);
          
          return $cosine;   
      }


        
        //Pega os maiores valores de Cosine e Euclidean para a normalizaçao
        static function maxValueInArray($array, $keyToSearch){
            
            $currentMax = NULL;
            foreach($array as $arr)
            {
                foreach($arr as $key => $value)
                {
                    if ($key == $keyToSearch && ($value >= $currentMax))
                    {
                        $currentMax = $value;
                    }
                }
            }

            return $currentMax;
        }
        
        
        //Normaliza os valores de Cosine e Euclidean      
        static function weightValueInArray(&$array, $keyToSearch, $maxValue, $weightValue){

            foreach($array as &$arr)
            {
                
                foreach($arr as $key => $value)
                {
                    
                    if ($key == $keyToSearch && ($key != ''))
                    {
                 
                        if($key == "cosine" )
                            $arr[$key]  = ($value/$maxValue) * $weightValue;
                        if($key == "euclidean")
                            $arr[$key] = abs($value - $maxValue)/$maxValue;
                    }
           
                }
            }


            }
            
                                   
        //Gera uma matriz de decisao para ponderar os valores
        static function decisionMatrix(&$itens){

                           
            $maxCosine = mathEngine::maxValueInArray($itens, 'cosine');
            $maxEuclidean = mathEngine::maxValueInArray($itens, 'euclidean');
            
            mathEngine::weightValueInArray($itens, 'cosine', $maxCosine, 3);
            mathEngine::weightValueInArray($itens, 'euclidean', $maxEuclidean, 1);
            
            mathEngine::sumValues($itens);
                        
        }
      
        //Soma os valores ponderados
        static private function sumValues(&$itens){
            
            for($i = 0 ; $i < (count($itens)); $i++){
            $itens[$i]['decisionMatrix'] = $itens[$i]['cosine'] + $itens[$i]['euclidean'];
        }
       
            
        }

    
}
