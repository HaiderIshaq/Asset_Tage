<template>
    <div>
      <h2>Add New User</h2>
      <form @submit.prevent="addUser">
        <div>
          <label for="name">Name:</label>
          <input type="text" v-model="user.name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="user.email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" v-model="user.password" required />
        </div>
        <div>
          <label for="role">Role:</label>
          <select v-model="user.role_id" required>
            <option value="">select</option>
            <option value="2">Super Admin</option>
            <option value="1">Admin</option>
            <option value="3">surveyor</option>
          </select>
        </div>
        <button type="submit">Add User</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: {
          name: "",
          email: "",
          password: "",
          role_id: "", // Default role is "User"
        },
      };
    },
    methods: {
      addUser() {
        // Send the user data to the Laravel backend using axios or any other HTTP library
        axios
          .post("/superadmin/addUser", this.user)
          .then((response) => {
            // Handle the successful response, e.g., display a success message, update user list, etc.
            alert("User added successfully!");
            this.clearform();
          })
          .catch((error) => {
            // Handle errors if any
            alert("Error adding user:", error);
          });
      },
      clearform(){
        this.user= {
          name: "",
          email: "",
          password: "",
          role_id: "", // Default role is "User"
        };
      },
    },
  };
  </script>
  