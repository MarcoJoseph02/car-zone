<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CarController extends Controller
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
        $data['rows'] = CarResource::collection(Car::paginate(20));
        $data['page_title'] = "Cars";
        $data['breadcrumb'] = '';
        return view("admin.car.index" , $data);
    }

    public function create(){
        return view("admin.car.create" , $this->getLookup() );

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCarRequest $request)
    {
       
        $data = $request->validated();
        $car = Car::create($data);
        return redirect()->route("admin.car.index");
    }


    public function edit(Car $car){
        $data["row"] = $car;
        $data = array_merge($data , $this->getLookup());
        return view("admin.car.edit" , $data );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();
        $car->update($data);
        return redirect()->route("admin.brand.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        flash()->success("Deleted Succefully");
        return redirect()->back();    
    }

    public function setFilters() {
        $this->filters[] = [
            'name' => 'name',
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

    private function getLookup(){
        return [
            "suppliers" => Supplier::pluck('lname', 'id'),
            "branches" => Branch::pluck('name', 'id'),
            "brands" => Brand::pluck('name', 'id'),
            "categories" => Category::pluck('type', 'id'),
        ];
    }
}
