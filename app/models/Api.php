<?php

class Api {
  private $omdb_key;
  private $gemini_key;

  public function __construct() {
    $this->omdb_key = $_ENV['omdb_key'];
    $this->gemini_key = $_ENV['gemini_key'];
  }

  public function search_movie($title) {
    $url = "http://www.omdbapi.com/?apikey=" . $this->omdb_key . "&t=" . urlencode($title);
    $response = file_get_contents($url);
    return json_decode($response, true);
  }

  public function getGeminiReview($title, $rating) {
    $prompt ="Give a review for the movie " . $title . " with a rating of " . $rating . " out of 5.";

    $data = [
        'contents' => [
            [ 'parts' => [['text' => $prompt]]]
        ]
     ];

    $opts = [
      'http' =>  [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/json\r\n".
                      "Authorization: Bearer ' . $this->gemini_key ,
        'content' => json_encode($data)
    ]
      ];

    $context  = stream_context_create($opts);
    $URL = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $this->gemini_key;
    $result = file_get_contents($URL, false, $context);
    $json = json_decode($result, true);

    return $json['candidates'][0]['content']['parts'][0]['text'] ?? "No review available.";
  }
}