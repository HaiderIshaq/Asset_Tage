@extends('superadmin.layout.layout')
@section('content')

<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<div id="app">
  <add-asset :campus-Id="{{$campusId}}"></add-asset>
  </div>
  <script src="{{asset('js/app.js')}}" ></script>
<!-- <link href="{{url('/')}}/radium2.png" rel="icon"> -->
  <!-- <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <!-- <script
        class="jsbin"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
      ></script> -->

 

  <!-- Template Main CSS File -->
<!-- <div class="pagetitle"> -->
      <!-- <h1>Assetaging Site</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Assets</a></li>
          <li class="breadcrumb-item active">Asset Module</li>
        </ol>
      </nav>
    </div>End Page Title -->
<!-- <style>
  label{
    font-weight: 900;
  }
</style> -->
<!-- 
<form id="assetForm" action="{{ route('asset.store', ['campusId' => $campusId]) }}" enctype="multipart/form-data" method="POST">
   @csrf
<div class="container">
      <div class="row">
        <div class="col-md-6">
          <label for="exampleFormControlInput1">Room</label>
          <input type="text" placeholder="Enter Room" id="room" name="room" class="form-control"/>

        </div>
      
        <div class="col-md-6">
          <label for="exampleFormControlInput1">Custodian</label>
          <input type="text" class="form-control" name="custodian"  id="exampleFormControlInput1" placeholder="Enter Custodian">
        </div>
 
      </div>



      <div class="row">
    <div class="col-md-6">
        <label for="exampleFormControlSelect1">FA Category</label>
        
        <select class="form-control"  name="fa_category_code" id="faCategorySelect">
        <option value="">select</option>
            @foreach($data as $item)
                <option value="{{$item->code}}">{{$item->name}}</option>
            @endforeach 
        </select>
    </div>
       
    <div class="col-md-6">
        <label for="exampleFormControlInput1">FA Category Code</label>
        <select id="faCategoryCodeSelect" disabled class="form-control">
        <option value="">select</option>
            @foreach($data as $item)
                <option value="{{$item->code}}">{{$item->code}}</option>
            @endforeach 
        </select>
        <div id="sub-products"></div>
    </div>
</div> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add event listener to the FA Category select element
        $('#faCategorySelect').change(function() {
            // Get the selected option's value (ID)
            const selectedId = $(this).val();

            // Set the corresponding value (ID) in the FA Category Code select element
            $('#faCategoryCodeSelect').val(selectedId);
        });
    });
</script>

      

        <div class="row">
          <div class="col-md-6">
            <label for="">FA Sub Category</label>
  
            <select  name="fa_sub_category_code" class="form-control" id="faSubCategory">

            </select>
          </div>
       
          <div class="col-md-6">
              <label for="exampleFormControlInput1">FA Sub Category Code</label>
            <select disabled class="form-control" name="fa_sub_category_code" id="fASubCategoryCode">
        <option value="">select</option>
              @foreach($meta as $row)
              <option value="{{$row->code}}">{{$row->code}}</option>
 @endforeach
            </select>
            <script>
    $(document).ready(function() {
        // Add event listener to the FA Category select element
        $('#faSubCategory').change(function() {
            // Get the selected option's value (ID)
            const selectedId = $(this).val();

            // Set the corresponding value (ID) in the FA Category Code select element
            $('#fASubCategoryCode').val(selectedId);
        });
    });
</script>
            </div>
          </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea placeholder="Enter Description" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
          

              <div class="row">
              <div class="col-md-6">
                <label for="exampleFormControlInput1">Make/Model</label>
                <input type="text" class="form-control" name="make/model" id="exampleFormControlInput1" placeholder="Enter Make/Model">
              </div>

              <div class="col-md-6">
                <label for="exampleFormControlSelect1">QTY</label>
                <input type="number" class="form-control" name="qty" id="exampleFormControlInput1" placeholder="Enter QTY">
            
          </div>
        </div>
       


<br>       -->
        <!-- <div class="row">
          <div class="col-md-6">

           <h4> <label for="exampleFormControlSelect1">Condition</label></h4> -->
<!-- <style>
  #good{
    margin-right: 20px;
  }
  @media (max-width:786px) {
    #asseti{
margin-top: 20px;
    }
    
  }
  
</style> -->
 <!-- <br><input type="radio" checked name="condition" value="good"> <b id="good">Good</b>  
     <input type="radio" name="condition" value="Useless"> <b id="good">Useless</b>
     <input type="radio" name="condition" value="average"> <b >Average</b>
     
     
      </div>


    <div class="col-md-4">
      <label for="assetImage">Asset Image</label>
      <br><br>
      <input type="file" class="form-control" name="asset_image" id="assetImage" onchange="previewImage(event)" />
    </div>
 
    <div class="row">
    <div class="col-md-4">
      <img id="preview" src="#" alt="Preview Image" style="display: none; width: 150px; height: 200px;"/>
    </div>
    </div>


      

    </div>

       </div>
    </div>

   


        <br>
        <div class="form-group">
      <div class="container">
        <div class="row">
        <div class="col-md-4">
        <button type="button" class="btn btn-primary" onclick="submitAssetForm()"><b>Submit Asset</b></button>
      
          </div>    
        </form>
         
          <div class="col-md-4">
          <button id="completeRoomButton" type="submit" class="btn btn-warning"><b>Room Complete</b></button>

          </div>
          <div class="col-md-4">
          <a href="/superadmin/location" class="btn btn-success"><b>Survey Complete</b></a>

          </div>
        

        </div>
      </div>

            </div>
      
    </div>

  </main>End #main -->


<!-- <script>
   function previewImage(event) {
    var preview = document.getElementById('preview');
    preview.style.display = 'block';

    var reader = new FileReader();
    reader.onload = function () {
      preview.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }

  function submitAssetForm() {
    // Serialize the form data
    $('#room').prop('disabled', false);
    var formData = new FormData($('#assetForm')[0]);

    $.ajax({
      type: 'POST',
      url: $('#assetForm').attr('action'),
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json', // Set the expected response data type (change as per your backend response)
      success: function (response) {
        // Handle the success response (if needed)
        alert('Asset stored successfully');
        clearFormFields();

      },
      error: function (error) {
        // Handle the error response (if needed)
        alert(error);
      },
    });
  }

  // Function to clear form fields except the "room" field
  function clearFormFields() {
  //   $('#assetForm input:not([name="room"])').val('');
  // $('#assetForm textarea:not([name="room"])').val('');
  // $('#assetForm select:not([name="room"])').val('');
  // $('#preview').attr('src', '#'); // Reset the image preview
  // $('#preview').hide();
  // $('#assetForm input[name="room"]').prop('readonly', true); // Hide the image preview element
  $('#assetForm input[name="room"]').prop('disabled', true);

  var temp_c = $('#room').val(); //Select input by id
     $('#assetForm')[0].reset();
     $('#room').val(temp_c);
     $('#preview').attr('src', '').hide().reset();

  }
  $(document).ready(function () {
  // ... Your existing code ...

  // Add an event listener for the "Complete Room" button
  $('#completeRoomButton').on('click', function () {
    // Enable the "room" field
    alert('Room Completed');
    $('#assetForm input[name="room"]').prop('disabled', false);
    $('#room').val('');


  });
});
</script> -->

 <!-- <script> -->
        <!-- // $(document).ready(function () {
        //     $('#faCategorySelect').on('change', function () {
        //         var productId = $(this).val();
        //         if (productId) {
        //             $.ajax({
        //                 url: '/sub-products/' + productId,
        //                 type: 'GET',
        //                 dataType: 'json',
        //                 success: function (data) {
        //                     var subProducts = '';
        //                     data.forEach(function (subProduct) {
        //                         subProducts += subProduct.name + '<br>';
        //                     });
        //                     $('#sub-products').html(subProducts);
        //                 },
        //                 error: function (data) {
        //                     console.log(data.responseText);
        //                 }
        //             });
        //         } else {
        //             $('#sub-products').html('');
        //         }
        //     });
        // });
        $(document).ready(function () {
    $('#faCategorySelect').on('change', function () {
        var productId = $(this).val();
        if (productId) {
            $.ajax({
                url: '/sub-products/' + productId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var subProductsOptions = '<option value="">select</option>'; // Add the default "select" option
                    data.forEach(function (subProduct) {
                        // Append each subProduct as an option to the select element
                        subProductsOptions += '<option value="' + subProduct.code + '">' + subProduct.name + '</option>';
                    });
                    // Replace the options inside the select element with the generated options
                    $('#faSubCategory').html(subProductsOptions);
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });
        } else {
            // If no product is selected, reset the select element options to the default "select" option
            $('#faSubCategory').html('<option value="">select</option>');
        }
    }); -->
<!-- // });

    </script>
  

 <script
        class="jsbin"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
      ></script>
      -->


@endsection