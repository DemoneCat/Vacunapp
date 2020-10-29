<?php
namespace App\Repo;

abstract class BaseRepository{
    private function __construct(){

    }

    //Abstract Operations
    abstract public function getModel();

    //Create Operations
    public function create($object){
        return $this->getModel()->create($object);
    }
    //Read Operations
    public function find($id){
        return $this->getModel()->find($id);
    }
    public function getAll(){
        return $this->getModel()->paginate(15);
    }

    //Update Operations
    public function update($object, $data){
        $object->fill($data);
        $object->save();
        return $object;
    }

    //Delete Operations
    public function delete($object){
        $object->delete();
    }
}


