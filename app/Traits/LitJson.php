<?php
namespace App\Traits;

/**
 * Possède une seule méthode qui renvoie un array à partir d'un fichier json
 *
 * @package Menus
 */
trait LitJson {

    /**
     * TRAIT: Méthode qui lit un fichier json et renvoie un array.
     *
     *
     * @param  string $json nom du fichier json présent dans _storage/json/_ sans l'extension
     * @return array       tableau issu du json
     */
    public function litJson($json): Mixed
    {
      $context = stream_context_create(
          array(
              "http" => array(
                  "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
              )
          )
      );

      if(file_exists('storage/json/'.$json.'.json')) {

        return $datas = json_decode(file_get_contents('storage/json/'.$json.'.json'));
      }

    }

}
