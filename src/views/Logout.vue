<template>
  <div class="logout">
    <h2>Logout</h2>
    <p>Are you sure you want to logout?</p>
    <button @click="logout">Logout</button>
  </div>
</template>

<script>
export default {
  name: 'Logout',
  methods: {
    logout() {
      // Clear user data from localStorage
      localStorage.removeItem('user');
      localStorage.removeItem('token');
      this.$store.commit('logout');
      // Redirect to home or login page
      this.$router.push('/');
    }
  }
}
</script>

<style scoped>
.logout {
  text-align: center;
  margin-top: 50px;
}
button {
  padding: 10px 20px;
  background-color: #f44336;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
button:hover {
  background-color: #d32f2f;
}
</style>