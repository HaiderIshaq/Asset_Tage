@extends('surveyor.layout.layout')


@section('survey')



<div id="app">
  <add-Campus :user-name="{{ json_encode(auth()->user()->name) }}" user-role="{{ json_encode(auth()->user()->role) }}"></add-Campus>
  </div>
  <script src="{{asset('js/app.js')}}" ></script>



<!-- <div class="pagetitle"> -->
      <!-- <h1>Assetaging Site</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Location</a></li>
          <li class="breadcrumb-item active">Campus</li>
        </ol>
      </nav>
    </div>End Page Title -->

<!-- <style>
  label{
    font-weight: 900;
  }
</style>

      <div class="container">
<br><br>
<h2>
{{ Auth::user()->name }}
</h2>
<br><br>


      <div class="row">

          <div class="col-md-6">
          <label for="exampleFormControlInput1">Campus</label>
            <label>Campus</label>
          <select id="campusName" class="form-control" >
          <option value="">select</option>
            @foreach($data as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
       
          </select>
      </div>

      <div class="col-md-6">
          <label>Campus Code</label>
          <select disabled id="campusCode" name="campusCode" class="form-control" >
          <option value="">select</option>
          @foreach($data as $item)
            <option value="{{$item->id}}">{{$item->id}}</option>
            @endforeach
          </select>
          </div>
      </div>
      <div class="row">

<div class="col-md-6">
<label for="exampleFormControlInput1">Address</label>
  <label>Campus</label>
<select disabled id="campusaddress" class="form-control" >
<option value="">select</option>
  @foreach($data as $item)
  <option value="{{$item->id}}">{{$item->address}}</option>
  @endforeach

</select>
</div>

      <div class="col-md-6">
<label>City</label>

<select disabled id="campuscity" class="form-control" >
<option value="">select</option>
@foreach($data as $item)
  <option value="{{$item->id}}">{{$item->city}}</option>
  @endforeach
</select>
</div>
</div>

      
   
      
      <script>
    $(document).ready(function() {
        // Add event listener to the FA Category select element
        $('#campusName').change(function() {
            // Get the selected option's value (ID)
            const selectedId = $(this).val();

            // Set the corresponding value (ID) in the FA Category Code select element
            $('#campusCode').val(selectedId);
            $('#campuscity').val(selectedId);
            $('#campusaddress').val(selectedId);
            $('#selectedCampusCode').val(selectedId);

        });
    });
</script>
    

      <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

   
        <br>
        <div class="form-group">
        <form action="{{route('campus.store')}}" method="Post">
          @csrf
<!-- <input hidden id="selectedCampusCode" name="selectedCampusCode" value="">
<button type="submit" class="btn btn-success"><b>Next</b></button>
</form> --> 
         
            <!-- </div>
    </div>
  </div> -->









@endsection