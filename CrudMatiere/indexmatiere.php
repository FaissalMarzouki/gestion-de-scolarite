<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>La liste des matières</h2>
        <a class="btn btn-primary btn-sm" href="/PHPPROJECT/create.php" role="button">Ajouter une nouvelle matière</a>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Identifiant de la matière</th>
                <th>Nom de la matière</th>
                <th>Description de la matière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            

            try {
                $connection = new PDO("mysql:host=localhost;dbname=gestion de scolarite", 'fayssal', '1447');
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM Matiere";
                $stmt = $connection->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$row['ID_MATIERE']}</td>
                        <td>{$row['NOM_MATIERE']}</td>
                        <td>{$row['CREDITS']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/PHPPROJECT/edit.php?ID_MATIERE={$row['ID_MATIERE']}'>Modifier</a>
                            <a class='btn btn-danger btn-sm' href='/PHPPROJECT/delete.php?ID_MATIERE={$row['ID_MATIERE']}'>Supprimer</a>
                        </td>
                    </tr>";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            $connection = null;
            ?>
        </tbody>
    </table>
</body>
</html>
