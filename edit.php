<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM lista_samochodow WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Brak danych do edycji.";
        exit;
    }
} else {
    echo "Nieprawidłowy identyfikator rekordu.";
    exit;
}

// Obsługa aktualizacji samochodu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $priorytet = $_POST['priorytet'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $numer_rejestracyjny = $_POST['numer_rejestracyjny'];

    $sqlUpdate = "UPDATE lista_samochodow SET priorytet = '$priorytet', marka = '$marka', model = '$model', numer_rejestracyjny = '$numer_rejestracyjny' WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Zaktualizowano dane samochodu!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Błąd podczas aktualizacji samochodu: ' . $conn->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warsztat Samochodowy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="edit-style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="jscript.js"></script>
</head>
<body class="edit-page">

<!-- Nawigacja -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="logo.png" alt="Logo serwisu"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                
            </li>
            <!-- Dodaj więcej opcji nawigacyjnych tutaj -->
        </ul>
    </div>
</nav>

<!-- Główna treść strony -->
<div class="container-fluid">
    <div class="row">
        <!-- Menu boczne -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            Lista Samochodów
                        </a>
                    </li>
                    <!-- Dodaj więcej opcji menu tutaj -->
                </ul>
            </div>
        </nav>

        <!-- Zawartość strony -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <h2>Edytuj Samochód</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="priorytet">Priorytet (1-100):</label>
                    <input type="number" class="form-control" id="priorytet" name="priorytet" min="1" max="100" value="<?php echo $row['priorytet']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="marka">Marka:</label>
                    <input type="text" class="form-control" id="marka" name="marka" value="<?php echo $row['marka']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="model">Model:</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?php echo $row['model']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="numer_rejestracyjny">Numer Rejestracyjny:</label>
                    <input type="text" class="form-control" id="numer_rejestracyjny" name="numer_rejestracyjny" value="<?php echo $row['numer_rejestracyjny']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            </form>
        </main>
    </div>
</div>

<!-- Stopka -->
<footer class="footer">
    <div class="container">
        <span class="text-muted">© 2023 Warsztat Samochodowy</span>
    </div>
</footer>

<!-- Skrypty Bootstrapa i inne skrypty -->

</body>
</html>

<?php
$conn->close();
?>
