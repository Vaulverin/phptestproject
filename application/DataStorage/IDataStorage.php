<?php
interface IDataStorage
{
     public function Save(string $className, array $params);
     public function Update(string $className, array $params);
     public function Load(string $className, array $params);
     public function Remove(string $className, array $params);
}