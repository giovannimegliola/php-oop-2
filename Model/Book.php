<?php
include __DIR__ ."/Product.php";
class Book extends Product 
{
  private int $_id;
  private string $title;
  private string $longDescription;
  private int $pageCount;
  private string $thumbnailUrl;
  private string $genre;


  function __construct($id, $title, $description, $pages, $image,$genre)
  {
    $this->_id = $id;
    $this->title = $title;
    $this->longDescription = $description;
    $this->pageCount = $pages;
    $this->thumbnailUrl = $image;
    $this->genre = $genre;
  }

  public function printCard()
  {
    $image = $this -> thumbnailUrl;
    $title = $this -> title;
    $content = substr($this->longDescription, 0 , 100) . '...';
    $custom =  $this->pageCount . ' pag' ;
    $genre = $this -> genre;
    include __DIR__ ."/../Views/card.php";
  }

  public static function fetchAll()
  {
    $bookString = file_get_contents(__DIR__ . "/books_db.json");
    $bookList = json_decode($bookString,true);

    $books=[];
    foreach($bookList as $item){

      $books[] = new Book($item['_id'],$item['title'],$item['longDescription'],$item['pageCount'],$item['thumbnailUrl'], $item['genre'] ); 
    }
    
    return $books;
   
  }
  
}

?>
