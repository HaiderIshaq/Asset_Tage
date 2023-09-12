<template>
    <div class="pagetitle">
      <h1>Assetaging Site</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Location</a></li>
          <li class="breadcrumb-item active">Campus</li>
        </ol>
      </nav>
  
      <div class="container">
        <br><br>
        <h2>{{userName}}</h2>
        <br><br>
  
        <div class="row">
          <div class="col-md-6">
            <label for="exampleFormControlInput1">Campus</label>
            <label>Campus</label>
            <select v-model="selectedCampusId" class="form-control">
              <option value="">select</option>
              <option v-for="item in data" :value="item.id" :key="item.id">{{ item.name }}</option>
            </select>
          </div>
  
          <div class="col-md-6">
            <label>Campus Code</label>
            <select disabled :value="selectedCampusId" class="form-control">
              <option value="">select</option>
              <option v-for="item in data" :value="item.id" :key="item.id">{{ item.id }}</option>
            </select>
          </div>
        </div>
  
        <div class="row">
          <div class="col-md-6">
            <label for="exampleFormControlInput1">Address</label>
            <label>Campus</label>
            <select disabled :value="selectedCampusId" class="form-control">
              <option value="">select</option>
              <option v-for="item in data" :value="item.id" :key="item.id">{{ item.address }}</option>
            </select>
          </div>
  
          <div class="col-md-6">
            <label>City</label>
            <select disabled :value="selectedCampusId" class="form-control">
              <option value="">select</option>
              <option v-for="item in data" :value="item.id" :key="item.id">{{ item.city }}</option>
            </select>
          </div>
        </div>
  
        <br>
        <div class="form-group">
          <form @submit.prevent="submitForm">
            <input type="hidden" name="selectedCampusCode" v-model="selectedCampusId">
            <button type="submit" class="btn btn-success"><b>Next</b></button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    props: {
    userName: {
      type: String,
      required: true,
    },
    userRole: {
      type: String,
      required: true,
    },
    
  },
    data() {
      return {
    
        data: [],
        selectedCampusId: "",
      };
    },
    mounted() {
      // Fetch data (Replace this with your data fetching logic)
      this.fetchData();
    },
 methods: {
  
    fetchData() {
      // Use axios to fetch data from the server
      axios
        .get("/getCampus") // Replace "/api/campusForm" with the correct URL for your Laravel route
        .then(response => {
          this.data = response.data.data;
        })
        .catch(error => {
          console.error("Error fetching data:", error);
        });
    },
    submitForm() {
      if(this.userRole){


    // Build the query string with selectedCampusId parameter
    const queryString = new URLSearchParams({
        selectedCampusCode: this.selectedCampusId,
      }).toString();

      // Redirect the user to the route with the query string
      window.location.href = `/surveyor/assetModule?${queryString}`;
      }
      else{
          // Build the query string with selectedCampusId parameter
      const queryString = new URLSearchParams({
        selectedCampusCode: this.selectedCampusId,
      }).toString();

      // Redirect the user to the route with the query string
      window.location.href = `/superadmin/assetModule?${queryString}`;
    
    }}
    }
  };
  </script>
  
  <style>
  label {
    font-weight: 900;
  }
  </style>
  