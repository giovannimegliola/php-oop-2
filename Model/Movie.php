<?php
include __DIR__ ."/Genre.php";
include __DIR__ ."/Product.php";
include __DIR__ ."/../Traits/DrawCard.php";
class Movie extends Product
{
  // use DrawCard;
  private int $id;
  private string $title;
  private string $overview;
  private float $vote_average;
  private string $poster_path;
  private string $original_language;
  private array $genres;

  function __construct($id,$title,$overview,$vote,$language,$image,$genres)  
  {
    
    $this->id = $id;
    $this->title = $title;
    $this->overview = $overview;
    $this->vote_average = $vote;
    $this->poster_path = $image;
    $this->original_language = $language;
    $this->genres = $genres;    
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

  private function formatGenres()
  {
    $template = "<p>";
    for ($n = 1; $n < count($this->genres); $n++){
      $template .=  $this->genres[$n]->drawGenre();
    }
    $template .= "<p>";
    return $template;
  }

  public function printCard()
  {

    // $error = '';
    // if (ceil($this->vote_average) < 6) {
    //   try {
    //     $this-> setDiscount(20);
    //   } catch (Exception $e) {
    //     $error = 'Eccezione:' .  $e->getMessage();
    //   }
    // }



    $image = $this -> poster_path;
    $title = $this -> title;
    $content = substr($this->overview, 0 , 100) . '...';
    $custom = $this -> getVote();
    $genre = $this->formatGenres();
    include __DIR__ ."/../Views/card.php";

    // $cardItem = [
    //   'image' => $this->poster_path,
    //   'title'=> $this->title,
    //   'content' => substr($this->overview, 0 , 100) . '...',
    //   'genre' => $this -> formatGenres(),
    //   'custom' => $this-> getVote(),
    // ];
    // return $cardItem;
  }

  public static function fetchAll()
  {
    $movieString = file_get_contents(__DIR__ . "/movie_db.json");
    $movieList = json_decode($movieString,true);

    $movies=[];
    $genres = Genre::fetchAll();
    foreach($movieList as $item){
      $moviegenres = [];
      for ($i = 0; $i < count($item['genre_ids']); $i++){
        $index = rand(0, count($genres) -1);
        $rand_genre = $genres[$index];
        $moviegenres[] = $rand_genre;
      }

      $movies[] = new Movie($item['id'],$item['title'],$item['overview'],$item['vote_average'],$item['original_language'],$item['poster_path'],$moviegenres); 
    }
    return $movies;
  }

}
?>


