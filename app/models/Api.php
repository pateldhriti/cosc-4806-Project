<?php

class Api {
  private $omdb_key;
  private $gemini_key;

  public function __construct() {
    $this->omdb_key = $_ENV['omdb_key'];
    $this->gemini_key = $_ENV['gemini_key'];
  }

  public function search_movie($title) {
    $key = $_ENV['omdb_key'];
    $url = "http://www.omdbapi.com/?apikey=$KEY&T=" . urlencode($title);
    $json= file_get_contents($url);
    return json_decode($json, true);
  }

  public function getGeminiReview($title, $rating) {

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $this->gemini_key;
    $prompt ="Give a review for the movie " . $title . " with a rating of " . $rating . " out of 5.";

    $postData = json_encode([
        "contents" => [
            [
                "role" => "user",
                "parts" => [
                    ["text" => $prompt]
                ]
            ]
        ]
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    return $json['candidates'][0]['content']['parts'][0]['text'] ?? "No review available.";
  }
}