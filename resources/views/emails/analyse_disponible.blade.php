<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Résultat d'analyse</title>
</head>
<body>
    <p>Bonjour,</p>

    <p>Votre résultat d’analyse est désormais disponible.</p>

    <p><strong>ID unique :</strong> {{ $analyse->access_id }}</p>

    <p>Vous pouvez le télécharger ici : 
        <a href="{{ url('/resultat?access_id=' . $analyse->access_id) }}">Télécharger votre PDF</a>
    </p>

    <p>Merci de votre confiance.</p>
</body>
</html>
