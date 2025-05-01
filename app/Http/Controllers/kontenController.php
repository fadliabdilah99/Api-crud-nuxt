<?php

namespace App\Http\Controllers;

use App\Models\konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class kontenController extends Controller
{

    public function index()
    {
        Log::info('index');
        return  konten::all();
    }


    public function show($id)
    {
        Log::info('edit');
        return konten::findOrFail($id);
    }




    public function store(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'konten' => 'required',
            // 'foto' => 'required',
        ]);



        $konten = new konten();
        $konten->user_id = null;
        $konten->konten = $request->konten;


        if ($request->hasfile('foto')) {
            $file = $request->file('foto');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/konten/', $filename);
            $konten->foto = $filename;
        }
        $konten->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function update(Request $request, $id){
        Log::info($request->all());
        $request->validate([
            'konten' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        
        
        $konten = konten::findOrFail($id);
        // Log::info($request->all());
        Log::info($konten);

        
        $konten->user_id = null;
        $konten->konten = $request->konten;
        if ($request->hasfile('foto')) {

            if ($konten->foto) {
                unlink('uploads/konten/' . $konten->foto);
            }

            $file = $request->file('foto');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/konten/', $filename);
            $konten->foto = $filename;
        }
        $konten->save();

        return response()->json(['message' => 'success'], 200);
    }
}
