<template>
 <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">ฟอร์มลงทะเบียน</h2>

        <form @submit.prevent="addEmployees">

          <div class="mb-3">
            <label class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control"
              v-model="form.firstName" placeholder="กรุณากรอกชื่อ-นามสกุล" required>
          </div>

    
          <div class="mb-3">
            <label class="form-label">แผนก</label>
            <input type="text" class="form-control"
              v-model="form.department" placeholder="กรุณากรอกแผนก" required>
          </div>

          <div class="mb-3">
            <label class="form-label">เงินเดือน</label>
            <input type="number" class="form-control"
              v-model="form.salary" placeholder="กรุณากรอกเงินเดือน" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            บันทึก
          </button>

        </form>

        <!-- แสดงผล -->
        <div v-if="message" class="alert mt-3"
             :class="status === 'success' ? 'alert-success' : 'alert-danger'">
          {{ message }}
        </div>

      </div>
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
        department: '',
        salary: '',
        ative: '',
      },
      message: '',
      status: ''
    }
  },
  methods: {
    async addEmployees() {
      try {
        const res = await fetch('http://localhost/68705516.vueproject/php.api/add_employees.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        });

        const result = await res.json();

        this.message = result.message;
        this.status = result.status;

        // เคลียร์ฟอร์ม
        if (result.status === 'success') {
          this.form = {
            firstName: '',
            department: '',
            salary: '',
            active: '',
          };
        }

      } catch (error) {
        this.message = 'เชื่อมต่อ API ไม่สำเร็จ';
        this.status = 'error';
      }
    }
  }
}
</script>