<?php
abstract class Savable
{
    public abstract function GetPropertiesToSave() : array;
    public function Save()
    {
        return DataStorageManager::GetManager()->GetStorage()->Save(get_class($this), $this->GetPropertiesToSave());
    }

    public function Update()
    {
        DataStorageManager::GetManager()->GetStorage()->Update(get_class($this), $this->GetPropertiesToSave());
    }
}