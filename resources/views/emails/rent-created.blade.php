<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de location</title>
</head>
<body>
    <h1>Confirmation de votre location</h1>
    
    <p>Bonjour {{ $rent->user->name }},</p>
    
    <p>Votre location a été confirmée avec les détails suivants :</p>
    
    <ul>
        <li><strong>Vélo :</strong> {{ $rent->bike->brand }} {{ $rent->bike->model }}</li>
        <li><strong>Année :</strong> {{ $rent->bike->year }}</li>
        <li><strong>Date de début :</strong> {{ $rent->rent_start }}</li>
        <li><strong>Date de fin :</strong> {{ $rent->rent_end }}</li>
        <li><strong>Prix total :</strong> {{ $rent->total_price }} €</li>
    </ul>
    
    <p>Merci de votre confiance !</p>
</body>
</html>