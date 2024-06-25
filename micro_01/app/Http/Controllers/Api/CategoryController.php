<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{   
    protected $repository;
    public function __construct(Category $model){
        $this->repository = $model;
    }
    public function index(){
       $categoies = $this->repository->get();
       return CategoryResource::collection($categoies);
    }
    public function store(StoreUpdateCategory $request){
      
       $category = $this->repository->create($request->validated());

       return (new CategoryResource($category));

    }
    public function show($url){
        $category = $this->repository->where('url', $url)->firstOrFail(); 
        return (new CategoryResource($category));
    }
    public function update(StoreUpdateCategory $reques, $url){
        $category = $this->repository->where('url', $url)->firstOrFail(); 
        $category->update($reques->validated());

        return (new CategoryResource($category))->additional(['message' => 'success']);
    }
    public function destroy($id){
        
    }
}
