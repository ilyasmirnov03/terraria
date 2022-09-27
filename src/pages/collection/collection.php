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
    <main class="p-4 flex">
        <div>
            <input type="text" id="items-search" class="rounded-md p-4 my-8 w-6/12 focus:ring-0 focus:ring-green-600 focus:border-green-600 focus:border-2" placeholder="Search for item...">
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
                        <tr class="divide-y search-info">
                            <td class="pr-2 py-4"><?php echo $item['id']; ?></td>
                            <td class="w-32 py-4"><?php echo $item['name']; ?></td>
                            <td class="py-4 text-center"> <code class="bg-gray-100 p-1"><?php echo $item['internalName']; ?></td></code>
                            <td class="w-2 py-4">
                                <input type="checkbox" id="<?php echo $item['id'] ?>" class="rounded text-green-600 focus:ring-green-600">
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div id="stats" class="grow h-fit">
            <div class="flex justify-center items-center">
                <div class="w-64 h-64 rounded-full bg-gray-100 relative overflow-hidden">
                    <div id="stat-circle" class="absolute w-full h-full bg-green-600"></div>
                </div>
                <p id="percent-collected" class="text-4xl drop-shadow-sm absolute"></p>    
            </div>
        </div>
    </main>
    <script src="<?php echo url('/assets/js/collection/collection.js') ?>"></script>
    <script src="<?php echo url('/assets/js/collection/itemSearch.js') ?>"></script>
</body>

</html>