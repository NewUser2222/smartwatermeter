<template>
    <HeaderComponent></HeaderComponent>
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="dropdown pb-4">
                <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">{{get_adname()}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a @click="logout()" class="dropdown-item" href="#">Đăng xuất</a></li>
                </ul>
            </div>
            <hr>
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                            <router-link to="/admin" class="nav-link px-2"><span class="d-none d-sm-inline"><strong>Tổng quan</strong></span></router-link>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline"><strong>Khách hàng</strong></span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <router-link to="" class="nav-link px-0"> <span class="d-none d-sm-inline text-black">Tra cứu</span></router-link>
                            </li>
                            <li>
                                <router-link to="/admin/yeucau" class="nav-link px-0"> <span class="d-none d-sm-inline">Yêu cầu</span></router-link>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline"><strong>Cài đặt</strong></span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col py-3">
            <div v-if="enable" id="search" class="input-group">
                <select v-model="this.option" class="custom-select">
                    <option selected>Trường</option>
                    <option value="1">Khách hàng</option>
                    <option value="2">Hóa đơn</option>
                    <option value="3">Yêu cầu</option>
                </select>
                <input id="tukhoa" v-model="tukhoa" type="text" class="form-control" placeholder="Nhập từ khóa..." aria-label="Username" aria-describedby="input-group-button-right">
                <button @click="find()" type="button" class="btn btn-outline-primary" id="input-group-button-right">Tìm kiếm</button>
            </div>
            <div v-if="this.alert" id="alert" class="alert alert-warning" role="alert">
                <p>Không có kết quả phù hợp với "{{ this.tukhoa}}"</p>
                <button @click="rst()" id="add" type="button" name="add" class="btn btn-primary">Thử lại</button>
                <p>hoặc</p>
                <button id="add" @click="add_enable()" type="button" name="add" class="btn btn-primary">Thêm khách hàng mới</button>
            </div>
            <div v-if="this.alert2" class="alert alert-warning" role="alert">
                <p>Tạo khách hàng mới không thành công""</p>
                <button @click="rst()" id="add" type="button" name="add" class="btn btn-primary">Thử lại</button>
            </div>
            <div v-if="this.alert21" class="alert alert-info" role="alert">
                <p>Tạo khách hàng mới thành công</p>
                <button @click="rst()" id="add" type="button" name="add" class="btn btn-primary">Tiếp tục</button>
            </div>
            <div v-if="new_usr" id="card-add" class="card">
                <div class="card-header">
                        <span> <strong>TẠO KHÁCH HÀNG MỚI</strong></span>
                </div>
                <br>
                <button id="btn_auto" type="button" @click="auto_create()" class="btn btn-secondary">Tạo tài khoản tự động</button>
                <label id="label-add" for="formControlInput" class="form-label">Tên đăng nhập</label>
                <div id="form-add" class="form-group">
                    <input id="usrname" class="form-control">
                    <br>
                    <label id="label_pw" for="pw" class="form-label">Mật khẩu</label>
                    <input id="pw" class="form-control">
                    <br>
                    <button type="button" @click="add_new_usr()" class="btn btn-primary">Tạo</button>
                </div> 
            </div>
            <div v-if="show" class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>User Name</th>
                        <th>Khách hàng</th>
                        <th>Xem</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <tr v-for="row in res">
                        <td>{{ row.username }}</td>
                        <td>{{ row.name }}</td>
                        <td><button type="button" name="view" class="btn btn-success view" @click="deleteData(row.id)">Xem</button></td>
                        <td><button type="button" name="edit" class="btn btn-primary edit" @click="fetchData(row.id)">Sửa</button></td>
                        <td><button type="button" name="delete" class="btn btn-danger delete" @click="deleteData(row.id)">Xóa</button></td>
                    </tr>
                </table>
            </div>
            <div v-if="show2" class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID hóa đơn</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Xem</th>
                        <th>Xóa</th>
                    </tr>
                    <tr v-for="row in res">
                        <td>{{ row.receiptid }}</td>
                        <td>{{ row.amout }}</td>
                        <td>{{ row.status }}</td>
                        <td><button type="button" name="view" class="btn btn-success view" @click="deleteData(row.id)">Xem</button></td>
                        <td><button type="button" name="delete" class="btn btn-danger delete" @click="deleteData(row.id)">Xóa</button></td>
                    </tr>
                </table>
            </div>
            <div v-if="show3" class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID yêu cầu</th>
                        <th>User Name</th>
                        <th>Nội dung yêu cầu</th>
                        <th>Trạng thái</th>
                        <th>Xem</th>
                        <th>Xóa</th>
                    </tr>
                    <tr v-for="row in res">
                        <td>{{ row.username }}</td>
                        <td>{{ row.reqID }}</td>
                        <td>{{ row.content }}</td>
                        <td>{{ row.status }}</td>
                        <td><button type="button" name="view" class="btn btn-success view" @click="deleteData(row.id)">Xem</button></td>
                        <td><button type="button" name="delete" class="btn btn-danger delete" @click="deleteData(row.id)">Xóa</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
    <FooTer></FooTer>    
</template>

<script>

import {ref} from 'vue'
import axios from 'axios'
import HeaderComponent from './header.vue'
import FooTer from '../components/footer.vue'
import UserPage from '../components/user.vue'

export default {
    name: 'Tracuu',
    data () {
        return {
            overview: true,
            tracuu: false,
            myfee: 4500,
            tukhoa: '',
            res: '',
            alert: false,
            good: true,
            bad: false,
            enable: true,
            show: false,
            show2: false,
            show3: false,
            new_usr: false,
            option: '',
            usrname: '',
            pw: '',
            alert2: false,
            alert21: false,
        }
    },
    methods: {
        find: function() {
            if (document.getElementById('tukhoa').value == '') window.alert("Vui lòng nhập từ khóa để tìm kiếm")
            else{
                var self = this;
                axios.post('http://192.168.0.101:80/php/index.php', {
                    action: 'find',
                    keyword: this.tukhoa,
                    option: this.option,
                }).then(function(response){
                    self.res = response.data;
                    if(self.res == null) {
                        self.alert = true;
                        self.enable = false;
                        self.show = false;
                        self.show2 = false;
                        self.show3 = false;
                        }
                    else {
                        self.alert = false;
                        if(self.option == '1')
                            self.show = true;
                        else if(self.option == '2')
                            self.show2 = true;
                        else if(self.option == '3')
                            self.show3 = true;
                    }
                }).catch(function (error){
                    console.log(error);
                });
            }
        },
        logout() 
        {
            localStorage.clear();
            this.$router.push('/login')
        },
        get_adname(){
            return localStorage.getItem('user-infor');
        },
        rst: function() {
            this.enable = true;
            this.alert = false;
            this.alert2 = false;
            this.alert21 = false;
            document.getElementById("tukhoa").value = "";
        },
        add_new_usr: function () {
            if (document.getElementById('usrname').value == '') window.alert("Vui lòng nhập từ khóa để tìm kiếm")
            else{
                var self = this;
                axios.post('http://192.168.0.101:80/php/index.php', {
                    action: 'add_new_usr',
                    usrname: self.usrname,
                    pw: self.pw,
                }).then(function(response){
                    self.res = response.data;
                    if(self.res == "") {
                        self.alert = true;
                        self.enable = false;
                        self.show = false;
                        self.show2 = false;
                        self.show3 = false;
                        self.alert2 = true;
                        }
                    else {
                        self.alert = false;
                        self.new_usr = false;
                        self.alert21 = true;
                    }
                }).catch(function (error){
                    console.log(error);
                });
            }
        },
        auto_create: function() {
            var usrname = Math.random().toString(36).substring(6, 10) + '@' + Math.floor(Math.random() * 100).toString();
            var pw = Math.random().toString(36).substring(6, 9) + Math.random().toString(36).substring(6, 9);
            document.getElementById('usrname').value = usrname;
            document.getElementById('pw').value = pw;
            this.usrname = usrname;
            this.pw = pw;
        },
        add_enable: function() {
            this.new_usr = true;
            this.alert = false;
        }
    },
    components: {
        FooTer,
        HeaderComponent,
        UserPage
    }
}
</script>

<style scoped>

.infor {
    float: right;
}

.clear {
    clear: both;
}

button {
    width: 100px;
    margin: auto;
}

#find {
    width: 50vw;
}

#search {
    padding: 60px;
}

#table {
    padding: 0px 50px 0px 50px;
}

th {
    width: 20vw;
}

.alert {
    width: 40vw;
    text-align: center;
    margin: auto;
}

#add {
    width: 200px;
}

.card-header {
    text-align: center;
}

.card {
    width: inherit;
}

#form-add {
    text-align: center;
    margin: 10px;
}

#label-add {
    padding-left: 10px;
    text-align: start;
}

#btn_auto {
    width: fit-content;
    text-align: start;
}

#label_pw {
    display: block;
    text-align: start;
}

</style>