<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use DataTables;

class SurveyorDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
        }
        elseif (Auth::user()->hasRole('superadmin')){
            return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
        }
        return view('surveyor.dashboard');
    }








    public function storeCampus(Request $r){

        // Process and store campus data here if needed
        $campusId = $r->input('selectedCampusCode');
   
        return redirect()->route('superadmin.assetModule', ['campusId' => $campusId]);
   }
   

   

   public function viewlocation()
   {
   
       $data = DB::table('campuses')->get();
       return view('surveyor.location',['data'=>$data]);
   }
   



   public function viewassetModule(Request $r)
{
    $campusId = $r->query('selectedCampusCode');
    $data = DB::table('fa_categories')->get();
    $meta = DB::table('fa_sub_categories')->get();
    $assets = [];
    
    return view('surveyor.assetModule', ['data' => $data,'meta' => $meta],compact('campusId','assets'));
}









public function storeassetModule(Request $request, $campusId)
{
    if ($request->hasFile('asset_image')) {
        $image = $request->file('asset_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
    
        // Save the uploaded image without resizing or compressing
        $imagePath = 'uploads/' . $imageName;
        $image->move(public_path('uploads'), $imageName);
    
        // Now, $imagePath contains the path to the uploaded image without compression
    
    
    
        // Save the image name or path to the database if needed
        $imageId = DB::table('asset_images')->insertGetId([
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    $userId = auth()->id();
    $campusId = $request->input('campusId');
    $room = $request->input('room');
    $custodian = $request->input('custodian');
    $faCategoryCode = $request->input('fa_category_code');
    $faSubCategoryCode = $request->input('fa_sub_category_code');
    $description = $request->input('description');
    $makeModel = $request->input('make/model');
    $qty = $request->input('qty');
    $condition = $request->input('condition');
    $tag_number = $request->input('tag_number');
    $latestRecord = DB::table('asset_details')->latest('tag_number')->first();
    $latestId = $latestRecord->tag_number + 1;
    for ($i = $latestId; $i <=$tag_number ; $i++) {
        // Save the data into the database using Query Builder
    DB::table('asset_details')->insert([
        'tag_number' => $i,          
        'room' => $room,
        'campus_id' => $campusId,
        'custodian' => $custodian,
        'fa_category_code' => $faCategoryCode,
        'fa_sub_category_code' => $faSubCategoryCode,
        'description' => $description,
        'make/model' => $makeModel,
        'quantity' => 1,
        'condition' => $condition,
        'status' => 2,
        'asset_image_id' => $imageId,
        'user_id'=> $userId,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    }
 // Return a response to the AJAX request
    return response()->json(['message' => 'Asset details saved successfully']);
}




public function getCampus(){
    $data = DB::table('campuses')->get();
    return response()->json(['data' => $data]);
}




public function getfacategory()
{
    $data = DB::table('fa_categories')->select('id', 'name', 'code')
    ->orderBy('id','asc')
    ->get(); // Fetch id, name, and code columns

    return $data;
}











public function showdata(Request $request)
{
   
    if ($request->ajax()) {
        $data = DB::table('asset_details')
            ->select(
                'asset_details.*',
                'campuses.name AS campus',
                'campuses.address AS address',
                'campuses.city AS city',
                'fa_categories.name AS category_name',
                'fa_sub_categories.name AS sub_category_name',
                'asset_images.image AS image'
            )
            ->join('campuses', 'campuses.id', '=', 'asset_details.campus_id')
            ->join('asset_images', 'asset_images.id', '=', 'asset_details.asset_image_id')
            ->join('fa_categories', 'fa_categories.code', '=', 'asset_details.fa_category_code')
            ->join('fa_sub_categories', 'fa_sub_categories.code', '=', 'asset_details.fa_sub_category_code')
            ->whereColumn('asset_details.fa_category_code', 'fa_sub_categories.fa_category_code')
            ->orderBy('tag_number', 'asc')
            ->where('user_id', auth()->id())
            ->get();

        return DataTables::of($data)->make(true);
    }

    return abort(403, 'Unauthorized');
}

        }

