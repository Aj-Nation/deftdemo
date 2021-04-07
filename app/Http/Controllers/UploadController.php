<?php

namespace App\Http\Controllers;

use App\Upload;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Response;

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

            if($request->hasfile('user_image'))
            {

               foreach($request->file('user_image') as $image_file)
               {
                    $name  = $image_file->getClientOriginalName();
                    $image = Image::make($image_file);
                    Response::make($image->encode('jpeg'));

                   $form_data = array(
                    'user_name' => $request->user_name,
                    'file_name'  => $name,
                    'user_image' => $image
                   );

                   Upload::create($form_data);

               }
            }
            return redirect()->route('uploads.index')
            ->with('success','Images has been uploaded successfully.');   
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

    /**
     * Fetch Image
     *
     * @param int $image_id
     * @return void
     */
    public function fetch_image($image_id)
    {
        $image = Upload::findOrFail($image_id);

        $image_file = Image::make($image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
