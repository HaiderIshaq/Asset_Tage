@extends('superadmin.layout.layout')

@section('content')
<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<div id="app">
  <edit-user :user-Name="{{json_encode($user[0]->name)}}" :user-Email="{{json_encode($user[0]->email)}}" :role-Id="{{json_encode($user[0]->role_id)}}" :user-Id="{{json_encode($user[0]->id)}}"></edit-user>
  </div>
  <script src="{{asset('js/app.js')}}" ></script>
@endsection