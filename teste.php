<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>idade</th>
            <th>registro</th>
        </tr>

        <?php foreach($lista as $item): ?>
            <tr>
            <td><?= $item['id_pessoa']?></td>
            <td><?= $item['nome']?></td>
            <td><?= $item['idade']?></td>
            <td><?= $item['data_registro']?></td>

        </tr>
        <?php endforeach ?>

        
    </table>
</body>

</html>