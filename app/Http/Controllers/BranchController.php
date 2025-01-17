<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
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
        $data['rows'] = BranchResource::collection(Branch::paginate(20));
        $data['page_title'] = "branches";
        $data['breadcrumb'] = '';
        return view("admin.branches.index" , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.branches.create" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        $category = Branch::create($data);
        return redirect()->route("admin.branch.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view("admin.branches.edit" , ["row" => $branch] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $data = $request->all();
        $branch->update($data);
        return redirect()->route("admin.branch.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch -> delete();
        flash()->success("Deleted Succefully");
        return redirect()->back();   
    }

    public function setFilters() {
        $this->filters[] = [
            'name' => 'phone_no',
            'type' => 'input',
            'trans' => false,
            'value' => request()->get('phone_no' ),
            'attributes' => [
                'class'=>'form-control',
                'label'=>"Type",
                'placeholder'=>"name",
            ]
        ];
    }
}
