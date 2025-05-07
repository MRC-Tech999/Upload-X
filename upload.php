<?php
header('Content-Type: application/json');

// Lire les données envoyées depuis JavaScript
$input = json_decode(file_get_contents("php://input"), true);
$image = $input['image'] ?? '';

if (!$image) {
    echo json_encode(['error' => 'Image URL manquante']);
    exit;
}

// Préparer les données à envoyer
$data = http_build_query([
    'image' => $image,
    'name' => 'myimage.jpg'
]);

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://upload-images-hosting-get-url.p.rapidapi.com/upload',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded',
        'x-rapidapi-host: upload-images-hosting-get-url.p.rapidapi.com',
        'x-rapidapi-key: 2413118117msh97c68a8454ed446p157561jsn49d57d5fe542' // Mets ici ta vraie clé (ou une nouvelle)
    ],
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo json_encode(['error' => curl_error($curl)]);
} else {
    echo $response;
}

curl_close($curl);
?>
