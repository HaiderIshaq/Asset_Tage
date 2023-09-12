@extends('superadmin.layout.layout')

@section('content')

<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<div id="app">
  <add-user></add-user>
  </div>
  <script src="{{asset('js/app.js')}}" ></script>

@endsection