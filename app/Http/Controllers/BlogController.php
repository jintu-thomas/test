<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Blog;
use Validator;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasPermissionTo('blog-read'))
        {
            $blog = Blog::all();
            return response()->json(['data'=>$blog],201);
        } else {
            return response()->json(["you dont have permission"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(auth()->user()->hasPermissionTo('blog-create'))
        {
            $validation = Validator::make($request->all(),[
                'title'=>'required|max:200',
                'description'=>'required|max:200',
                'content'=>'required|max:200',
            ]);

            if($validation->fails()) {
                return response()->json($validation->errors(),202);
            }
            
            $data = $request ->all();


            $data['title'] =$request->title;
            $data['description'] = $request->description;
            $data['content'] = $request->content;

            $blog=Blog::create($data);
            
            return response()->json(['data'=>$blog],201);
        } else {

            $response =["message"=>"only Super Admin and Editor can create a blog"];
            // Log::channel('errorlog')->error("only Super Admin and Editor can create a blog");

            
            return $response;
        }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->hasPermissionTo('blog-edit'))
        {
            $blog = Blog::findOrFail($id);
            
            if($request->has('title')) {
                $blog->title = $request->title;
            }
            
            if($request->has('description')) {
                $blog->description = $request->description;
            }
            if($request->has('content')) {
                $blog->content = $request->content;
            }
            if (!$blog->isDirty())
            {
                return response()->json(["error"=>'you need  to specefy a different value to update', 'code'=>422],422);
            }
            $blog->save();
            return response()->json(['data'=>$blog],200);

        } else{
            $response = ["message" => "Supper admin, Sub admin, Editor can update the post"];
            return response($response,200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=Blog::findOrFail($id);
        if(auth()->user()->hasPermissionTo('blog-delete'))
        {
            $blog->delete();
            return response()->json(['data'=>$blog]);
        }else {
            $response = ["message" => "You can not delete the post" ];
            return response($response,200);
        }
    }
}
