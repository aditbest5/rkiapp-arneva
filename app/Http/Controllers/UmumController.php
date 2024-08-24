<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Google\Cloud\Storage\StorageClient;

session_start();

class UmumController extends Controller
{

    public function run(Request $request)
    {
        $cmd = $request->cmd;
        if ($cmd == "selLogin") {
            $result = $this->selLogin($request, $cmd);
        } else if ($cmd == "uploadImage") {
            $result = $this->uploadImage($request, $cmd);
        } else if ($cmd == "logOut") {
            $result = $this->logOut($request, $cmd);
        } else {
            $result = save($request, $cmd);
        }
        return $result;
    }

    public function selLogin(Request $request, $cmd)
    {
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header("Access-Control-Allow-Headers: X-Requested-With");
        $user = $request->userId;
        $userPwd = $request->userPwd;
        $sql = "
        SELECT a.* ,b.nama_koperasi,b.idx,c.nama_toko,b.noAccount
        from mst_user a
        LEFT JOIN mst_koperasi b ON a.no_koperasi=b.idx
        LEFT JOIN mst_toko c ON a.no_toko=c.toko_id 
        where (userid=? OR usernm=?)  and userPwd=?
        ";
        $results = DB::select($sql, [$user, $user, $userPwd]);

        if (count($results) > 0) {
            $sql = " 
            SELECT * FROM user_sysmenu a
            JOIN sysmenu b ON a.menuId=b.menuCode  where userid=? and showYn='Y'  and menuClass='MODUL'
            ORDER BY menuorder   ";
            $homePrevileges = DB::select($sql, [$results[0]->userId]);

            $sql = " 
            SELECT * FROM user_sysmenu a
            JOIN sysmenu b ON a.menuId=b.menuCode  where userid=? and showYn='Y'  and menuClass='MENU' 
            ORDER BY menuorder   ";
            $menuPrevileges = DB::select($sql, [$results[0]->userId]);

            $sql = " 
            SELECT * FROM user_sysmenu a
            JOIN sysmenu b ON a.menuId=b.menuCode  where userid=? and showYn='Y' and menuClass='STEP1'
            ORDER BY menuorder   ";
            $step1Previleges = DB::select($sql, [$results[0]->userId]);

            $_SESSION['userId'] = $results[0]->userId;
            $_SESSION['userPwd'] = $results[0]->userPwd;
            $_SESSION['userNm'] = $results[0]->userNm;
            $_SESSION['level'] = $results[0]->level;
            $_SESSION['id_koperasi'] = $results[0]->no_koperasi;
            $_SESSION['nama_koperasi'] = $results[0]->nama_koperasi;
            $_SESSION['id_toko'] = $results[0]->no_toko;
            $_SESSION['nama_toko'] = $results[0]->nama_toko;
            $_SESSION['namaUser'] = $results[0]->namaUser;
            $_SESSION['noAccount'] = $results[0]->noAccount;;

            $_SESSION['homePrevileges'] = $homePrevileges;
            $_SESSION['menuPrevileges'] = $menuPrevileges;
            $_SESSION['step1Previleges'] = $step1Previleges;
        } else {
            $results = array("sts" => "N", "desc" => "User Id / Password Salah ", "msg" => "Harap Gunakan User Id /Password Yang Lain");
        }
        return json_encode($results);
    }

    public function save(Request $request, $cmd)
    {
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header("Access-Control-Allow-Headers: X-Requested-With");
        $id = $request->idx;
        $yy = $request->yy;
        //
        return 'irsan' . $id . "   " . $yy;
    }
    public function logOut(Request $request, $cmd)
    {
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header("Access-Control-Allow-Headers: X-Requested-With");
        session_unset();
        session_destroy();
        $resutlMsg = array("sts" => "Y", "desc" => "", "msg" => "");
        echo json_encode($resutlMsg);
    }

    public function uploadImage(Request $request, $cmd)
    {
        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header("Access-Control-Allow-Headers: X-Requested-With");

        $fileName = $_POST["fileName"];
        $folder = $_POST["folder"];
        $target_dir = "images/";
        $myfiles = $_FILES["fileToUpload"]["tmp_name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $sql = "delete from mst_barang where idx='" . $fileName . "' ";

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $resutlMsg = array("sts" => "OK", "desc" => "File is an image - " . $check["mime"] . ".", "msg" => "");
                $uploadOk = 1;
            } else {
                //$results = DB::delete($sql);
                $resutlMsg = array("sts" => "N", "desc" => "File is not an image.", "msg" => "");
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($folder == "bukti") {
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                //echo "Sorry, your file is too large.";
                //$results = DB::delete($sql);
                $resutlMsg = array("sts" => "N", "desc" => "Sorry, your file is too large.", "msg" => "");
                $uploadOk = 0;
            }
        } else {
            if ($_FILES["fileToUpload"]["size"] > 100000) {
                //echo "Sorry, your file is too large.";
                //$results = DB::delete($sql);
                $resutlMsg = array("sts" => "N", "desc" => "Sorry, your file is too large.", "msg" => "");
                $uploadOk = 0;
            }
        }


        // Allow certain file formats
        if ($imageFileType != "jpg" /*&&  $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" */) {
            //echo " Sorry, only JPG  files are allowed.";
            //$results = DB::delete($sql);
            $resutlMsg = array("sts" => "N", "desc" => " Sorry, only JPG  files are allowed.", "msg" => "");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            //$resutlMsg = array("sts" => "N", "desc" => "Sorry, your file was not uploaded.", "msg" => "");
            echo json_encode($resutlMsg);
            // if everything is ok, try to upload file
        } else {

            $googleConfigFile = file_get_contents(config_path('service-account.json'));
            $storage = new StorageClient([
                'keyFile' => json_decode($googleConfigFile, true)
            ]);
            $storageBucketName = config('googlecloud.storage_bucket');
            $bucket = $storage->bucket("atous-product-images");
            /* Upload a file to the bucket.
            Using Predefined ACLs to manage object permissions, you may
            upload a file and give read access to anyone with the URL.*/
            //$bucket->upload(
            //    fopen($_FILES['fileToUpload']['tmp_name'], 'r'),
            //    ['name' => $folder . "/" . $fileName . ".jpg"]
            //);


            $bucket->upload(
                fopen($_FILES['fileToUpload']['tmp_name'], 'r'),
                [
                    'name' => $folder . "/" . $fileName . ".jpg",
                    'enable_cache' => false,
                    'read_cache_expiry_seconds' => 0,
                    'Cache-Control' => 'no-store'
                ]
            );

            if ($folder == "barang") {
                DB::update("update mst_barang set foto='" . $fileName . "' where idx='" . $fileName . "' ");
            } else if ($folder == "bukti") {
                DB::update("update tr_angsuran set foto_bukti='" . $fileName . "' where CONCAT(nomor_pinjaman,'-',no_pengajuan_idx)='" . $fileName . "'  ");
            }

            $resutlMsg = array("sts" => "OK", "desc" => " Save Data Success \n  &  gambar sudah diupload .", "msg" => "");
            return json_encode($resutlMsg);

            /* move Local Storage Public/Images/
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'gcs/'. $fileName . ".jpg"  )) {
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            if(is_writable(public_path() ."/". $target_dir."/". $folder."/". $fileName . ".jpg")){
            $results = DB::update("update mst_barang set foto='".$fileName."' where idx='".$fileName."' ");
            //$resutlMsg = array("sts" => "OK", "desc" => " Save Data Success \n  &  " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " sudah diupload .", "msg" => "");
            $resutlMsg = array("sts" => "OK", "desc" => " Save Data Success \n  &  gambar sudah diupload .", "msg" => "");
            return json_encode($resutlMsg);
            } else {
            //$resutlMsg = array("sts" => "OK", "desc" => "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " Canot Upload To Server Please ReUpload Image Again.", "msg" => "");
            $resutlMsg = array("sts" => "OK", "desc" => "The file  Canot Upload To Server Please ReUpload Image Again.", "msg" => "");
            return json_encode($resutlMsg);
            } 
            
            } else {
            //echo "Sorry, there was an error uploading your file.";
            $results = DB::delete($sql);
            $resutlMsg = array("sts" => "N", "desc" => "Sorry, there was an error uploading your file.", "msg" => "");
            return json_encode($resutlMsg);
            }
            */
        }
    }
}
