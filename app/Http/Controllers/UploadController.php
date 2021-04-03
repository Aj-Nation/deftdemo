<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Upload::all();

        return view('uploads.list', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [

                'file_name' => 'required',
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    
            ]);

            if($request->hasfile('file_name'))
            {
               foreach($request->file('file_name') as $image)
               {
                   $upload = new Upload();
                   $name   = $image->getClientOriginalName();
                   $image->move(public_path().'/images/', $name);  

                   $upload->file_name = $name;
                   $upload->save();

               }
            }
            return redirect()->route('uploads.index')
            ->with('success','Images has been uploaded successfully.');

        } catch (\Exception $ex) {
            return back()->with('errors', $ex->getMessage());
        }
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upload $upload)
    {
        $upload->delete();
  
        return redirect()->route('uploads.index')
                        ->with('success','Image deleted successfully');
    }
}
