<?php

$sql = "SELECT * FROM items";
$items = $dbh->query($sql)->fetchAll();

echo head('Collect them all!', url('/tailwind/output.css'));

?>

<body>
    <div id="loader" class="flex justify-center items-center">
        <div>
            <img class="animate-spin" src="<?php echo url('/assets/images/Boulder.png') ?>" alt="It's a boulder">
        </div>
    </div>
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
                            <input type="checkbox" id="<?php echo $item['id'] ?>">
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </main>
    <script src="<?php echo url('/../src/pages/collection/collection.js') ?>"></script>
</body>

</html>