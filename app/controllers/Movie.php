<?php
require_once(__DIR__ . '/../core/Database.php');
require_once(__DIR__ . '/../models/Api.php'); // ✅ Fix for "Api class not found"

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
            $movieTitle = trim($_POST['title']);
            $rating = intval($_POST['rating']);

            // ✅ Get the user ID from the session
            $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

            // ✅ Save to database
            $db = db_connect();
            $stmt = $db->prepare("INSERT INTO ratings (user_id, movie_title, rating, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user_id, $movieTitle, $rating]);

            // ✅ Optional: generate AI review
            $api = new Api();  // This is the line that needs require_once
            $review = $api->getGeminiReview($movieTitle, $rating);

            // ✅ Redirect to review page
            header('Location: /index.php?url=Movie/review/' . urlencode($movieTitle) . '/' . $rating);
            exit;
        }
    }

}
