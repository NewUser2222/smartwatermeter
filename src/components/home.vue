<template>
  <div class="container-fluid">
    <HeaderComponent></HeaderComponent>
    <NavBar></NavBar>
    <div id="search-receipt">
      <label id="label" for="search-receipt">Tra cứu tiền nước - Chỉ số nước</label>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Số danh bộ..." aria-label="" aria-describedby="basic-addon1">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">Tra cứu</button>
        </div>
      </div>
    </div>
    <div class="news">
      <div class="container">
        <h1>THÔNG TIN CHÍNH</h1>
        <p>Đồng hồ nước thông minh sử dụng công nghệ LoRa giúp người
           dùng có thể truy cập và kiểm tra chỉ số nước mà gia đình sử 
           dụng mọi lúc thông qua WEB UI do nhà cung cấp nước xây dựng</p>
        <p>Người dùng cũng có thể laujw chọn hình thức thanh toán hóa
          đơn nước thông qua hai hình thức trực tuyến/ tại điểm thanh toán</p>
        <p>Ngoài ra nhà cung cấp cũng có thể quản lý hệ thống thông qua WEB UI. 
          Người quản lý có thể truy cập vào cơ sở dữ liệu với quyền cao nhất ngoại
          trừ mật khẩu của người dùng</p>
      </div>
    </div>
    <div class="pay" id="hd-pay">
      <p id="hd-label">HƯỚNG DẪN THANH TOÁN TIỀN NƯỚC</p>
      <div>
        <div id="st-pay">
          <p id="st-name">Thanh toán tại <br> <span>điểm thanh toán</span></p>
        </div>
        <div id="nd-pay">
          <p id="nd-name">Thanh toán <br> <span> trực tuyến</span></p>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="bank">
      <table class="table table-borderless">
        <tbody>
          <tr>
            <th ><img src="../assets/vcb.jpg" alt="vcb"></th>
            <td><img src="../assets/mbbank.jpg" alt="mb"></td>
            <td><img src="../assets/bidv.jpg" alt="bidv"></td>
          </tr>
          <tr>
            <th><img src="../assets/tcbank.png" alt="tcb"></th>
            <td><img src="../assets/ocb.png" alt="ocb"></td>
            <td><img src="../assets/tpbank.jpg" alt="tpb"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <FooTer></FooTer>
  </div>
</template>

<script>

import HeaderComponent from './header.vue'
import NavBar from './navbar.vue'
import FooTer from "./footer.vue"

export default {
  name: 'HomePage',
  components: {
    HeaderComponent,
    NavBar,
    FooTer,
  }
}
</script>

<style scoped>

.container-fluid {
  background-color: beige;
  margin: 0px;
  padding: 0px;
}

#search-receipt {
  width: 40vw;
  margin: auto;
  padding: 20px 0px 20px;
}

label {
  font-size: 18px;
  font-weight: bold;
  color: darkgoldenrod;
}


#hd-pay {
  text-align: center;
}

#hd-label {
  font-size: 300%;
  font-weight: bold;
  color: darkgoldenrod;
}

#st-pay {
  background-color: hsl(221, 93%, 43%);
  position: relative;
  display: inline-block;
  width: 150px;
  height: 150px;
  margin: 10px;
  margin-right: 80px;
  border-radius: 100px;
}

#st-name {
  color: white;
  position: absolute;
  margin-top: 50px;
  margin-left: 12px;
  font-weight: bold;
}

#nd-name {
  color: white;
  position: absolute;
  margin-top: 50px;
  margin-left: 30px;
  font-weight: bold;
}

#nd-pay {
  background-color: hsl(221, 93%, 43%);
  position: relative;
  display: inline-block;
  width: 150px;
  height: 150px;
  margin: 10px;
  margin-left: 80px;
  border-radius: 100px;
}

#st-pay:hover {
  color:  darkgoldenrod;
  background-color: blue;
  cursor: pointer;
  border: 5px solid darkgoldenrod;
}

#nd-pay:hover {
  color:  darkgoldenrod;
  background-color: blue;
  cursor: pointer;
  border: 5px solid darkgoldenrod;
}

.clear {
  clear: both;
}

.news {
  background-image: url(../assets/intro.jpg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  height: 500px;
  text-align: center;
  padding: 20px;
}

img {
  width: 100px;
  height: 50px;
  border-radius: 20px;
  margin: 15px;
}

h1 {
  font-size: 300%;
  font-weight: bold;
  color: darkgoldenrod;
}

.bank {
  text-align: center;
  width: fit-content;
  margin: auto;
}

.pay {
  padding: 20px;
}


</style>
