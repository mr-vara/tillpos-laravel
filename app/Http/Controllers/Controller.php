<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get Model class name from Controller Name
     * 
     * @return string
     */
    public function getModelClassNameFromControllerName()
    {
        $className = $this->getModelShortClassNameFromControllerName();

        $modelClass = "App\\" . $className;

        return $modelClass;
    }

    /**
     * Get Model Short class name from Controller Name
     * 
     * @return string
     */
    public function getModelShortClassNameFromControllerName()
    {
        $className = str_replace('Controller', '', substr(strrchr(get_class($this), '\\'), 1));

        return $className;
    }

    /**
     * Create particular model data (Used by inherited Controller class) 
     * 
     * @param array $data
     * 
     * @return object
     */
    public function create($data = [])
    {
        $modelClass = $this->getModelClassNameFromControllerName();


        $modelData = request()->only($modelClass::getFillableAttributes());

        $model = $modelClass::create(array_merge($modelData, $data));

        $model = $modelClass::find($model->id);

        return $model;
    }

    /**
     * Get one particular model data (Used by inherited Controller class) 
     * 
     * @param int $id 
     * @param array $relationships
     * 
     * @return object
     */
    public function getOne($id, array $relationships = null)
    {
        $modelClass = $this->getModelClassNameFromControllerName();

        $model = is_null($relationships) ? $modelClass::findOrFail($id) : $modelClass::with($relationships)->find($id);

        return $model;
    }

    /**
     * Get all data of particular model (Used by inherited Controller class) 
     * 
     * @param array $relationships
     * 
     * @return object
     */
    public function getAll(array $relationships = null) : Collection
    {
        $modelClass = $this->getModelClassNameFromControllerName();

        $model = is_null($relationships) ? $modelClass::get() : $modelClass::with($relationships)->get();

        return $model;
    }

    /**
     * Update particular model data (Used by inherited Controller class) 
     * 
     * @param int $id 
     * 
     * @return object
     */
    public function updateOne($id)
    {
        $modelClass = $this->getModelClassNameFromControllerName();

        $model = $modelClass::findOrFail($id);

        $model->update(request()->only($modelClass::getFillableAttributes()));

        $model = $modelClass::find($model->id);

        return $model;
    }

    /**
     * Delete one particular model data (Used by inherited Controller class) 
     * 
     * @param int $id 
     * 
     * @return string
     */
    public function deleteOne($id)
    {
        $modelClass = $this->getModelClassNameFromControllerName();

        $model = $modelClass::findOrFail($id);

        $model->delete();

        return response('', 204);
    }
}
