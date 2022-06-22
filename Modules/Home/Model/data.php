<?php
class DataModel{
    const DB = 'main';
    
    public static function GetSomeData(){
        $db = Model::GetInstance(self::DB);
        
        $prepare_data = [
            'id' => 1
        ];
        
        return $db->Select('SELECT * FROM data WHERE id=:id',$prepare_data);
    }
}
?>