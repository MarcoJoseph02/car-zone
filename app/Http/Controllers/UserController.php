<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $data['rows'] = userResource::collection(User::paginate(20));
        $data['page_title'] = "Users";
        $data['breadcrumb'] = '';
        return view("admin.users.index", $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data["password"] = Hash::make($request->password);
        $user = User::create($data);
        return  new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $user=User::findOrFail($id);
        // return new UserResource($user);
        return view("admin.users.view", compact('user'));
    }

    public function edit(User $user)
    {
        $data["row"] = $user;
        $data = array_merge($data);
        // dd($data);
        return view("admin.users.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        // return  new UserResource($user);
        return redirect()->route("admin.users.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        // return response()->json(null , 200);
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
