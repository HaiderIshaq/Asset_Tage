@extends('superadmin.layout.layout')






@section('content')
<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<div id="app">
  <edit-asset :asset-Room='{{json_encode($asset[0]->room)}}' :asset-Custodian='{{json_encode($asset[0]->custodian)}}' :asset-Categorycode='{{json_encode($asset[0]->fa_category_code)}}'
 :asset-Description ='{{json_encode($asset[0]->description)}}'  
  :asset-MakeModel ='{{json_encode($asset[0]->makeModel)}}'  :asset-Condition ='{{json_encode($asset[0]->condition)}}'
  :asset-Image ='{{json_encode($asset[0]->image)}}'
  :asset-Subcategorycode ='{{json_encode($asset[0]->fa_sub_category_code)}}':asset-Campusid ='{{json_encode($asset[0]->campus_id)}}'
  :asset-Id ='{{json_encode($asset[0]->tag_number)}}'
  :image-Id ='{{json_encode($asset[0]->image_id)}}'
  
  ></edit-asset>
  </div>
  <script src="{{asset('js/app.js')}}" ></script>
@endsection