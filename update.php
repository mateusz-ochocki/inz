<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $numer_rejestracyjny = $_POST['numer_rejestracyjny'];

    $sql = "UPDATE lista_samochodow SET marka='$marka', model='$model', numer_rejestracyjny='$numer_rejestracyjny' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Przekieruj na stronę główną po aktualizacji
        exit;
    } else {
        echo "Błąd podczas aktualizacji rekordu: " . $conn->error;
    }
}

$conn->close();
?>
