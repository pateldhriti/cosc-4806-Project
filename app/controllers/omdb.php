<?php

class Omdb extends Controller {
    public function index() {
        // Make sure the key is retrieved safely
        $apiKey = getenv('OMDB'); // Or use $_ENV['OMDB'] if you're sure it's loaded

        $query_url = "http://www.omdbapi.com/?apikey=" . urlencode($apiKey) . "&t=" . urlencode("the matrix") . "&y=1999";

        // Get API response
        $json = file_get_contents($query_url);
        if (!$json) {
            die("Failed to fetch data from OMDB.");
        }

        // Decode JSON to PHP array
        $phpObj = json_decode($json, true);

        // Output the data
        echo "<pre>";
        print_r($phpObj);
        echo "</pre>";
        exit;
    }
}
