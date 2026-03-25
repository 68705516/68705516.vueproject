<template>
  <div class="container mt-5">
    <!-- ตาราง User -->
    <h2 class="mb-3">User List</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.firstName }} {{ user.lastName }}</td>
          <td>{{ user.email }}</td>
        </tr>
      </tbody>
    </table>

    <!-- ตาราง Product -->
    <h2 class="mb-3">Product List</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Category</th>
          <th>Price</th>
          <th>Image</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="item in products" :key="item.id">
          <td>{{ item.id }}</td>
          <td>{{ item.title }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.category }}</td>
          <td>${{ item.price }}</td>
          <td>
            <img
              :src="item.thumbnail"
              alt="Product Image"
              style="width: 80px; height: 80px; object-fit: contain"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const users = ref([])
const products = ref([])

onMounted(async () => {
  try {
    const resUsers = await fetch('https://dummyjson.com/users')
    const dataUsers = await resUsers.json()
    users.value = dataUsers.users

    const resProducts = await fetch('https://dummyjson.com/products')
    const dataProducts = await resProducts.json()
    products.value = dataProducts.products
  } catch (err) {
    console.log('โหลดข้อมูลไม่สำเร็จ')
  }
})
</script>