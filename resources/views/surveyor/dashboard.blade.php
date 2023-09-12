@extends('surveyor.layout.layout')

@section('survey')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<button class="btn btn-primary" type='submit'><a style="text-decoration:none; color:black;"href="/surveyor/addAsset">add asset</a></button>



<div class="container">
<div class="table-responsive">
        <table id="assetTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Tag Number</th>
                    <th>Campus</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Image</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>

           $.noConflict();
    jQuery(document).ready(function($) {
            $('#assetTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.assets') }}",
                columns: [
                    { data: 'tag_number', name: 'tag_number' },
                    { data: 'campus', name: 'campus' },
                    { data: 'address', name: 'address' },
                    { data: 'city', name: 'city' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'sub_category_name', name: 'sub_category_name' },
                    {
            data: 'image',
            name: 'image',
            render: function(data, type, full, meta) {
                return '<img src="/'+ data + '" alt="Asset Image" width="100">';
            }
        }
                ]
            });
        });
    </script>


     @endsection
  


