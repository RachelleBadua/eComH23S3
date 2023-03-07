<?php
namespace app\controllers;

class Profile extends \app\core\Controller{

	public function index(){
		// view the profile
		$profile = new \app\models\ProfileInformation();
		$profile = $profile->getByUserId($_SESSION['user_id']);
		if($profile)
			$this->view('Profile/index', $profile);
		else
			header('location:/Profile/create');
	}

	public function create(){
		// checks if button is clicked
		if(isset($_POST['action'])){
			$profile = new \app\models\ProfileInformation();
			$profile->user_id = $_SESSION['user_id'];
			$profile->first_name = $_POST['first_name'];
			$profile->last_name = $_POST['last_name'];
			$profile->middle_name = $_POST['middle_name'];

			$uploadedPicture = $this->uploadPicture($_SESSION['user_id']);

            if(isset($uploadedPicture['target_file']))
                $profile->picture = $uploadedPicture["target_file"];

            $uploadMessage = $uploadedPicture["upload_message"] == 'success' ? '' : '&error=Something went wrong '.$uploadedPicture["upload_message"];

			$success = $profile->insert();
			if($success)
				header('location:/Profile/index?success=Profile created.');
			else
				header('location:/Profile/index?error=Something went wrong. You can only have one profile.');
		}else{
			$this->view('Profile/create');
		}
	}

	public function edit(){
		$profile = new \app\models\ProfileInformation();
		$profile = $profile->getByUserId($_SESSION['user_id']);

		if(isset($_POST['action'])){
			
			// do not need to delete user_id
			// $profile->user_id = $_SESSION['user_id'];
			$profile->first_name = $_POST['first_name'];
			$profile->last_name = $_POST['last_name'];
			$profile->middle_name = $_POST['middle_name'];

			$this->addPicture($_SESSION['user_id']);


			$success = $profile->update();
			if($success)
				header('location:/Profile/index?success=Profile modified.');
			else
				header('location:/Profile/index?error=Something went wrong.');
		}else{
			$this->view('Profile/edit', $profile); // adding $profile tp view info, to fill the fields
		}
	}

	// upload file and get uqiueid of image and put it into database
	public function uploadPicture($user_id){

		// echo "add picture";
		$uploadedFile = array();

		if(isset($_FILES['ProfilePicture']) && ($_FILES['ProfilePicture']['error'] == UPLOAD_ERR_OK)){

			$info = getimagesize($_FILES['ProfilePicture']['tmp_name']);

			$allowedTypes = ["jpg", "png", "gif"];

			$fileName = basename($_FILES["profilePicture"]["name"]);

            $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

			if($info == false){

                $uploadedFile["upload_message"] = "Bad image file format!";
                $uploadedFile["target_file"] = null;

            }else if(!in_array($fileType, $allowedTypes)){//File uploaded, but check the image file type

                $uploadedFile["upload_message"] = "The image file type is not accepted!";
                $uploadedFile["target_file"] = null;

            }else{
                // Save the image in the images folder
                $path = '..'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;

                $targetFileName = $user_id.'-'.uniqid().'.'.$fileType;

                move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $path.$targetFileName);

                $uploadedFile["upload_message"] = "success";

                $uploadedFile["target_file"] = $targetFileName;

                return  $uploadedFile;

            }

        }else{

            $uploadedFile["upload_message"] = "Image not specified or not uploaded successfully.";

            $uploadedFile["target_file"] = null;
        }

        return $uploadedFile;
    }
}
// 			if($info == false){
// 				header('location:/Profile/edit?error=Wrong file format');
// 			}else if(!array_key_exists($info[2], $allowedTypes)){ // file is being uploaded, but the image file type

// 				header('location:/Profile/edit?error=The file type is not accepted');
// 			} else {
// 				// save the image in the images folder
// 				$path = getcwd().DIRECTORY_SEPERATOR.'images'.DIRECTORY_SEPERATOR;
// 				$fileName = uniqid().$allowedTypes[$info[2]]; 

// 				move_uploaded_file($_FILES['ProfilePicture']['tmp_name'], $path.$fileName);
// 			}
// 		}else{
// 			$this->view('Profile/edit');

// 		}
// 	}
// }