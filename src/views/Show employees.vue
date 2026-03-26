<template>
  <div class="container mt-5">
    <h2 class="mb-3">Employees List</h2>

    <div v-if="loading" class="alert alert-info">กำลังโหลดข้อมูล...</div>
    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <table v-if="!loading" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Department</th>
          <th>Salary</th>
          <th>Active</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="employee in employees" :key="employee.emp_id">
          <td>{{ employee.emp_id }}</td>
          <td>{{ employee.full_name }}</td>
          <td>{{ employee.department }}</td>
          <td>{{ employee.salary }}</td>
          <td>{{ employee.active ? 'Yes' : 'No' }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const employees = ref([])
const loading = ref(false)
const error = ref('')

onMounted(async () => {
  loading.value = true
  try {
    const res = await fetch('http://localhost/68705516.vueproject/php.api/show_employees.php')
    const data = await res.json()
    
    if (data.error) {
      error.value = data.error
    } else {
      employees.value = data
    }
  } catch (err) {
    error.value = 'ไม่สามารถโหลดข้อมูล: ' + err.message
    console.log(err)
  } finally {
    loading.value = false
  }
})
</script>
