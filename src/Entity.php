<?php 
namespace src;
abstract class Entity{

    protected $dbc;
    protected $tableName;
    protected $fields;
    protected $primaryKeys = ['id'];
    abstract protected function initFields();
    protected function __construct($dbc,$tableName)
    {
       $this->dbc = $dbc;
       $this->tableName = $tableName;
       $this->initFields();
    }

    public function findBy($fieldName,$fieldValue)
    {
        
        $sql = "SELECT * FROM ". $this->tableName . " WHERE ". $fieldName ."=:value";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['value' => $fieldValue]);
        $pageData = $stmt->fetch();
        $databaseData = $this->setValues($pageData,$this);
        return $databaseData;
    }
    public function findAll()
    {
        $result = [];
        $sql = "SELECT * FROM ". $this->tableName;
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $pageData = $stmt->fetchAll();
        if($pageData)
        {
            $className = static::class;
            foreach ($pageData as $objData) {
                $object = new $className($this->dbc);
                $object = $this->setValues($objData,$object);
                $result[] = $object;
            }
            return $result;

        }
       
    }
    public function setValues($values, $object = null)
    {
        if($object === null)
        {
            $object = $this;
        }

        foreach ($object->primaryKeys as $keyName) {

            if(isset($values[$keyName]))
            {
                $object->$keyName = $values[$keyName];
            }
          
        }

        foreach ($object->fields as $fieldName) {

            if(isset($values[$fieldName]))
            {
                $object->$fieldName = $values[$fieldName];
            }
          
        }
        return $object;
    }
    public function save()
    {
        $fieldBindings = [];
        $keyBindings = [];
        $prepareFields = [];
        foreach ($this->primaryKeys as $keyName) {
            $keyBindings[$keyName] = $keyName . ' = :' . $keyName;
            $prepareFields[$keyName] = $this->$keyName;
        }

        foreach ($this->fields as $fieldName) {
            $fieldBindings[$fieldName] = $fieldName . ' = :' . $fieldName;
            $prepareFields[$fieldName] = $this->$fieldName;
            
        }

        $fieldBindingsString = join(',',$fieldBindings);

        $keyBindingsString = join(',',$keyBindings);

        $sql = "UPDATE " . $this->tableName ." SET ". $fieldBindingsString 
                . " WHERE ".$keyBindingsString;

        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($prepareFields);
    }
}