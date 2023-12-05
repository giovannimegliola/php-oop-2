<?php
include __DIR__ ."/Genre.php";
include __DIR__ ."/Product.php";

class Movie extends Product
{
  public int $id;
  public string $title;
  public string $overview;
  public float $vote_average;
  public string $poster_path;
  public string $original_language;

  //public Genre $genre;

  //bonus array $genres;

  function __construct($id,$title,$overview,$vote,$language,$image) //Genre $genre
  {
    //parent::__construct($price,$quantity);
    $this->id = $id;
    $this->title = $title;
    $this->overview = $overview;
    $this->vote_average = $vote;
    $this->poster_path = $image;
    $this->original_language = $language;
    //$this->genre = $genre;    
  }

  public function getVote(){
    $vote = ceil($this->vote_average / 2);
    $template = "<p>";
    for ($n = 1; $n <= 5; $n++){
      $template .= $n <= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
    }
    $template .= "<p>";
    return $template;
  }

  public function printCard()
  {
    $image = $this -> poster_path;
    $title = $this -> title;
    $content = substr($this->overview, 0 , 100) . '...';
    $custom = $this -> getVote();
    //$genre = $this->genre->name;
    include __DIR__ ."/../Views/card.php";
  }
}


$movieString = file_get_contents(__DIR__ . "/movie_db.json");

$movieList = json_decode($movieString,true);

$movies=[];


foreach($movieList as $item){
  //$randgenre = $genres [rand(0, count($genres) -1)];
  
  $movies[] = new Movie($item['id'],$item['title'],$item['overview'],$item['vote_average'],$item['original_language'],$item['poster_path']); //$randgenre
}

//var_dump($movies);


?>


