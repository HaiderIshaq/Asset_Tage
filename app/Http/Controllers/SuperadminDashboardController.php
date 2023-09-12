<?php

namespace App\Http\Controllers;

use App\User;
use app\campus;
use Illuminate\Http\Request; 
use App\Imports\FaCategoryImport;
use Composer\XdebugHandler\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Symfony\Component\VarDumper\Cloner\Data;

class SuperadminDashboardController extends Controller
{



//Stats Functions
 public function viewstats()
    {
        if (Auth::user()->hasRole('surveyor')) {
            return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
        }
        elseif (Auth::user()->hasRole('admin')){
            return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
        }


        return view('superadmin.stats');
    }







//Users Functions

   
    public function displayUsers()
    {
       
        $data = DB::table('users')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name as role_name')
        ->get();
        return  $data;

    }

    public function viewUsers()
    {
       
      return view('superadmin.Users.users');

    }
      
    public function ViewAddUser(){

return view('superadmin.Users.AddUser');

    }
    public function AddUser(Request $r)
{

$Username = $r->name;
$Useremail = $r->email;
$Userpassword = $r->password;
$roleId = $r->role_id;

$hashed = Hash::make($Userpassword);
    $UserId =    DB::table('users')->insertGetId([
        'name' => $Username,
        'email' => $Useremail,
        'password' => $hashed,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('role_user')->insert([
        'role_id' => $roleId,
        'user_id' => $UserId,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

}
public function EditUser(Request $r,$id){

$user = DB::table('users')
->select('users.name as name','users.email as email','users.id as id', 'role_user.role_id as role_id')
->join('role_user', 'users.id', '=', 'role_user.user_id')
->where('users.id', $id)->get();
return view('superadmin.Users.EditUser',compact('user'));

}
public function updateUser(Request $r){
    $id = $r->input('userId');

    $userName = $r->input('userName');
    $userEmail = $r->input('userEmail');
    $userPassword = $r->input('userPassword');
    $roleId = $r->input('roleId');
$hashed = Hash::make($userPassword);  
    try {
        
      $update = DB::table('users') // Replace 'users' with the name of your users table
        ->where('id', $id)
        ->update([
            'name' => $userName, 
            'email' => $userEmail,
            'password' => $hashed,
        ]);
        DB::table('role_user') // Replace 'users' with the name of your users table
        ->where('user_id', $id)
        ->update([
            'role_id' => $roleId, 
        ]);
        if ( $update ) {
            return response()->json(['message' => 'User deleted successfully'], 200); // 200: OK
        } else {
            return response()->json(['message' => 'User not found'], 404); // 404: Not Found
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'User deletion failed'], 500); // 500: Internal Server Error
    }

}


public function DeleteUser(Request $r,$id)
{
    try {
        
        $deleted = DB::table('users')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully'], 200); // 200: OK
        } else {
            return response()->json(['message' => 'User not found'], 404); // 404: Not Found
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'User deletion failed'], 500); // 500: Internal Server Error
    }
}











//Campus Functions   storeassetModule
 public function viewlocation()
{
    
    $data = DB::table('campuses')->get();
    return view('superadmin.location',['data'=>$data]);
}

public function campusForm(){
    $data = DB::table('campuses')->get();
    return $data;
}

public function storeCampus(Request $r){

     // Process and store campus data here if needed
     $campusId = $r->input('selectedCampusCode');

     return redirect()->route('superadmin.assetModule', ['campusId' => $campusId]);
}




  
  //Excel Import  
    public function uploadcategory(Request $req){

        
    $path = $req->file('category_file')->getRealPath();

    Excel::import(new FaCategoryImport, $path);
    return back()->with('success','Excel Data Imported successfully.');

    }




 
    //Assets Functions
    public function updateAsset(Request $r){
        $id = $r->input('assetId');
        $campusId = $r->input('selectedCampusId');
        $room = $r->input('room');
        $custodian = $r->input('custodian');
        $faCategoryCode = $r->input('fa_category_code');
        $fa_sub_category_code = $r->input('fa_sub_category_code');
        $description = $r->input('description');
        $MakeModel = $r->input('MakeModel');
        $condition = $r->input('condition');
        $imageId = $r->input('imageId');
        $description = $r->input('description');
    
    
        if ($r->hasFile('asset_image')) {
            $image = $r->file('asset_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
        
            // Save the uploaded image without resizing or compressing
            $imagePath = 'uploads/' . $imageName;
            $image->move(public_path('uploads'), $imageName);
        
            // Save the image name or path to the database if needed
            $imageId = DB::table('asset_images')->insertGetId([
                'image' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
         
        $update = DB::table('asset_details') 
        ->where('tag_number', $id)
        ->update([
            'room' => $room,
            'campus_id' => $campusId,
            'custodian' => $custodian,
            'fa_category_code' => $faCategoryCode,
            'fa_sub_category_code' => $fa_sub_category_code,
            'description' => $description,
            'make/model' => $MakeModel,
            'quantity' => 1,
            'condition' => $condition,
            'status' => 2,
            'asset_image_id' => $imageId,
        ]);
        // try {
           
            
    
        //       if ( $update ) {
        //           return response()->json(['message' => 'User deleted successfully'], 200); // 200: OK
        //       } else {
        //           return response()->json(['message' => 'User not found'], 404); // 404: Not Found
        //       }
        //   } catch (\Exception $e) {
        //       return response()->json(['message' => 'User updation failed'], 500); // 500: Internal Server Error
        //   }
      
        
    }
    public function deleteAsset($id){
        try {
                $deleted=DB::table('asset_details')->where('tag_number',$id)->delete();
                if ($deleted) {
                    return redirect('/superadmin/dashboard'); // 200: OK
                } else {
                    return response()->json(['message' => 'User not found'], 404); // 404: Not Found
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'User deletion failed'], 500); // 500: Internal Server Error
            }
        }
        
        
        public function finalizeAsset($id){
        
        $status = 3;
            DB::table('asset_details') 
            ->where('tag_number',$id)
            ->update([
                'status' => $status,
            ]);
        
        }
        
        public function editAssets($id){
        
        
        
                $asset = DB::table('asset_details')
                    ->select(
                        'asset_details.*',
                        'campuses.name AS campus',
                        'campuses.address AS address',
                        'campuses.city AS city',
                        'fa_categories.name AS category_name',
                        'fa_sub_categories.name AS sub_category_name',
                        'asset_images.image AS image',
                        'asset_images.id AS image_id',
                        'asset_details.make/model AS makeModel'
        
                    )
                    ->join('campuses', 'campuses.id', '=', 'asset_details.campus_id')
                    ->join('asset_images', 'asset_images.id', '=', 'asset_details.asset_image_id')
                    ->join('fa_categories', 'fa_categories.code', '=', 'asset_details.fa_category_code')
                    ->join('fa_sub_categories', 'fa_sub_categories.code', '=', 'asset_details.fa_sub_category_code')
                    ->whereColumn('asset_details.fa_category_code', 'fa_sub_categories.fa_category_code')
                    ->where('tag_number',$id)
                    ->orderBy('tag_number','asc')->get();
        
                    return view('superadmin.EditAsset',compact('asset'));
          
        
        }
public function viewassetModule(Request $r)
{
    $campusId = $r->query('selectedCampusCode');

    $data = DB::table('fa_categories')->get();
    $meta = DB::table('fa_sub_categories')->get();
    $assets = [];
    
    return view('superadmin.assetModule', ['data' => $data,'meta' => $meta],compact('campusId','assets'));
}

     public function storeassetModule(Request $request, $campusId)
    {
        if ($request->hasFile('asset_image')) {
            $image = $request->file('asset_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
        
            // Save the uploaded image without resizing or compressing
            $imagePath = 'uploads/' . $imageName;
            $image->move(public_path('uploads'), $imageName);
        
        
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
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        }
     // Return a response to the AJAX request
        return response()->json(['message' => 'Asset details saved successfully']);
    }
    



        
//Dashboard Functions
 public function index()
 {
     if (Auth::user()->hasRole('surveyor')) {
         return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
     }
     elseif (Auth::user()->hasRole('admin')){
         return back()->withErrors(['error' => 'Access denied. You are not authorized to access the admin dashboard.']);
     }
     $countCond = DB::table('asset_details')->where('status',2)->count();
     $countComp = DB::table('asset_details')->where('status',3)->count();
     $countActive = DB::table('asset_details')->where('status',1)->count();
     return view('superadmin.dashboard',compact('countCond','countActive','countComp'));
 }
    public function showDashboard(Request $request)
    {
        $query = DB::table('asset_details')
            ->select(
                'asset_details.*',
                'campuses.name AS campus',
                'campuses.address AS address',
                'campuses.city AS city',
                'fa_categories.name AS category_name',
                'fa_sub_categories.name AS sub_category_name',
                'asset_images.image AS asset_image'
            )
            ->join('campuses', 'campuses.id', '=', 'asset_details.campus_id')
            ->join('asset_images', 'asset_images.id', '=', 'asset_details.asset_image_id')
            ->join('fa_categories', 'fa_categories.code', '=', 'asset_details.fa_category_code')
            ->join('fa_sub_categories', 'fa_sub_categories.code', '=', 'asset_details.fa_sub_category_code')
            ->whereColumn('asset_details.fa_category_code', 'fa_sub_categories.fa_category_code')
            ->orderBy('tag_number','asc');
            
        // Check if the search parameter is present in the request
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('asset_details.tag_number', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.room', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.custodian', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.condition', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.campus_id', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.make/model', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.custodian', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.quantity', 'LIKE', '%' . $search . '%')
                ->orWhere('asset_details.description', 'LIKE', '%' . $search . '%')
                    ->orWhere('campuses.address', 'LIKE', '%' . $search . '%')
                    ->orWhere('campuses.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('campuses.city', 'LIKE', '%' . $search . '%')
                    ->orWhere('fa_categories.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('fa_sub_categories.name', 'LIKE', '%' . $search . '%');
            });
        }
    
        $data = $query->paginate(10);
    
        return response()->json(['data' => $data]);
    }
     
    




         


//Get all other data
    public function getfacategory()
    {
        $data = DB::table('fa_categories')->select('id', 'name', 'code')
        ->orderBy('id','asc')
        ->get(); // Fetch id, name, and code columns
    
        return $data;
    }
    public function getSubcategory($faCategoryCode)
    {
        $data = DB::table('fa_sub_categories')
            ->where('fa_category_code', $faCategoryCode)
       
            ->get();
        return $data;
    }

    public function getLatestTag(){

        $latestRecord = DB::table('asset_details')->latest('tag_number')->first();
        $data = $latestRecord->tag_number;
        return $data;
    }    



    }
