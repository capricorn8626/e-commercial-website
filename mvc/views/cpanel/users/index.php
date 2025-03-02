

    <table>
        <thead>
            <tr>
                <td>USERNAME</td>
                <td>PASSWORD</td>
                <td>TYPE</td>
                <td>ID_TYPE</td>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($data["array"])&&$data["array"] != null) {?>
                <?php foreach($data["array"] as $key => $val) {?>
                    <tr>
                        <td><?= $val["username"] ?></td>
                        <td><?= $val["password"] ?></td>
                        <td><?= $val["type"] ?></td>
                        <td><?= $val["id_type"] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
