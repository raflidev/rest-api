<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Post',
            'data' => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Masukan judul postingan!',
                'content.required' => 'Masukan isi postingan!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan isi konten yang kosong',
                'data' => $validator->errors()
            ], 400);
        } else {
            $post = Post::create($request->all());

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan berhasil disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Postingan gagal disimpan!',
                ], 400);
            }
        }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Detail postingan!',
                'data' => $post
            ], 200);
        } else
            return response()->json([
                'success' => true,
                'message' => 'Postingan tidak ditemukan!',
                'data' => ''
            ], 404); {
        }
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Masukan judul postingan!',
                'content.required' => 'Masukan isi postingan!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan isi konten yang kosong',
                'data' => $validator->errors()
            ], 400);
        } else {
            $post = Post::whereId($id)->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Postingan berhasil disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Postingan gagal disimpan!',
                ], 500);
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::FindOrFail($id)->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Postingan berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Postingan gagal dihapus!',
            ], 500);
        }
    }
}
