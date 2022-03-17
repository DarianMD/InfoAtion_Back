<?php

require_once("services/Database.php");

class Update
{


    public static function updateRow($table,$fields,$types){
        $database = new Database();
        $database->connect();

        $id = $fields['id'];

        unset($fields['id']);



        $queryupdate = "UPDATE $table SET ";

        if (isset($fields['password'])) {
            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);
        }

        $keys = array_keys($fields);
        $values = array_values($fields);


        for ($x = 0; $x < count($types); $x++) {
            for ($y = 0; $y < count($fields); $y++) {
                if ($keys[$y] == $types[$x][0] && !str_contains($types[$x][1], 'int')) {
                    $values[$y] = "'$values[$y]'";
                }
            }
        }


        for ($y = 0; $y < count($fields); $y++) {
            $queryupdate = "$queryupdate$keys[$y]=$values[$y],";
        }

        $queryupdate = substr($queryupdate, 0, -1);

        $queryupdate = "$queryupdate WHERE id = $id";


        return $queryupdate;
    }


    public static function existID($table,$fields){
        $database = new Database();
        $database->connect();

      

        $querydelete = "SELECT * FROM $table WHERE id = $fields";
        $data = $database->getConnection()->query($querydelete);
        $data = mysqli_fetch_all($data);


        if($data == null){
            return array('result' => false, 'message' => 'ID not exist');

        }
        
        return true;
        
    }


  

    }