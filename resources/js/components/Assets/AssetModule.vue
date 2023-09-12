<template>
  <div>
    <div class="pagetitle">
      <h1>Assetaging Site</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Assets</a></li>
          <li class="breadcrumb-item active">Asset Module</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container">
      <form @submit.prevent="submitAssetForm" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <br><label for="room">Room</label>
            <input type="text" v-model="formData.room" :disabled="formSubmitted" placeholder="Enter Room" id="room" name="room" class="form-control"/>
          </div>
          <div class="col-md-6">
            <br><label for="custodian">Custodian</label>
            <input type="text" v-model="formData.custodian"  class="form-control" name="custodian" id="custodian" placeholder="Enter Custodian">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <br><label for="faCategorySelect">FA Category</label>
            <select class="form-control" @change="loadSubProducts" v-model="formData.fa_category_code" id="faCategorySelect">
              <option value="">Select</option>
              <option v-for="item in fa" :key="item.code" :value="item.code">{{ item.name }}</option>
            </select>
          </div>
          <div class="col-md-6">
            <br><label for="faCategoryCodeSelect">FA Category Code</label>
            <select class="form-control" v-model="formData.fa_category_code" id="faCategoryCodeSelect" disabled>
              <option value="">Select</option>
              <option v-for="item in fa" :key="item.code" :value="item.code">{{ item.code }}</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <br><label for="faSubCategory">FA Sub Category</label>
            <select class="form-control" v-model="formData.fa_sub_category_code" id="faSubCategory">
              <option value="">Select</option>
              <option v-for="item in meta" :key="item.code" :value="item.code">{{ item.name }}</option>
            </select>
          </div>
          <div class="col-md-6">
            <br><label for="faSubCategoryCode">FA Sub Category Code</label>
            <select class="form-control" v-model="formData.fa_sub_category_code" id="faSubCategoryCode" disabled>
              <option value="">Select</option>
              <option v-for="item in meta" :key="item.code" :value="item.code">{{ item.code }}</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <br><label for="exampleFormControlTextarea1">Description</label>
          <input v-model="formData.campusId" type="hidden"/>
          <textarea placeholder="Enter Description" v-model="formData.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="row">
          <div class="col-md-4  ">
            <br><label for="makeModel">Make/Model</label>
            <input type="text" v-model="formData['make/model']" class="form-control" name="make/model" id="makeModel" placeholder="Enter Make/Model">
          </div>
          <div class="col-md-2">
            <br><label for="qty">Latest Tag Number</label>
            <input type="number" disabled v-model="latestTagnumber" class="form-control" name="tag_number"  placeholder="Enter tagNumber">
          </div>
          <div class="col-md-3">
            <br><label for="qty">Tag Number</label>
            <input type="number" v-model="formData.tag_number" class="form-control" @keyup="sum" name="tag_number"  placeholder="Enter tagNumber">
          </div>
          <div class="col-md-3">
            <br><label for="makeModel">Asset Quantity</label>
            <input type="number" disabled v-model="sum" class="form-control" name="qty" id="qty" placeholder="Enter Quantity">
          </div>
        </div>
<br>
        <div class="row">
          <div class="col-md-6">
            <h4><br><label for="condition">Condition</label></h4>
            <input type="radio" v-model="formData.condition" value="good"> <b id="good">Good</b>  
            <input type="radio" v-model="formData.condition" value="Useless"> <b id="good">Useless</b>
            <input type="radio" v-model="formData.condition" value="average"> <b>Average</b>
          </div>
          <div class="col-md-4">
            <br><label for="assetImage">Asset Image</label>
            <br>
            <input type="file" class="form-control" name="asset_image" id="assetImage" @change="previewImage" />
          </div>
          <div class="row">
            <div class="col-md-4">
              <img :src="imagePreview" alt="Preview Image" style="width: 150px; height: 200px;" v-if="imagePreview" />
            </div>
          </div>
        </div>
<br><br>
        <div class="row">
          <br>
          <br>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><b>Submit Asset</b></button>
          </div>    
          <br>
          <br>
          <div class="col-md-4">
            <button type="button" class="btn btn-warning" @click="completeRoom"><b>Room Complete</b></button>
          </div>
          <br>
          <br>
          <div class="col-md-4">
            <a href="/surveyor/addAsset" class="btn btn-success" @click="showAlert"><b>Survey Complete</b></a>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
   campusId: {
      type:Number,
      required: true,
    },
  },
  data() {
    return {
      latestTagnumber:'',
      formData: {
        room: '',
        custodian: '',
        fa_category_code: '',
        fa_sub_category_code: '',
        description: '',
        tag_number: '',
        campusId: this.campusId,
        'make/model': '',
        condition: 'good', // Default value for radio buttons
        asset_image: null,
      },
      fa:'',
      formSubmitted:false,
      data: [], // Add your data for the first select (FA Category)
      meta: [], // Add your data for the second select (FA Sub Category)
      imagePreview: null,
    };
  },
  computed: {
    sum() {
      return parseFloat(this.formData.tag_number) - parseFloat(this.latestTagnumber); 
    }
  },
  methods: {

    showAlert(event) {
      const confirmed = window.confirm('Are you sure you want to Complete Survey?');
      if (!confirmed) {
        event.preventDefault(); // Cancel the default navigation behavior
      }
    },
    previewImage(event) {
      const file = event.target.files[0];
      this.formData.asset_image = file;
      this.imagePreview = URL.createObjectURL(file);
    },
    submitAssetForm() {
      const formData = new FormData();
      for (const key in this.formData) {
        formData.append(key, this.formData[key]);
      }

      axios.post(`/superadmin/assetModule/${this.campusId}`, formData)
        .then(response => {
          alert('Asset stored successfully');
          this.clearFormFields();
          this.getId();      
        })
        .catch(error => {
          alert('Error: ' + error.response.data.message);
        });
    },
    clearFormFields() {
      this.formData = {
        room: this.formData.room,
        custodian: '',
        fa_category_code: '',
        fa_sub_category_code: '',
        description: '',
        'make/model': '',
        qty: '',
        campusId:this.campusId,
        condition: 'good',
        asset_image: null,
      };
      this.formSubmitted=true
      this.imagePreview = null;
      this.getId()
    },
    completeRoom() {
      this.formData.room = '';
      alert('Room Completed');
      this.formSubmitted=false
    },
    loadSubProducts() {
        if (this.formData.fa_category_code) {
        this.meta = []; // Clear the previous sub-products
        axios
          .get(`/sub-products/${this.formData.fa_category_code}`)
          .then(response => {
            this.meta = response.data;
          })
          .catch(error => {
            console.error(error);
          });
      } else {
        this.meta = [];
      }
    },
    getId(){
      axios.get('/getLatestId')
      .then(response => {
        this.latestTagnumber = response.data;
      })
      .catch(error => {
        console.log('Error: ' + error);
      });
    },
    async getFa(){
    axios.get('/faCat')
      .then(response => {
        this.fa = response.data;
      })
      .catch(error => {
        console.log('Error: ' + error);
      });
  },
  },
 
  mounted() {
    
   this.getFa();
      this.getId();
  },
};
</script>