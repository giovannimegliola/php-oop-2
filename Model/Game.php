<?php 
include __DIR__ ."/Product.php";

class Game extends Product
{
  private int $appid;
  private string $name;
  private string $longDescription;
  private string $img_icon_url;
  protected float $price;
  private string $genre;


  function __construct($id, $name, $description, $price, $img, $genre)
  {
    $this -> appid = $id;
    $this -> name = $name;
    $this -> longDescription = $description;
    $this -> img_icon_url = $img;
    $this -> price = $price;
    $this -> genre = $genre;

  }

  public function printCard()
  {
    $image = $this -> img_icon_url;
    $title = $this -> name;
    $content = substr($this->longDescription, 0 , 100) . '...';
    $custom =  $this->price . ' $' ;
    $genre = $this -> genre;
    include __DIR__ ."/../Views/card.php";
  }

  public static function fetchAll()
  {
    $gameString = file_get_contents(__DIR__ . "/steam_db.json");
    $gameList = json_decode($gameString,true);

    $games=[];
    foreach($gameList as $item){

      $games[] = new Game($item['appid'],$item['name'],$item['longDescription'],$item['price'],$item['img_icon_url'], $item['genre'] ); 
    }
    
    return $games;
   
  }

}

?>