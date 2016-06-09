<?php


/**
 * Essa classe serve apenas para abrir o dataset (arquivo texto)
 * Nao sera usada no mknob
 * @author lesimoes
 */
class fileManager {
    
    //Caminho do dataset
    public static $targetFile = "/home/leandro/Documentos/Mestrado/Projeto Flame/mknob/theo2.txt";
    private static $arrayItem = array();

    
    function showFile(){
        print($this->$targetFile);
    }
    
     function printFile(){
           echo '<pre>';
           print_r(fileManager::$arrayItem);
            echo '</pre>';
        }
        
      function  getItem($row){
            return fileManager::$arrayItem[$row];
        }
                
        function getItens(){
            return fileManager::$arrayItem;
        }
                
      function printItem($row){
          echo '<pre>';
           print_r(fileManager::$arrayItem[$row]);
            echo '</pre>';
      }
                
    function openData(){
            
            $pont= fopen(fileManager::$targetFile,"r");
            $FileContents = fread ( $pont , filesize(fileManager::$targetFile)); 
            fclose($pont);
            $delimitador = "\t";

            $myArray = explode($delimitador, $FileContents);
            
           
            for($i = 0 ; $i < count($myArray); $i++){
                $cont = count($myArray) - 1;
                 if( ($i % 79 == 0) && ( $i != $cont ) ){
                    $item = array_slice($myArray, $i, 78);
                    array_push(fileManager::$arrayItem, $item);
                }
                
            }
            
        }
    
}
