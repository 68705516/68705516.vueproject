<template>
 <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f07a4b;" data-bs-theme="light">
    <div class="container">
        <a class="navbar-brand" href="/">Shop DD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Product</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Register
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Register</a></li>
                        <li><a class="dropdown-item" href="#">Login</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>

            </ul>

            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>
    </div>
</nav>

  <div class="main-content">
    <router-view/>
  </div>
</template>

<style>
/* ตั้งค่า Font และสีพื้นฐาน */
#app {
  font-family: 'Sarabun', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

/* ปรับระยะห่างเนื้อหาไม่ให้ทับกับ Navbar ที่เป็น fixed-top */
.main-content {
  margin-top: 80px; 
  padding: 20px;
}

/* ตกแต่งสีตัวอักษรของ Navbar */
.navbar-nav .nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500;
  transition: 0.3s;
}

.navbar-nav .nav-link:hover {
  color: #ffffff !important;
  transform: translateY(-2px);
}

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