<?php

class Api
{
    public function search_movie($title)
    {
        

        $api_key = getenv('OMDB'); // Secret key from Replit
        $url = "http://www.omdbapi.com/?apikey=" . urlencode($api_key) . "&t=" . urlencode($title);

        $response = file_get_contents($url);
        if (!$response) {
            return false;
        }

        $data = json_decode($response, true);
        return $data;
    }

    // Generate AI review using Gemini API
    public function getGeminiReview($title, $rating)
    {
        $api_key = getenv('GEMINI'); // Secret key from Replit
        $prompt = "Write a short and friendly review of the movie '$title' which is rated $rating out of 5 stars.";

        $postData = [
            "contents" => [[
                "parts" => [[ "text" => $prompt ]]
            ]]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$api_key");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            return "AI Error: " . curl_error($ch);
        }

        curl_close($ch);

        $data = json_decode($response, true);
        return $data['candidates'][0]['content']['parts'][0]['text'] ?? "No AI review available.";
    }
}
