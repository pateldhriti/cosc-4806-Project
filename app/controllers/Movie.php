<?php
require_once(__DIR__ . '/../core/Database.php');

class Movie extends Controller {

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

        $db = db_connect();
        $stmt = $db->prepare("SELECT ROUND(AVG(rating), 1) as avg_rating FROM ratings WHERE movie_title = ?");
        $stmt->execute([$movie_title]);
        $avgRating = $stmt->fetchColumn(); // ✅ Semicolon added

        $this->view('movie/show', [
            'movie' => $movie,
            'title' => $movie_title,
            'avg_rating' =>  $avgRating
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

        $db = db_connect();
        $stmt = $db->prepare("SELECT ROUND(AVG(rating), 1) as avg_rating FROM ratings WHERE movie_title = ?");
        $stmt->execute([$title]);
        $avgRating = $stmt->fetchColumn();

        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
        unset($_SESSION['flash']);

        $this->view('movie/show', [
            'movie' => $movie,
            'title' => $title,
            'rating' => $rating,
            'review' => $review,
            'flash' => $flash,
          'avg_rating' => $avgRating
        ]);
    }

    public function saveRating()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieTitle = ucwords(strtolower(trim($_POST['title'])));
            $rating = intval($_POST['rating']);

            // ✅ Get the user ID from the session (or guest)
            $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

            // ✅ Save to database
            $db = db_connect();
            $stmt = $db->prepare("INSERT INTO ratings (user_id, movie_title, rating, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user_id, $movieTitle, $rating]);

            // ✅ Optional: generate AI review
            require_once(__DIR__ . '/../models/Api.php');
            $api = new Api();
            $review = $api->getGeminiReview($movieTitle, $rating);

            // ✅ Add flash message
            $_SESSION['flash'] = "🎉 Thanks for rating $movieTitle!";

            // ✅ Redirect to review page
            header('Location: /index.php?url=Movie/review/' . urlencode($movieTitle) . '/' . $rating);
            exit;
        }
    }

}
