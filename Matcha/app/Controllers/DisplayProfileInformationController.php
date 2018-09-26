<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/16/18
 * Time: 12:44 PM
 */

namespace App\Controllers;
use App\Database\DatabaseRequest;
use App\Models\DisplayUsersInformation;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * Class DisplayProfileInformationController
 * @package App\Controllers
 */
class DisplayProfileInformationController extends DisplayUsersInformation
{
    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function finishUserRegister(Request $request, Response $response, $args){
        $data = $request->getParams();

//        return $response->withStatus(200)
//            ->withHeader('Content-Type', 'application/json')
//            ->write(json_encode($data));

        if (isset($data['Token']) && !empty($data['Token'])) {
            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($this->checkExtendDate($data, $data['Token'])));
        }
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode("empty_token"));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
//    public function registerUserSendData($request, $response, $args){
//        $params = $request->getParams();
//        $database = new DatabaseRequest($this->db);
//        $database->UseDB('db_matcha');
//        $FirstName = htmlspecialchars(addslashes($params['FirstName']));
//        $LastName = htmlspecialchars(addslashes($params['LastName']));
//        $City = htmlspecialchars(addslashes($params['City']));
//        $Country = htmlspecialchars(addslashes($params['Country']));
//        $Age = htmlspecialchars(addslashes($params['Age']));
//        $Bio = htmlspecialchars(addslashes($params['Bio']));
//        $Tags = htmlspecialchars(addslashes($params['Tags']));
//
//        $database->updateTableData('users',"FirstName='{$FirstName}', LastName='{$LastName}', City='{$City}', Country='{$Country}', Age='{$Age}', Gender='{$params['Gender']}',Orientation='{$params['Orientation']}', Bio='{$Bio}', Tags='{$Tags}', FullRegister='1'",
//            "Login='{$_SESSION['User']->getUserLogin()}'");
//        return $response->withRedirect($this->router->pathFor('current.profile', ['username'=> $_SESSION['User']->getUserLogin()]));
//    }

//    public function uploadPicture()
//    {
//        $uploaddir = 'src/';
//        if ($_FILES['photoloader']['name'] != "") {
//            $uploadfile = $uploaddir . basename($_FILES['photoloader']['name']);
//            if (move_uploaded_file($_FILES['photoloader']['tmp_name'], "$uploadfile")) {
//                echo "Файл корректен и был успешно загружен.\n";
//            } else {
//                echo "Возможная атака с помощью файловой загрузки!\n";
//            }
//            return $uploadfile;
//        }
//    }
//$img = str_replace('data:image/png;base64,', '', $img);
//$img = str_replace(' ', '+', $img);
//$data = base64_decode($img);
//$file = "src/".md5($data).".png";
//file_put_contents($file, $data);
//$db = new PDOdb();
//$db->UseDB("camagru");
//$user = $db->findUserData("users", "UserID", "Login='".$_SESSION['Login']."'");
//$db->addTableData("pictures", "UserID, url, Likes, Private",
//"'".$user[0]["UserID"]."','".$file."','0','0'");
//
//    private function checkData($data){
//        if ($data->FirstName == null) {
//            $data->FirstName = "No data";
//        }
//        if ($data->LastName == null) {
//            $data->LastName = "No data";
//        }
//        if ($data->City == null) {
//            $data->City = "No data";
//        }
//        if ($data->Country == null) {
//            $data->Country = "No data";
//        }
//        if ($data->Age == null) {
//            $data->Age = "No data";
//        }
//        if ($data->Gender == null) {
//            $data->Gender = "No data";
//        }
//        if ($data->Orientation == null) {
//            $data->Orientation = "No data";
//        }
//        if ($data->Bio == null) {
//            $data->Bio = "No data";
//        }
//        if ($data->Tags == null) {
//            $data->Tags = "No data";
//        }
//        if ($data->Avatar == null) {
//            if ($data->Gender == 'Female') {
//                $data->Avatar = "/standartAvatar/female.jpg";
//            }
//            else{
//                $data->Avatar = "/standartAvatar/male.jpg";
//            }
//        }
//    }
}