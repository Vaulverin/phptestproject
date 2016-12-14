<?php
include("IDataStorage.php");
include("MySQLStorage.php");
include("DataClasses/includes.php");

class DataStorageManager
{
    private $m_dataStorage;
    private static $m_manager;
    private function __construct() {}

    public static function GetManager() : DataStorageManager
    {
        self::$m_manager = self::$m_manager ?? new DataStorageManager();
        return self::$m_manager;
    }

    public function GetStorage() : IDataStorage
    {
        $m_dataStorage = $m_dataStorage ?? new MySQLStorage();
        return $m_dataStorage;
    }

}