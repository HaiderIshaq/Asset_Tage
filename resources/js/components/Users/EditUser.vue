<template>
   
    <div>
      <h2>Edit User</h2>
      <form @submit.prevent="updateUser">
        <div>
          <label for="name">Name:</label>
          <input type="hidden" v-model="user.userId" required />
          <input type="text" v-model="user.userName" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="user.userEmail" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" v-model="user.userPassword" required />
        </div>
        <div>
          <label for="role">Role:</label>
          <select v-model="user.roleId" required>
            <option value="">select</option>
            <option value="2">Super Admin</option>
            <option value="1">Admin</option>
            <option value="3">surveyor</option>
          </select>
        </div>
        <button type="submit">Update User</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      userId: {
      type:Number,
      required: true,
    },
   userName: {
      type:String,
      required: true,
    },
    userEmail: {
      type:String,
      required: true,
    },
  roleId: {
      type:Number,
      required: true,
    },
},
    data() {
      return {
        user:{
          userName:this.userName,
          userEmail:this.userEmail,
          userPassword:'',
             roleId:this.roleId,
             userId:this.userId

        },
      };
    },
    methods: {
      updateUser() {
        // Send the user data to the Laravel backend using axios or any other HTTP library
        axios
          .post(`/users/updateUser`,this.user)
          .then((response) => {
            // Handle the successful response, e.g., display a success message, update user list, etc.
            alert("User added successfully!");

          })
          .catch((error) => {
            // Handle errors if any
            alert("Error adding user:", error);
          });
      },
 
    },
  };
  </script>
  