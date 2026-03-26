<template>
  <div class="register-container">
    <div class="register-card">
      <h3 class="register-title">สมัครสมาชิก</h3>
      <form @submit.prevent="addCustomer" class="register-form">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">ชื่อ</label>
            <input
              type="text"
              class="form-control"
              v-model="form.firstName"
              placeholder="กรุณากรอกชื่อ"
              required
            >
          </div>
          <div class="form-group">
            <label class="form-label">นามสกุล</label>
            <input
              type="text"
              class="form-control"
              v-model="form.lastName"
              placeholder="กรุณากรอกนามสกุล"
              required
            >
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">เบอร์โทรศัพท์</label>
          <input
            type="tel"
            class="form-control"
            v-model="form.phone"
            placeholder="กรุณากรอกเบอร์โทรศัพท์ 10 หลัก"
            pattern="[0-9]{10}"
            required
          >
        </div>

        <div class="form-group">
          <label class="form-label">ชื่อผู้ใช้</label>
          <input
            type="text"
            class="form-control"
            v-model="form.username"
            placeholder="กรุณากรอกชื่อผู้ใช้ (3-20 ตัวอักษร)"
            pattern="[a-zA-Z0-9_]{3,20}"
            required
          >
        </div>

        <div class="form-group">
          <label class="form-label">รหัสผ่าน</label>
          <input
            type="password"
            class="form-control"
            v-model="form.password"
            placeholder="กรุณากรอกรหัสผ่าน (อย่างน้อย 6 ตัวอักษร)"
            minlength="6"
            required
          >
        </div>

        <button type="submit" class="btn-register" :disabled="loading">
          <span v-if="loading" class="spinner"></span>
          {{ loading ? 'กำลังสมัครสมาชิก...' : 'สมัครสมาชิก' }}
        </button>
      </form>

      <div v-if="message" class="alert" :class="status === 'success' ? 'alert-success' : 'alert-error'">
        {{ message }}
      </div>

      <div class="login-link">
        <p>มีบัญชีอยู่แล้ว? <router-link to="/login">เข้าสู่ระบบ</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        firstName: '',
        lastName: '',
        phone: '',
        username: '',
        password: ''
      },
      message: '',
      status: '',
      loading: false
    }
  },
  methods: {
    async addCustomer() {
      this.loading = true;
      this.message = '';
      this.status = '';

      try {
        const res = await fetch('http://localhost/68705516.vueproject/php.api/add_customer.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        });

        const result = await res.json();

        this.message = result.message;
        this.status = result.status;

        if (result.status === 'success') {
          // Clear form
          this.form = {
            firstName: '',
            lastName: '',
            phone: '',
            username: '',
            password: ''
          };
          // Redirect to login after 2 seconds
          setTimeout(() => {
            this.$router.push('/login');
          }, 2000);
        }

      } catch (error) {
        this.message = 'เกิดข้อผิดพลาดในการเชื่อมต่อ กรุณาลองใหม่อีกครั้ง';
        this.status = 'error';
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>

<style scoped>
.register-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 20px;
}

.register-card {
  background: white;
  border-radius: 15px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  padding: 40px;
  width: 100%;
  max-width: 500px;
}

.register-title {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
  font-weight: 600;
}

.register-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-label {
  margin-bottom: 8px;
  font-weight: 500;
  color: #555;
}

.form-control {
  padding: 12px 16px;
  border: 2px solid #e1e5e9;
  border-radius: 8px;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

.form-control:focus {
  outline: none;
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.btn-register {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  padding: 14px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-top: 10px;
}

.btn-register:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-register:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.spinner {
  width: 16px;
  height: 16px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top: 2px solid white;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.alert {
  padding: 12px 16px;
  border-radius: 8px;
  margin-top: 20px;
  text-align: center;
}

.alert-success {
  background-color: #efe;
  color: #363;
  border: 1px solid #cfc;
}

.alert-error {
  background-color: #fee;
  color: #c33;
  border: 1px solid #fcc;
}

.login-link {
  text-align: center;
  margin-top: 20px;
  color: #666;
}

.login-link a {
  color: #667eea;
  text-decoration: none;
  font-weight: 500;
}

.login-link a:hover {
  text-decoration: underline;
}

@media (max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr;
  }

  .register-card {
    padding: 30px 20px;
  }
}
</style>