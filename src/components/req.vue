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
                                <router-link to="/admin/tracuu" class="nav-link px-0"> <span class="d-none d-sm-inline text-black">Tra cứu</span></router-link>
                            </li>
                            <li>
                                <router-link to="" class="nav-link px-0"> <span class="d-none d-sm-inline">Yêu cầu</span></router-link>
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
                <select class="custom-select" disabled>
                    <option >Trường</option>
                    <option value="1">Khách hàng</option>
                    <option value="2">Hóa đơn</option>
                    <option selected value="3">Yêu cầu</option>
                </select>
                <input id="tukhoa" v-model="tukhoa" type="text" class="form-control" placeholder="Nhập từ khóa..." aria-label="Username" aria-describedby="input-group-button-right">
                <button @click="find()" type="button" class="btn btn-outline-primary" id="input-group-button-right">Tìm kiếm</button>
            </div>
            <div v-if="this.alert" id="alert" class="alert alert-warning" role="alert">
                <p>Không có kết quả phù hợp với "{{ this.tukhoa}}"</p>
                <button @click="rst_form()" id="add" type="button" name="add" class="btn btn-primary">Thử lại</button>            </div>
            <br>
            <div id="card-ask" class="card">
                <div class="card-header">
                        <span> <strong>XỬ LÝ YÊU CẦU</strong></span>
                </div>
                <select id="status" class="form-select" disabled>
                    <option selected value=""></option>
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đã xử lý</option>
                </select>
                <br>
                <label id="label-ask" for="formControlInput" class="form-label">Mã yêu cầu</label>
                <div id="form-ask" class="form-group">
                    <input id="usr2" class="form-control" hidden>
                    <input class="form-control" id="askID" disabled>
                    <br>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="ask_content" style="height: 100px" disabled></textarea>
                        <label for="floatingTextarea">Nội dung yêu cầu</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <textarea v-model="this.reply" class="form-control" placeholder="Leave a comment here" id="rep_content" style="height: 100px"></textarea>
                        <label for="floatingTextarea">Nội dung xử lý</label>
                    </div>
                    <br>
                    <button type="button" @click="send_reply()" class="btn btn-primary">Xử lý</button>
                </div> 
            </div> 
            <br>
            <button @click="this.show3 = !this.show3" id="showall" class="btn btn-primary">Hiển thị tất cả yêu cầu</button>
            <br>
            <div v-if="show3" class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID yêu cầu</th>
                        <th>User Name</th>
                        <th>Nội dung yêu cầu</th>
                        <th>Trạng thái</th>
                    </tr>
                    <tr v-for="row in req">
                        <td>{{ row.username }}</td>
                        <td>{{ row.reqID }}</td>
                        <td>{{ row.content }}</td>
                        <td>{{ row.status }}</td>
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
    name: 'Yeucau',
    data () {
        return {
            overview: true,
            tracuu: false,
            myfee: 4500,
            tukhoa: '',
            res: '',
            req: '',
            alert: false,
            good: true,
            bad: false,
            enable: true,
            show: false,
            show2: false,
            show3: false,
            option: '',
            reply: '',
            reqid: ''
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
                    option: '3',
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
                        self.show = true;
                        document.getElementById('askID').value = self.res[0].reqID;
                        document.getElementById('ask_content').value = self.res[0].content;
                        document.getElementById('status').value = self.res[0].status;
                        self.reqid = self.res[0].reqID;
                    }
                }).catch(function (error){
                    console.log(error);
                });
            }
        },
        get_req: function() {
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php', {
                action: 'req2',
            }).then(function(response){
                self.req = response.data;
            }).catch(function (error){
                console.log(error);
            });
        },
        send_reply: function() {
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php', {
                action: 'reply',
                content: this.reply,
                id: this.reqid
            }).then(function(response){
                window.alert(response.data);
            }).catch(function (error){
                console.log(error);
            });
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
            this.req = '';
        },
        rst_form () {
            this.enable = true;
            this.alert = false;
        },
    },
    created: function () {
        this.get_req();
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
    width: fit-content;
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

#alert {
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

#form-ask {
    text-align: center;
    margin: 10px;
}

#label {
    padding-left: 10px;
}

#label-ask {
    padding-left: 10px;
    text-align: start;
}

.card {
    border: 1px solid blue;
    border-radius: 10px;
}

button {
    width: fit-content;
}

#showall {
    text-align: start;
}


</style>