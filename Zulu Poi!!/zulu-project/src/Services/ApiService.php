<?php

namespace App\Services;

class ApiService
{

    public function getResults($input, $dropdown)
    {
        // Example API call
        $apiUrl = 'http://127.0.0.1:9001/random-number';

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        // If you need to pass input and dropdown as query parameters:
        // $queryData = http_build_query([
        //     'input' => $input,
        //     'dropdown' => $dropdown
        // ]);
        // curl_setopt($ch, CURLOPT_URL, $apiUrl . '?' . $queryData);

        // Execute the request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            var_dump($error);
            return $error;
        }

        // Close cURL session
        curl_close($ch);

        // Output the response for debugging
        var_dump($response);

        // Return the decoded JSON response as an associative array
        return json_decode($response, true);
    }

}
