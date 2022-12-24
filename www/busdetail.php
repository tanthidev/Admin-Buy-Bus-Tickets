<?php 
    include "firebase/config/dbcon.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin for BBT</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="icon" type="image/x-icon" href="./images/logo/logoblue.png">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="style/tailwind.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>


</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-3">

<?php include "includes/header.php"; ?>


<main>
    <div class="flex flex-col md:flex-row">
        <nav aria-label="alternative nav">
            <div class="bg-gray-800 bottom-0 z-10 w-full content-center">

                <div class="md:mt-12 md:w-48 md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-600">
                                <i class="fab fa-windows pr-0 md:pr-3"></i></i></i></i>
                                <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">
                                    DashBoard

                                </span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-600">
                                <i class="fa fa-envelope pr-0 md:pr-3"></i>
                                <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">
                                    Messages
                                </span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="/booking.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-600">
                                <i class="fas fa-money-check-alt  pr-0 md:pr-3"></i>
                                <span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">
                                    Booking
                                </span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="#" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-600">
                                <i class="fa fa-wallet pr-0 md:pr-3"></i>
                                <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">
                                    Payments
                                </span>
                            </a>
                        </li>
                        <button class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-600 text-left" type="button" data-dropdown-toggle="dropdown">
                        <i class="fas fa-tasks pr-0 md:pr-3"></i>
                            <span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">
                                Manager
                            </span> 
                        </button>
                        <!-- Dropdown menu -->
                        <div class="hidden bg-transparent w-full text-base z-50 list-none divide-y divide-gray-100 rounded shadow my-4" id="dropdown">
                            <div class="px-4">
                                <ul class="py-1" aria-labelledby="dropdown">
                                    <li>
                                        <a href="/user.php" class="py-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block hover:text-white border-b-2 border-gray-800 hover:border-blue-600">User</a>
                                    </li>
                                    <li>
                                        <a href="/bus.php" class="py-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block hover:text-white border-b-2 border-gray-800 hover:border-blue-600">Bus</a>
                                    </li>
                                    <li>
                                        <a href="#" class="py-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block hover:text-white border-b-2 border-gray-800 hover:border-blue-600">Earnings</a>
                                    </li>
                                    <li>
                                        <a href="#" class="py-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block hover:text-white border-b-2 border-gray-800 hover:border-blue-600">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </div>


            </div>
        </nav>

        <!-- Dashboard -->
        <?php include "includes/busdetail.php" ?>
    </div>
</main>




<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>
<script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>


</body>

</html>
