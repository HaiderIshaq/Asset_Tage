@extends('superadmin.layout.layout')

@section('content')
<link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
<style>

    #pageLinks {
        margin: 10px 0;
    }

    #pageLinks a {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        text-decoration: none;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    #pageLinks a.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    #pageLinks span {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        color: #aaa;
    }
</style>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
        <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Assets <span>| Active</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-activity"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countActive}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Assets <span>| Conducted</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-gear-wide-connected"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countCond}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Assets <span>| Completed</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$countComp}}</h6>

                    </div>
                  </div>

                </div>
              </div>
              </div>
            <!--  End Customers Card -->

            </div>
    </section>
<div class="container">
    <div class="row">
        <div class="col-md-4">
           <a href="/superadmin/location"type="submit"  class='btn btn-success'>Add New Asset</a>
        </div>
        <div class="col-md-4">
          <form action="/uploadcategory" method="POST" enctype="multipart/form-data">
            @csrf
          <input type="file" name="category_file" class="form-control">
           
            
        </div>
      <div class="col-md-4">
      <button type="submit" class="btn btn-success">Upload</button>   
      </div>
      </div>   
      </form>
</div>
<br><br><br>
<div class="container">
    <h1 style="text-align: center;">Asset Details</h1>
    <div class="row">
<div class="col-md-9">
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" id="searchInput">
        </div>
        <div class="col-md-3">
          <button id="searchButton" class="btn btn-success">Search</button>
        </div>
    </form>

    </div>
     <div class="table-responsive">
        <table id="dataTable" class="display table" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tag Number</th>
                    <th scope="col">Campus</th>
                    <th scope="col">Campus Code</th>
                    <th scope="col">Room</th>
                    <th scope="col">Custodian</th>
                    <th scope="col">Description</th>
                    <th scope="col">Make/Model</th>
                    <th scope="col">Condition</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Category</th>
                    <th scope="col">Subcategory</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated dynamically using jQuery -->
            </tbody>
        </table>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Add some navigation buttons or links -->
<!-- Add some navigation buttons or links -->
<!-- Add a container for the page links -->
<div class="col-md-4">
  
</div>
<div class="col-md-4 offset-8">
    <div id="pageLinks"></div>
    <br>
</div>
<div class="row">
    <div class="col-md-3 offset-9">
        <button style="margin-right: 20px;" class="btn btn-primary" id="prevPage">Prev Page</button>
        <button class="btn btn-primary" id="nextPage">Next Page</button>
    </div>
</div>

<!-- Add the table with the ID 'dataTable' here -->
<table id="dataTable" class="display" style="width:100%"></table>

<script>
    $(document).ready(function() {
      $('#searchButton').on('click', function() {
        searchData();
    });
        let dataTable = null;
        let currentPage = 1;
        const perPage = 10; // Number of records to show per page
        const maxPageLinks = 5; // Maximum number of page links to show (excluding first and last page)

        // Function to fetch data from API and populate DataTable
        function populateDataTable(page) {
          const searchValue = $('#searchInput').val();
          
            $.ajax({
                url: `/superadmin/displaydashboard?page=${page}&search=${searchValue}`, // Update the URL to include the page number
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.data) {
                        if (dataTable === null) {
                            dataTable = $('#dataTable').DataTable({
                                data: response.data.data,
                                columns: [
                                    { data: 'tag_number' },
                                    { data: 'campus' }, 
                                    { data: 'campus_id' }, 
                                    { data: 'room' }, 
                                    { data: 'custodian' }, 
                                    { data: 'description' }, 
                                    { data: 'make/model' }, 
                                    { data: 'condition' }, 
                                    { data: 'quantity' }, 
                                    { data: 'address' },
                                    { data: 'city' },
                                    { data: 'category_name' },
                                    { data: 'sub_category_name' },
                                    {
                                        data: 'asset_image',
                                        render: function(data) {
                                            return '<img src="/'+data+'" width="100px">';
                                        }
                                    }
                                ],
                                // Add pagination options
                                paging: false,
                                pageLength: perPage,
                                info: true,
                                dom: 'tip',
                            });
                        } else {
                            dataTable.clear().rows.add(response.data.data).draw(); // Update DataTable with new data
                        }
                    }

                    // Generate page links based on the total number of pages
                    const totalPageCount = Math.ceil(response.data.total / perPage);
                    generatePageLinks(totalPageCount);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
// Add a click event handler to the DataTable rows
$('#dataTable').on('click', 'tr', function() {
        // Get the data of the clicked row
        const data = dataTable.row(this).data();
        if (data) {
            // Navigate to the edit page for the asset using its ID
            window.location.href = '/superadmin/edit/' + data.tag_number;
        }
    });
        // Call the function to populate DataTable with the initial page (1)
        populateDataTable(currentPage);

        // Previous Page button click handler
        $('#prevPage').on('click', function() {
            if (currentPage > 1) {
                currentPage--;
                populateDataTable(currentPage);
            }
        });

        // Next Page button click handler
        $('#nextPage').on('click', function() {
            currentPage++;
            populateDataTable(currentPage);
        });

        // Function to generate page links dynamically
        function generatePageLinks(totalPageCount) {
            const pageLinksContainer = $('#pageLinks');
            pageLinksContainer.empty(); // Clear previous links

            // Always show the first page link
            pageLinksContainer.append(createPageLink(1));

            let startPage = Math.max(currentPage - Math.floor(maxPageLinks / 2), 2);
            const endPage = Math.min(startPage + maxPageLinks - 1, totalPageCount - 1);

            // Show ellipsis if there are more pages on the left
            if (startPage > 2) {
                pageLinksContainer.append('<span>...</span>');
            }

            // Show the links for the pages within the range
            for (let i = startPage; i <= endPage; i++) {
                pageLinksContainer.append(createPageLink(i));
            }

            // Show ellipsis if there are more pages on the right
            if (endPage < totalPageCount - 1) {
                pageLinksContainer.append('<span>...</span>');
            }

            // Always show the last page link
            pageLinksContainer.append(createPageLink(totalPageCount));
        }
        
        function searchData() {
         
        reloadDataTable();
    }
    function reloadDataTable() {
        // Clear the existing DataTable
       
            dataTable.clear().draw();
        

        // Call the function to populate DataTable with the updated search value
        populateDataTable(currentPage);
    }
        // Function to create a single page link
        function createPageLink(pageNumber) {
            return $('<a>', {
                href: '#',
                text: pageNumber,
                class: pageNumber === currentPage ? 'active' : '#',
                click: function() {
                    currentPage = pageNumber;
                    populateDataTable(currentPage);
                    
                }
            });
        }
    });
</script>





     
@endsection