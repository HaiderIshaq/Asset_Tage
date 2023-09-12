<template>
    <div>
      <div class="pagetitle">
        <h1>Users Details</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <a href="/superadmin/addUser">Create User</a>
      <table id="usersTable" class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role_name }}</td>
            <td>
              <button class="btn btn-danger" @click="deleteUser(user.id)"><i class="bi bi-trash"></i></button>
            <button class="btn btn-success" @click="editUser(user.id)"><i class="bi bi-pencil-square"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users:[],
        usersId:null
    };
    },
    mounted() {
      this.fetchUsers();
    },
    methods: {
      fetchUsers() {
        axios
          .get("/superadmin/displayUsers")
          .then((response) => {
            this.users = response.data;
          })
          .catch((error) => {
            console.error("Error fetching users:", error);
          });
      },
      editUser(usersId) {
  
        axios
          .get(`/superadmin/editUser/${usersId}`)
          .then((response) => {
            window.location.href = `/superadmin/editUser/${usersId}`;
          })
          .catch((error) => {
            console.error("Error fetching users:", error);
          });
    
 
      },      
      deleteUser(userId) {
        console.log("Deleting user with ID:", userId);
  if (confirm("Are you sure you want to delete this user?")) {
    axios
      .post(`/superadmin/deleteUser/${userId}`)
      .then(() => {
        alert("User deleted successfully!");
        this.fetchUsers(); // Refresh the user list after deletion
      })
      .catch((error) => {
        alert("Error deleting user:", error);
      });
  }
      },
    },
  };
  </script>
  