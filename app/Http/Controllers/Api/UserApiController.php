<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\UserApi;
use Dflydev\DotAccessData\Exception\DataException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserApi::all();

        return response()->json([
            'status' => true,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        try{
            $user = UserApi::create($request->all());
            return response()->json([
                'status' => true,
                'message' => "User Created successfully!",
                'user' => $user
            ], 200);
        }catch (QueryException $e){
            return response()->json([
                'error message' => "Duplicate Email Exists.",
            ], 400);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserApi  $userApi
     * @return \Illuminate\Http\Response
     */
    public function show(UserApi $userApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserApi  $userApi
     * @return \Illuminate\Http\Response
     */
    public function edit(UserApi $userApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserApi  $userApi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if($userApi=UserApi::find($id)){
            $userApi->update($request->all());
            return response()->json([
                'status' => true,
                'message' => "User Updated successfully!",
                'user' => $userApi
            ], 200);
        }
        else{
            return response()->json([
                'error message' => "Not Found",
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserApi  $userApi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($userApi=UserApi::find($id)){
            $userApi->delete();

            return response()->json([
                'status' => true,
                'message' => "User Deleted successfully!",
            ], 200);
        }
        else{
            return response()->json([
                'error message' => "Not Found",
            ], 400);
        }

    }
}
