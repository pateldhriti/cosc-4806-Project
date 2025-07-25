<?php

class Api
{
    // Search movie from OMDB API
    public function search_movie($title)
    {
        $api_key = getenv('OMDB'); // Secret key from Replit

        // Clean title (e.g., "KoiMilGaya" → "Koi Mil Gaya")
        $cleanTitle = preg_replace('/(?<!\ )[A-Z]/', ' $0', $title);
        $cleanTitle = trim(ucwords(strtolower($cleanTitle)));

        $url = "http://www.omdbapi.com/?apikey=" . urlencode($api_key) . "&t=" . urlencode($cleanTitle);

        $response = file_get_contents($url);

        // ✅ Log the raw OMDB API response for debugging
        file_put_contents('omdb_debug.log', $response);

        if (!$response) return false;

        $data = json_decode($response, true);
        if (isset($data['Response']) && $data['Response'] === 'False') return false;

        return $data;
    }

    // Generate AI review using Gemini API
    public function getGeminiReview($title, $rating)
    {
        $api_key = getenv('GEMINI');
        $prompt = "Write a short, friendly and informative review of the movie '$title' rated $rating out of 5 stars.";

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
        file_put_contents('gemini_debug.log', $response); // log response

        if (curl_errno($ch)) {
            return "AI Error: " . curl_error($ch);
        }

        curl_close($ch);

        $data = json_decode($response, true);
        return $data['candidates'][0]['content']['parts'][0]['text'] ?? "No AI review available.";
    }

}
