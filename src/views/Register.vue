<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">สมัครสมาชิก</h2>
            
            <form @submit.prevent="handleRegister">
              <!-- First Name -->
              <div class="mb-3">
                <label for="firstName" class="form-label">ชื่อ</label>
                <input
                  v-model="firstName"
                  type="text"
                  class="form-control"
                  id="firstName"
                  placeholder="กรุณากรอกชื่อ"
                  required
                />
              </div>

              <!-- Last Name -->
              <div class="mb-3">
                <label for="lastName" class="form-label">นามสกุล</label>
                <input
                  v-model="lastName"
                  type="text"
                  class="form-control"
                  id="lastName"
                  placeholder="กรุณากรอกนามสกุล"
                  required
                />
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input
                  v-model="email"
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="กรุณากรอกอีเมล"
                  required
                />
              </div>

              <!-- Phone -->
              <div class="mb-3">
                <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                <input
                  v-model="phone"
                  type="tel"
                  class="form-control"
                  id="phone"
                  placeholder="กรุณากรอกเบอร์โทรศัพท์"
                />
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input
                  v-model="password"
                  type="password"
                  class="form-control"
                  id="password"
                  placeholder="กรุณากรอกรหัสผ่าน"
                  required
                />
              </div>

              <!-- Confirm Password -->
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">ยืนยันรหัสผ่าน</label>
                <input
                  v-model="confirmPassword"
                  type="password"
                  class="form-control"
                  id="confirmPassword"
                  placeholder="กรุณายืนยันรหัสผ่าน"
                  required
                />
              </div>

              <!-- Register Button -->
              <button type="submit" class="btn btn-primary w-100">
                สมัครสมาชิก
              </button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-3">
              <p>มีบัญชีอยู่แล้ว? <router-link to="/login">เข้าสู่ระบบ</router-link></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const phone = ref('')
const password = ref('')
const confirmPassword = ref('')

const handleRegister = async () => {
  try {
    // ตรวจสอบรหัสผ่าน
    if (password.value !== confirmPassword.value) {
      console.log('รหัสผ่านไม่ตรงกัน')
      return
    }

    // เพิ่มโค้ดเชื่อมต่อกับ API สมัครสมาชิกที่นี่
    console.log('สมัครสมาชิกด้วย:', { 
      firstName: firstName.value, 
      lastName: lastName.value,
      email: email.value, 
      phone: phone.value,
      password: password.value 
    })
    
    // ตัวอย่าง: หลังจากสมัครสมาชิกสำเร็จ ให้ไปที่หน้า login
    router.push('/login')
  } catch (err) {
    console.log('สมัครสมาชิกไม่สำเร็จ')
  }
}
</script>

<style scoped>
.card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

.card-title {
  font-weight: bold;
  color: #333;
}

.btn-primary {
  background-color: #007bff;
  border: none;
}

.btn-primary:hover {
  background-color: #0056b3;
}
</style>
