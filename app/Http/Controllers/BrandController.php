<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BrandController extends Controller
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
        $data['rows'] = BrandResource::collection(Brand::paginate(20));
        $data['page_title'] = "Brands";
        $data['breadcrumb'] = '';
        return view("admin.brand.index", $data);
    }

    public function create()
    {
        return view("admin.brand.create");
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $data = $request->validated();
        $brand = Brand::create($data);
        if ($request->hasFile('brand_image')) { //name = images

            $image = $request->file('brand_image');
            $brand->addMedia($image)->toMediaCollection('brand_image');
            //dd($brand->getFirstMediaUrl('brand_image'));
        }
        return redirect()->route("admin.brand.index");
    }


    public function edit(Brand $brand)
    {
        return view("admin.brand.edit", ["row" => $brand]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view("admin.brand.view", compact('brand'));
        // return new BrandResource($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();
        
        if ($request->hasFile('brand_image')) {
            // Optional: delete old image
            $brand->clearMediaCollection('brand_image');
            // Add new image
            $brand->addMedia($request->file('brand_image'))->toMediaCollection('brand_image');
        } 
        $brand->update($data);

        return redirect()->route("admin.brand.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        flash()->success("Deleted Succefully");
        return redirect()->back();
    }

    public function setFilters()
    {
        $this->filters[] = [
            'name' => 'name',
            'type' => 'input',
            'trans' => true,
            'value' => request()->get('name'),
            'attributes' => [
                'class' => 'form-control',
                'label' => "Type",
                'placeholder' => "name",
            ]
        ];
    }
}
