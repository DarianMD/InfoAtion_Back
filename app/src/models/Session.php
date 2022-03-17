<?php

require_once("services/Database.php");
require_once("services/errors/NotFoundError.php");


require_once("src/lib/Insert.php");
require_once("src/lib/Validator.php");



class Session implements Model
{

    public static function get($id = null, array $fields = null)
    {

    }



    public static function getField($id)
    {
   

        if(Validator::isExist('user','email',$id[1])){
            return array('result' => false, 'message' => ''.$id[1].' not exist, try another');
        }



         
        $query = "SELECT b.id FROM user a, cookies b WHERE email = '$id[1]' AND a.id = b.user_id";


        $database = new Database();
        $database->connect();
        $data = $database->getConnection()->query($query);
        $data = mysqli_fetch_assoc($data);

        return array('result' => false, 'message' => $data);
    }
  

    public static function getAll()
    {
     
    }


    public static function insert(array $fields = null)
    {

    }
       
        

    public static function delete($id)
    {
    }

    public static function deleteAll()
    {
    }

    public static function update(array $fields = null)
    {
    }
}