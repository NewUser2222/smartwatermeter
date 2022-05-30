<template>
    <div class="container">
        <nav id="vue">
            <div class="menu-item">
                <a href="/">TRANG CHỦ</a>
            </div>
            <NavMenu title="DỊCH VỤ KHÁCH HÀNG"></NavMenu>
            <div class="menu-item">
                <router-link to=""> <span @click="hoadon()">HÓA ĐƠN ĐIỆN TỬ</span></router-link>
            </div>
            <div class="menu-item">
                <router-link to="">GIỚI THIỆU</router-link>
            </div>
            <div class="menu-item">
                <router-link to="">HỎI ĐÁP</router-link>
            </div>
            <div class="menu-item">
                <router-link to="">LIÊN HỆ</router-link>
            </div>
            <div class="menu-item">
                <router-link to="/login">ĐĂNG NHẬP</router-link>
            </div>
        </nav>
    </div>
</template>

<script>

import NavMenu from './navmenu.vue'

export default {
  name: 'NavBar',
  methods: {
      hoadon () {
          if(localStorage.getItem('user-id') == null) {
              this.$router.push('/login');
          }
      }
  },
  components: {
    NavMenu
  }  
}
</script>

<style>
    nav {
        background-color: blue;
        display: flex;
        align-items: center;
        font-weight: bold;
        font-size: 15px;
        justify-content: center;
        margin: auto;
        margin-top: 15px;
        border-radius: 25px;
        width: fit-content;

    }
    nav .menu-item {
        color: #FFF;
        padding: 10px 11px;
        position: relative;
        text-align: center;
        border-bottom: 5px solid transparent;
        display: flex;
        border-radius: 25px;
        transition: 0.4s;
    }
    nav .menu-item.active,
    nav .menu-item:hover {
        background-color: rgb(14, 14, 206);
        border-bottom-color: rgb(6, 6, 80);
        cursor: pointer;
    }
    nav .menu-item a {
        color: inherit;
        text-decoration: none;
    }
</style>
