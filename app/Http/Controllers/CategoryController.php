<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $filters = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setFilters();
        $data['filters'] = $this->filters;
        $data['rows'] = CategoryResource::collection(Category::paginate(20));
        $data['page_title'] = "Category";
        $data['breadcrumb'] = '';
        return view("admin.category.index" , $data);
    }

    public function create(){
        return view("admin.category.create" );

    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->all();
        $category = Category::create($data);
        return redirect()->route("admin.category.index");
    }

    public function edit(Category $category){
        return view("admin.category.edit" , ["row" => $category] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.category.view",compact('category'));
        // return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route("admin.category.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        flash()->success("Deleted Succefully");
        return redirect()->back();
    }

    public function setFilters() {
        $this->filters[] = [
            'name' => 'type',
            'type' => 'input',
            'trans' => true,
            'value' => request()->get('type' ),
            'attributes' => [
                'class'=>'form-control',
                'label'=>"Type",
                'placeholder'=>"Type",
            ]
        ];
    }
}
