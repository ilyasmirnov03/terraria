<?php

$sql = "SELECT * FROM items";
$items = $dbh->query($sql)->fetchAll();

echo head('Collect them all!', url('/tailwind/output.css'));

?>

<body>
    <main class="p-4">
        <table class="table-fixed text-xl">
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
                    <tr class="divide-y">
                        <td class="pr-2 py-4"><?php echo $item['id']; ?></td>
                        <td class="w-32 py-4"><?php echo $item['name']; ?></td>
                        <td class="py-4 text-center"> <code class="bg-gray-100 p-1"><?php echo $item['internalName']; ?></td></code>
                        <td class="w-2 py-4">
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
    </main>
    <script src="<?php echo url('/../src/pages/collection/collection.js') ?>"></script>
</body>

</html>