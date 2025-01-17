<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $data['rows'] = SupplierResource::collection(Supplier::paginate(20));
        $data['page_title'] = "Suppliers";
        $data['breadcrumb'] = '';
        return view("admin.supplier.index" , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.supplier.create" );

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
        $category = Supplier::create($data);
        return redirect()->route("admin.supplier.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view("admin.supplier.edit" , ["row" => $supplier] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->all();
        $supplier->update($data);
        return redirect()->route("admin.supplier.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier -> delete();
        flash()->success("Deleted Succefully");
        return redirect()->back();   
    }

    public function setFilters() {
        $this->filters[] = [
            'name' => 'lname',
            'type' => 'input',
            'trans' => true,
            'value' => request()->get('name' ),
            'attributes' => [
                'class'=>'form-control',
                'label'=>"Type",
                'placeholder'=>"name",
            ]
        ];
    }
}
