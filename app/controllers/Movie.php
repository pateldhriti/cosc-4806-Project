<?php

class Movie extends Controller {
    public function index() {
      $this->view('movie/index');
      
    }

   public function search() {
     if (!isset($_REQUEST['movie'])) || empty($_REQUEST['movie']) {
       header("Location: /movie");
       exit;
       
     }


  $api = $this->model('Api');
  $movie_title = $_REQUEST['movie'];
  $movie = $api->search_movie($movie_title);

  echo "<pre>";
  print_r($movie);
  die;


$this->view('movie/show', [
    'movie' => $movie,
    'title' => $movie_title
]);

  
   }

public function review($title = null, $rating = null) {
  if (!$title || !$rating || $rating < 1 || $rating > 5) {
      die("Invalid review request.");
  }

  $api = $this->model('Api');
  $review = $api->getGeminiReview($title, $rating);
  $movie = $api->search_movie($title);

  $THIS->VIEW('movie/show', [
    'movie' => $movie,
    'title' => $title,
    'rating' => $rating  
    'review' => $review
  ]')
}
}