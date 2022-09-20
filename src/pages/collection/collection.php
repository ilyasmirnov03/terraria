<?php

$sql = "SELECT * FROM items";
$items = $dbh->query($sql)->fetchAll();

echo head('Collect them all!', url('/tailwind/output.css'));

?>

<body>
    <table class="table-fixed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Internal name</th>
                <th>Completed?</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($items as $item) { ?>
                <tr class="bg-green-50 odd:bg-green-100">
                    <td class="pr-2"><?php echo $item['id']; ?></td>
                    <td class="w-32"><?php echo $item['name']; ?></td>
                    <td><?php echo $item['internalName']; ?></td>
                    <td class="w-2">
                            <?php if ($item['isCollected'] == 1) { ?>
                                <input type="checkbox" checked id="<?php echo $item['id'] ?>">
                            <?php } else { ?>
                                <input type="checkbox" id="<?php echo $item['id'] ?>">
                            <?php } ?>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <script src="<?php echo url('/../src/pages/collection/collection.js') ?>"></script>
</body>

</html>