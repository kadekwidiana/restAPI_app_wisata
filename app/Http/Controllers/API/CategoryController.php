<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategory = Category::all();
        return response()->json($dataCategory);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required'
        ]);

        try {
            $category = Category::create($validatedData);
            if ($category != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category berhasil di buat',
                    'data' => $category
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Category gagal di buat'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // menampilkan data category
            // $category = Category::findOrFail($id);

            // return response()->json([
            //     'success' => true,
            //     'data' => $category
            // ]);

            // menampilkan data category dan post berdasarkan category {id}
            $category = Category::findOrFail($id);
            $posts = Post::where('id_category', $id)->get();

            return response()->json([
                'success' => true,
                'category' => $category->category_name,
                'dataPost' => $posts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
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
        $validatedData = $request->validate([
            'category_name' => 'required'
        ]);

        try {
            $category = Category::findOrFail($id);

            $category->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Category berhasil di edit',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
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
        try {
            $category = Category::findOrFail($id);
            $dataPost = Post::where('id_category', $id)->first();
            if ($dataPost) {
                $dataPost->delete();
                return response()->json([
                    'message' => 'Category ini memiliki beberapa data post'
                ]);
            }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category berhasil di hapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
    }
}
