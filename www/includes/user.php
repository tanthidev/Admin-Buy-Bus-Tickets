<?php 
    $users = $auth->listUsers(); 
    // $users = iterator_to_array($users, true);
    // $itemPerPage=5;
    // $totalPage = ceil(count($users)/$itemPerPage);
    // if(isset($_GET['page'])){
    //     $page = $_GET['page'];
    // } else {
    //     $page = 1;
    // }
?>
<div id="main" class="main-content flex-1 bg-gray-100">
    <div class="bg-gray-800 pt-3">
        <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h1 class="font-bold pl-2">User Manager</h1>
        </div>
    </div>

    <div class="flex pt-12 justify-center min-h-screen bg-gray-800">
	<div class="col-span-12">
		<div class="overflow-auto lg:overflow-visible ">
			<table class="table text-gray-400 border-separate space-y-6 text-sm">
				<thead class="bg-gray-900 text-gray-500 mb-3">
					<tr>
                        <th class="p-3">No</th>
						<th class="p-3">Name</th>
						<th class="p-3 text-left">Email</th>
						<th class="p-3 text-left">Phone</th>
						<th class="p-3 text-left">Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php 
                        $i=1;
                        foreach($users as $user){
                            if($user->photoUrl!=null){
                                $url = $user->photoUrl;
                            } else {
                                $url = "./images/user-empty.png";
                            }
                    ?>
                        <tr class="bg-gray-900 cursor-pointer hover:bg-gray-700">
                            <td class="p-3">
                                <?= $i++ ?>
                            </td>
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <img class="rounded-full h-12 w-12 object-cover" src="<?= $url ?>" alt="unsplash image">
                                    <div class="p-3">
                                        <?= $user -> displayName ?>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                            <?= $user -> email ?>
                            </td>
                            <td class="p-3 font-bold">
                                <?= $user -> phoneNumber ?>
                            </td>

                            <td class="p-3 ">
                                <a href="/editUser.php?uid=<?= $user -> uid?>" class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <button onclick="deleteUser()" class="text-gray-400 hover:text-gray-100  ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
				</tbody>
			</table>
		</div>


        <!-- Pagination -->
        <!-- <nav aria-label="Page navigation example" class = "mt-6 flex justify-center">
            <ul class="inline-flex -space-x-px">
                <?php
                    for($i=1; $i<=$totalPage; $i++){
                ?>
                    <li>
                        <a href="?page=<?= $i?>" class="px-3 py-2 leading-tight text-gray-200 bg-gray-900  hover:bg-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i?></a>
                    </li> 
                <?php } ?>
            </ul>
        </nav> -->

	</div>
</div>
</div>

<style>
	.table {
		border-spacing: 0 5px;
	}

	i {
		font-size: 1rem !important;
	}

	.table tr {
		border-radius: 20px;
	}

	tr td:nth-child(n+6),
	tr th:nth-child(n+6) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style>

