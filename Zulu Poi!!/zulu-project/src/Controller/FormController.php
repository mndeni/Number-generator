<?php

namespace App\Controller;

use App\Services\ApiService;
use Twig\Environment;

class FormController
{
    private $twig;
    private $apiService;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->apiService = new ApiService();
    }

    public function showForm($error = null, $results = [])
    {
        echo $this->twig->render('form.twig', [
            'error' => $error,
            'results' => $results,
        ]);
    }

    public function handleSubmit($data)
    {
        $input = $data['inputField'];
        $dropdown = $data['dropdown'];

        // Validation (example)
        if (empty($input)) {
            $this->showForm('Input field cannot be empty.');
            return;
        }

        // Call the microservice
        $results = $this->apiService->getResults($input, $dropdown);

        $this->showForm(null, $results);
    }
}
