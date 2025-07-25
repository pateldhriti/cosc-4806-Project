


<?php

class Movie extends Controller
{
    public function index()
    {
        $this->view('movie/index');
    }

    public function search()
    {

        if (!isset($_GET['movie']) || empty(trim($_GET['movie']))) {
            header("Location: /Movie");
            exit;
        }

        $api = $this->model('Api');
        $movie_title = htmlspecialchars(trim($_GET['movie']));
        $movie = $api->search_movie($movie_title);


        if (!$movie || $movie['Response'] === 'False') {
            die("Movie not found.");
        }

        $this->view('movie/show', [
            'movie' => $movie,
            'title' => $movie_title
        ]);
    }

    public function review($title = null, $rating = null)
    {
        if (!$title || !$rating || $rating < 1 || $rating > 5) {
            header("Location: /Movie");
            exit;
        }

        $api = $this->model('Api');
        $movie = $api->search_movie($title);
        $review = $api->getGeminiReview($title, $rating);

        $this->view('movie/show', [
            'movie' => $movie,
            'title' => $title,
            'rating' => $rating,
            'review' => $review
        ]);
    }
}
