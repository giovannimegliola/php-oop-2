<?php
include __DIR__ ."/Product.php";
class Book extends Product 
{
  private int $_id;
  private string $title;
  private string $longDescription;
  private int $pageCount;
  private string $thumbnailUrl;


  function __construct($id, $title, $description, $pages, $image)
  {
    $this->_id = $id;
    $this->title = $title;
    $this->longDescription = $description;
    $this->pageCount = $pages;
    $this->thumbnailUrl = $image;
  }

  public function printCard()
  {
    $image = $this -> thumbnailUrl;
    $title = $this -> title;
    $content = substr($this->longDescription, 0 , 100) . '...';
    $custom =  $this->pageCount . ' pag' ;
    $genre = substr($this->title, 0 , 10) ;
    include __DIR__ ."/../Views/card.php";
  }

  public static function fetchAll()
  {
    $bookString = file_get_contents(__DIR__ . "/books_db.json");
    $bookList = json_decode($bookString,true);

    $books=[];
    foreach($bookList as $item){

      $books[] = new Book($item['_id'],$item['title'],$item['longDescription'],$item['pageCount'],$item['thumbnailUrl'] ); 
    }
    
    return $books;
   
  }
  
}

?>
