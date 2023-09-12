@extends('superadmin.layout.layout')

@section('content')


<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<div id="app">
  <show-user></show-user>
  </div>
  <script src="{{asset('js/app.js')}}" ></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<!-- 
<div class="pagetitle">
    <h1>Users Details</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div>End Page Title -->





<!-- <table id="usersTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
</table> --> 

<!-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var dataTable = $('#usersTable').DataTable({

            ajax: "{{ route('superadmin.displayUsers') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role_name', name: 'role_name' },
            ],
        });

      
    });
</script> -->

@endsection
