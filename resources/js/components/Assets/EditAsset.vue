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
          <label for="exampleFormControlInput1">Campus</label>
          <select v-model="formData.selectedCampusId" class="form-control">
            <option value="">select</option>
            <option v-for="item in campus" :value="item.id" :key="item.id">{{ item.name }}</option>
          </select>
        </div>

        <div class="col-md-6">
          <label>Campus Code</label>
          <select disabled :value="formData.selectedCampusId" class="form-control">
            <option value="">select</option>
            <option v-for="item in campus" :value="item.id" :key="item.id">{{ item.id }}</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="exampleFormControlInput1">Address</label>
          <label>Campus</label>
          <select disabled :value="formData.selectedCampusId" class="form-control">
            <option value="">select</option>
            <option v-for="item in campus" :value="item.id" :key="item.id">{{ item.address }}</option>
          </select>
        </div>

        <div class="col-md-6">
          <label>City</label>
          <select disabled :value="formData.selectedCampusId" class="form-control">
            <option value="">select</option>
            <option v-for="item in campus" :value="item.id" :key="item.id">{{ item.city }}</option>
          </select>
        </div>
      </div>
        <div class="row">
          <div class="col-md-6">
            <label for="room">Room</label>
            <input type="text" v-model="formData.room" placeholder="Enter Room" id="room" name="room" class="form-control"/>
          </div>
          <div class="col-md-6">
            <label for="custodian">Custodian</label>
            <input type="text" v-model="formData.custodian"  class="form-control" name="custodian" id="custodian" placeholder="Enter Custodian">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="faCategorySelect">FA Category</label>
            <select class="form-control" @change="loadSubProducts" v-model="formData.fa_category_code" id="faCategorySelect">
              <option value="">select</option>
              <option v-for="item in data" :key="item.code" :value="item.code">{{ item.name }}</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="faCategoryCodeSelect">FA Category Code</label>
            <select class="form-control" v-model="formData.fa_category_code" id="faCategoryCodeSelect" disabled>
              <option value="">select</option>
              <option v-for="item in data" :key="item.code" :value="item.code">{{ item.code }}</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="faSubCategory">FA Sub Category</label>
            <select class="form-control" v-model="formData.fa_sub_category_code" id="faSubCategory">
              <option value="">select</option>
              <option v-for="item in meta" :key="item.code" :value="item.code">{{ item.name }}</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="faSubCategoryCode">FA Sub Category Code</label>
            <select class="form-control" v-model="formData.fa_sub_category_code" id="faSubCategoryCode" disabled>
              <option value="">select</option>
              <option v-for="item in meta" :key="item.code" :value="item.code">{{ item.code }}</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea placeholder="Enter Description" v-model="formData.description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="makeModel">Make/Model</label>
            <input type="text" v-model="formData.MakeModel" class="form-control" placeholder="Enter Make/Model">
          </div>
          <div class="col-md-6">
            <label for="qty">QTY</label>
            
            <input type="number" v-model="formData.qty" class="form-control" name="qty" id="qty" placeholder="Enter QTY">
          </div>
        </div>
<br>
        <div class="row">
          <div class="col-md-6">
            <h4><label for="condition">Condition</label></h4>
            <br>
            <input type="radio" v-model="formData.condition" value="good"> <b id="good">Good</b>  
            <input type="radio" v-model="formData.condition" value="Useless"> <b id="good">Useless</b>
            <input type="radio" v-model="formData.condition" value="average"> <b>Average</b>
          </div>
          <div class="col-md-4">
            <label for="assetImage">Asset Image</label>
            <br><br>
            <input type="file" class="form-control" name="asset_image" id="assetImage" @change="previewImage" />
          </div>
          <div class="row">
            <div class="col-md-4">
              <img :src="'/'+this.assetImage" alt="Preview Image" style="width: 150px; height: 200px;" v-if="!imagePreview" />
              <img :src="imagePreview" alt="Preview Image" style="width: 150px; height: 200px;" v-if="imagePreview" /> 
          </div>
          </div>
        </div>
<br><br>
        <div class="row">
          <br>
          <br>
          <div class="col-md-4">
            <button type="submit" class="btn btn-warning"><b>Update Asset</b></button>
          </div>    
          <br>
          <br>
          <div class="col-md-4">
            <button type="button" class="btn btn-success" @click="finalizejob"><b>Finalize Asset</b></button>
          </div>
          <br>
          <br>
          <div class="col-md-4">
            <a class="btn btn-danger" @click="showAlert"><b>Delete</b></a>
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
  assetRoom: {
      type:String,
      required: true,
    },
    assetCustodian: {
      type:String,
      required: true,
    },   
    assetCategorycode: {
      type:Number,
      required: true,
    },   
    assetDescription: {
      type:String,
      required: true,
    }, 
    assetMakemodel: {
      type:String,
      required: true,
    }, 
    assetCondition: {
      type:String,
      required: true,
    },
    assetImage: {
      type:String,
      required: true,
    },  
    assetSubcategorycode: {
      type:Number,
      required: true,
    },  
    assetCampusid: {
      type:Number,
      required: true,
    },
    assetId: {
      type:Number,
      required: true,
    },    imageId: {
      type:Number,
      required: true,
    },
  },
  data() {
    return {
    
      formData: {
        assetId:this.assetId,
        imageId:this.imageId,
        selectedCampusId:this.assetCampusid,
        room:this.assetRoom,
        custodian: this.assetCustodian,
        fa_category_code: this.assetCategorycode,
        fa_sub_category_code:this.assetSubcategorycode,
        description:this.assetDescription,
        MakeModel:this.assetMakemodel,
        qty: 1,
        condition:this.assetCondition, // Default value for radio buttons
        asset_image: null,
      },

      data: [], // Add your data for the first select (FA Category)
      campus: [], // Add your data for the first select (campus)
      meta: [], // Add your data for the second select (FA Sub Category)
      imagePreview: null,
    };
  },
  methods: {
    showAlert(event) {
const confirmed = window.confirm('Are you sure you want to delete this asset?');

if (confirmed) {
  axios.post(`/superadmin/deleteAsset/${this.assetId}`)
    .then(response => {
      window.location.href = `/superadmin/dashboard`;
    })
    .catch(error => {
      alert('Error: ' + error.response.data.message);
    });
} else {
  event.preventDefault();
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
      axios.post('/superadmin/updateAsset',formData)
        .then(response => {
          alert('Asset stored successfully');    
        })
        .catch(error => {
          alert('Error: ' + error.response.data.message);
        });
    },
    finalizejob() {
      axios.post(`/superadmin/finalizeAsset/${this.assetId}`)
    .then(response => {
      window.location.href = `/superadmin/dashboard`;
     
    })
    .catch(error => {
      alert('Error: ' + error.response.data.message);
    });
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

  },  
  mounted() {
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
    // Load initial data for the first select (FA Category)
    axios.get('/faCat')
      .then(response => {
        this.data = response.data;
      })
      .catch(error => {
        console.log('Error: ' + error);
      });
      axios
      .get("/getCampus") // Replace "/api/campusForm" with the correct URL for your Laravel route
      .then(response => {
        this.campus = response.data;
      })
      .catch(error => {
        console.error("Error fetching data:", error);
      });
  },
};
</script>
