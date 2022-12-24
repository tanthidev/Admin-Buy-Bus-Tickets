
<?php 
    if(isset($_POST['save'])){
        $urlimage="";
        $name="";
        $email="";
        $phone="";
        if(isset($_FILES["userimage"])){
            $filename = $_FILES["userimage"]["name"];
            move_uploaded_file($_FILES["userimage"]['tmp_name'], "./uploads/".$filename);

            $bucketName = 'fir-f802f.appspot.com';
            $bucket = $storage -> bucket($bucketName);
            if(!"./uploads/".$filename){
                $object = $bucket -> upload(
                    fopen("./uploads/".$filename, 'r'), 
                    [
                        "fredefineAcl" => "publicRead"
                    ]
                );
            }

            $urlimage="https://storage.cloud.google.com/".$bucketName."/".$filename;


            if(isset($_POST['name'])){
                $name=$_POST['name'];
            }
    
            if(isset($_POST['phone'])){
                $phone=$_POST['phone'];
                $phone= "+84".ltrim($phone, $phone[0]);
            }
            $user = $auth->getUser($_POST['id']);
            $uid = $_POST['id'];
    
            $properties = [
                'displayName' => $name,
                'phoneNumber' => $phone,
                'photoUrl'    => $urlimage,
            ];
        } else {
            if(isset($_POST['name'])){
                $name=$_POST['name'];
            }
    
            if(isset($_POST['phone'])){
                $phone=$_POST['phone'];
                $phone= "+84".ltrim($phone, $phone[0]);
            }
            $user = $auth->getUser($_POST['id']);
            $uid = $_POST['id'];
    
            $properties = [
                'displayName' => $name,
                'phoneNumber' => $phone,
            ];
        }


        $auth->updateUser($uid, $properties);
    }
    
    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
    }
    $user = $auth->getUser($uid);
    
?>

<div id="main" class="main-content flex-1 bg-gray-100">
    <div class="bg-gray-800 pt-3">
        <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h1 class="font-bold pl-2">Edit User</h1>
        </div>
    </div>
    
    <!--  -->
    <div class="relative min-h-screen flex items-center justify-center bg-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 bg-no-repeat bg-cover">
	<div class="absolute bg-black opacity-60 inset-0 z-0"></div>
	<div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg z-10">
    <div class="grid  gap-8 grid-cols-1">
        <form action="/editUser.php" method="POST" class="flex flex-col " enctype="multipart/form-data">
                <div class="flex flex-col sm:flex-row items-center">
                    <h2 class="font-semibold text-lg mr-auto">User Info</h2>
                    <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
                </div>
                <div class="mt-5">
                    <div class="form">
                        <div class="md:space-y-2 mb-3">
                        
                            <div class="flex items-center py-6">
                                <!-- <div class="w-12 h-12 mr-4 flex-none rounded-xl border overflow-hidden">
                                    <img class="w-12 h-12 mr-4 object-cover" src="https://images.unsplash.com/photo-1611867967135-0faab97d1530?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80" alt="Avatar Upload">
                                </div> -->
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url('<?= $user -> photoUrl ?>');"></div>
                                </div>
                                <label class="cursor-pointer ">
                                    <span class="focus:outline-none text-white text-sm py-2 px-4 rounded-full bg-blue-900 hover:bg-blue-800 hover:shadow-lg ml-6">Browse</span>
                                    <input name="userimage" id="imageUpload" type="file" class="hidden">
                                </label>
                                </div>
                            </div>
                            <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">ID</label>
                                    <input value="<?=$user->uid?>" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="id" id="id" readonly>
                    
                                </div>
                            <div class="md:flex flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Name <abbr title="required">*</abbr></label>
                                    <input value="<?=$user->displayName?>" placeholder="Name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="name" id="name">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                                <div class="mb-3 space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Email<abbr title="required">*</abbr></label>
                                    <input value="<?=$user->email?>" placeholder="Email" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="email" id="email" readonly>
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>
                            
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label value="<?=$user->phoneNumber?>" class="font-semibold text-gray-600 py-2">Phone Number</label>
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                    <input value="<?= $user -> phoneNumber?>" placeholder="Phone Number" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="phone" required="required" id="integration_street_address">
                                </div>
                            </div>
                            <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                <button class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100"> Cancel </button>
                                <button class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500" name="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<style>
    .avatar-preview {
        width: 100px;
        height: 100px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #f8f8f8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-preview > div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>