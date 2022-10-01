<?php

$sql = "SELECT * FROM items";
$items = $dbh->query($sql)->fetchAll();

echo head('Collect them all!', url('/tailwind/output.css'));

?>

<body>
    <div id="loader" class="flex justify-center items-center z-50">
        <div>
            <img class="animate-spin" src="<?php echo url('/assets/images/Boulder.png') ?>" alt="It's a boulder">
        </div>
    </div>
    <div id="menu" class="fixed top-1.5 right-1.5 lg:hidden z-40">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </div>
    <main class="p-4 flex flex-col lg:flex-row">
        <div>
            <input type="text" id="items-search" class="rounded-md p-4 my-8 w-6/12 focus:ring-0 focus:ring-green-600 focus:border-green-600 focus:border-2" placeholder="Search for item...">
            <table class="table-fixed text-xl">
                <thead>
                    <tr class="h-11">
                        <th>ID</th>
                        <th>Name</th>
                        <th class="hidden md:table-cell">Internal name</th>
                        <th class="flex items-center">
                            <div>
                                Completed?
                            </div>
                            <div class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="up-arrow" class="w-5 h-5 hover:text-green-600 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="down-arrow" class="w-5 h-5 hover:text-green-600 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($items as $item) { ?>
                        <tr class="divide-y search-info">
                            <td class="pr-2 py-4"><?php echo $item['id']; ?></td>
                            <td class="w-32 py-4"><?php echo $item['name']; ?></td>
                            <td class="py-4 text-center hidden md:block"> <code class="bg-gray-100 p-1"><?php echo $item['internalName']; ?></td></code>
                            <td class="w-2 py-4 text-center">
                                <input type="checkbox" id="<?php echo $item['id'] ?>" class="rounded text-green-600 focus:ring-green-600">
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div id="stats" class="p-4 drop-shadow transition-all ease-in-out untoggled duration-300 bg-gray-50 top-0 fixed w-fit h-screen lg:drop-shadow-none lg:bg-transparent lg:relative lg:block lg:grow lg:h-fit">
            <div class="flex justify-center items-center">
                <div class="drop-shadow w-48 h-48 lg:w-64 lg:h-64 lg:drop-shadow-none rounded-full bg-gray-100 relative overflow-hidden">
                    <div id="stat-circle" class=" absolute w-full h-full bg-green-600"></div>
                </div>
                <p id="percent-collected" class="text-3xl lg:text-4xl drop-shadow-sm absolute"></p>
            </div>
        </div>
    </main>
    <script src="<?php echo url('/assets/js/collection/mobileMenu.js') ?>"></script>
    <script src="<?php echo url('/assets/js/collection/itemsFilter.js') ?>"></script>
    <script src="<?php echo url('/assets/js/collection/collection.js') ?>"></script>
    <script src="<?php echo url('/assets/js/collection/itemSearch.js') ?>"></script>
</body>

</html>