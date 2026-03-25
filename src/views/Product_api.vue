<template>
  <!-- Container หลัก -->
  <div class="container my-5">
    <div class="row">
      <!-- loading -->
      <div v-if="loading" class="text-center">Loading...</div>

      <!-- error -->
      <div v-else-if="error" class="text-danger text-center">
        {{ error }}
      </div>

      <!-- แสดงสินค้า -->
      <div
        class="col-md-3 mb-4"
        v-for="product in products"
        :key="product.id"
      >
        <div class="card h-100">
          <!-- รูปสินค้า -->
          <img
            :src="product.thumbnail"
            class="card-img-top"
            alt="Product Image"
            style="object-fit: contain; width: 100%; height: 200px"
          />

          <div class="card-body">
            <!-- ชื่อสินค้า -->
            <h5 class="card-title">{{ product.title }}</h5>
          </div>

          <div class="card-footer">
            <!-- ราคา -->
            <small class="text-muted">Price: ${{ product.price }}</small>
            &nbsp;
            <button type="button" class="btn btn-outline-primary">
              Add
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const products = ref([])
const loading = ref(true)
const error = ref(null)

onMounted(async () => {
  try {
    const res = await fetch('https://dummyjson.com/products')
    const data = await res.json()
    products.value = data.products
  } catch (err) {
    error.value = 'โหลดข้อมูลไม่สำเร็จ'
  } finally {
    loading.value = false
  }
})
</script>