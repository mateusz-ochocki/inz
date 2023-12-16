<?php
include 'db_connect.php';

// Obsługa dodawania nowego samochodu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $priorytet = $_POST['priorytet'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $numer_rejestracyjny = $_POST['numer_rejestracyjny'];

    $sqlInsert = "INSERT INTO lista_samochodow (priorytet, marka, model, numer_rejestracyjny) VALUES ('$priorytet', '$marka', '$model', '$numer_rejestracyjny')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Dodano nowy samochód!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Błąd podczas dodawania nowego samochodu: ' . $conn->error . '</div>';
    }
}

// Obsługa usuwania samochodu
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $idToDelete = $_GET['id'];
    $sqlDelete = "DELETE FROM lista_samochodow WHERE id = $idToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        header("Location: index.php"); // Przekieruj z powrotem na stronę główną po usunięciu
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Błąd podczas usuwania samochodu: ' . $conn->error . '</div>';
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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Nawigacja -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
            <br><h2>Lista Samochodów</h2>
            
            <!-- Formularz dodawania nowego samochodu -->
            <form action="index.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="priorytet">Priorytet</label>
                        <input type="number" class="form-control" id="priorytet" name="priorytet" min="1" max="100" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="marka">Marka</label>
                        <input type="text" class="form-control" id="marka" name="marka" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="numer_rejestracyjny">Numer Rejestracyjny</label>
                        <input type="text" class="form-control" id="numer_rejestracyjny" name="numer_rejestracyjny" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Dodaj Samochód</button>
            </form>
            
            <!-- Tabelka z oczekującymi samochodami -->
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Priorytet</th>
                    <th scope="col">Marka</th>
                    <th scope="col">Model</th>
                    <th scope="col">Numer rejestracyjny</th>
                    <th scope="col">Akcje</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM lista_samochodow ORDER BY priorytet DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['priorytet'] . "</td>";
                        echo "<td>" . $row['marka'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['numer_rejestracyjny'] . "</td>";
                        echo "<td><a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edytuj</a> ";
                        echo "<a href='index.php?action=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Usuń</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Brak danych</td></tr>";
                }
                ?>
                </tbody>
            </table>
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

<!-- Skrypt JavaScript do przyklejania paska nawigacyjnego -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="jscript.js"></script>

</body>
</html>

<?php
$conn->close();
?>
