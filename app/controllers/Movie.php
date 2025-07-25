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

    public function saveRating()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $rating = (int)($_POST['rating'] ?? 0);

            if ($rating < 1 || $rating > 5 || empty($title)) {
                die("Invalid rating or movie title.");
            }

            $user_id = $_SESSION['user_id'] ?? 0;

            $db = db_connect();
            $stmt = $db->prepare("INSERT INTO ratings (user_id, movie_title, rating) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $title, $rating]);

            header("Location: /Movie/review/" . urlencode($title) . "/" . $rating);
            exit;
        }
    }
}
