<template>
  <nav class="navbar navbar-expand-lg fixed-top navbar-custom" data-bs-theme="light">
    <div class="container">
      <router-link to="/" class="navbar-brand fw-bold">
        <i class="bi bi-shop"></i> Shop DD
      </router-link>
      
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link to="/" class="nav-link" active-class="active">
              Home
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/Product_api" class="nav-link">
              Product
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/Show customer" class="nav-link">
              Customer
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/Show employees" class="nav-link">
              Employees
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/Product_list" class="nav-link">
              Product List
            </router-link>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              Auth
            </a>
            <ul class="dropdown-menu">
              <li>
                <router-link to="/register" class="dropdown-item">Register</router-link>
              </li>
              <li>
                <router-link to="/login" class="dropdown-item">Login</router-link>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <router-link to="/AboutView" class="nav-link">
              About
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/Contract" class="nav-link">
              Contact
            </router-link>
          </li>
        </ul>

        <form class="d-flex" role="search">
          <input
            v-model="searchQuery"
            class="form-control me-2"
            type="search"
            placeholder="Search products..."
            @keyup.enter="handleSearch"
          />
          <button class="btn btn-outline-light" type="button" @click="handleSearch">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>

  <div class="main-content">
    <router-view />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const searchQuery = ref('')

const handleSearch = () => {
  if (searchQuery.value.trim()) {
    console.log('Searching for:', searchQuery.value)
    // Add your search logic here
    searchQuery.value = ''
  }
}
</script>

<style scoped>
/* Navbar Styling */
.navbar-custom {
  background: linear-gradient(135deg, #f07a4b 0%, #e8663a 100%);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  padding: 12px 0;
}

.navbar-brand {
  font-size: 1.5rem;
  color: white !important;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  transform: scale(1.05);
}

/* Navigation Links */
.navbar-nav .nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500;
  transition: all 0.3s ease;
  margin: 0 5px;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: #ffffff !important;
  transform: translateY(-2px);
  text-decoration: underline;
}

/* Dropdown Menu */
.dropdown-menu {
  border: none;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  border-radius: 8px;
}

.dropdown-item:hover {
  background-color: #f07a4b;
  color: white !important;
}

/* Search Form */
.form-control {
  border-radius: 20px;
  border: 2px solid white;
  padding: 8px 16px;
  font-size: 0.9rem;
}

.form-control:focus {
  border-color: #ffffff;
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

.btn-outline-light {
  border-radius: 20px;
  border: 2px solid white;
  padding: 8px 20px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-outline-light:hover {
  background-color: white;
  color: #f07a4b;
}

/* Main Content */
#app {
  font-family: 'Sarabun', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  background-color: #f5f5f5;
}

.main-content {
  margin-top: 80px;
  padding: 20px;
  min-height: calc(100vh - 80px);
}

/* Responsive Design */
@media (max-width: 768px) {
  .main-content {
    margin-top: 70px;
    padding: 15px;
  }

  .navbar-brand {
    font-size: 1.2rem;
  }

  .navbar-nav .nav-link {
    margin: 5px 0;
  }
}
<style>

/* สีของเมนูที่กำลังใช้งานอยู่ (Active) */
.router-link-active {
  color: #fff !important;
  font-weight: bold;
  border-bottom: 2px solid white;
}

.text-orange {
  color: #f07a4b;
  font-weight: bold;
}

.navbar-brand {
  font-size: 1.5rem;
  letter-spacing: 1px;
}
  </style>