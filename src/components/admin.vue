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
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline"><strong>Tổng quan</strong></span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline"><strong>Khách hàng</strong></span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <router-link to="/admin/tracuu" class="nav-link px-0"> <span class="d-none d-sm-inline">Tra cứu</span></router-link>
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
            <div class="row" id="chart">
                <div id="label" class="row py-3">
                   <p><strong>Tổng thu tính theo tháng</strong></p>
                </div>
                <div class="row py-3">
                    <column-chart :colors="['#063970', '#76b3fb']" :data=this.data ></column-chart>
                </div>
            </div>
            <div class="row" id="second">
                <div id="usr" class="col py-3">
                    <div id="usrlabel" class="row py-3">
                        <p><strong>Khách hàng</strong></p>
                    </div>
                    <div id="" class="row py-3">
                        <table class="table">
                            <tr>
                                <th>Username</th>
                                <th>Khách hàng</th>
                            </tr>
                            <tr v-for="row in res">
                                <td>{{ row.username }}</td>
                                <td>{{ row.name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="req" class="col py-3">
                    <div id="reqlabel" class="row py-3">
                        <p><strong>Yêu cầu (chưa xử lý) </strong></p>
                    </div>
                    <div id="" class="row py-3">
                        <table class="table">
                            <tr>
                                <th>Mã yêu cầu</th>
                                <th>Username</th>
                            </tr>
                            <tr v-for="row in req">
                                <td>{{ row.reqID }}</td>
                                <td>{{ row.username }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <FooTer></FooTer>    
</template>

<script>

import axios from 'axios'
import HeaderComponent from './header.vue'
import FooTer from '../components/footer.vue'

export default {
    name: 'AdminPage',
    data () {
        return {
            overview: true,
            tracuu: false,
            data: [
                ["2022/3", 78],
                ["2022/4", 85],
                ["2022/5", 65]
            ],
            res: '',
            req: '',
        }
    },
    methods: {
        logout() 
        {
            localStorage.clear();
            this.$router.push('/login')
        },
        get_adname(){
            return localStorage.getItem('user-infor');
        },
        get_usr: function() {
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php', {
                action: 'usr',
            }).then(function(response){
                self.res = response?.data;
            }).catch(function (error){
                console.log(error);
            });
        },
        get_req: function() {
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php', {
                action: 'req',
            }).then(function(response){
                self.req = response?.data;
            }).catch(function (error){
                console.log(error);
            });
        }
    },
    components: {
        FooTer,
        HeaderComponent
    },
    created: function() {
        this.get_usr();
        this.get_req();
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

#chart {
    border: 1px solid blue;
    margin-bottom: 10px;
}

#label {
    background-color: rgb(202, 202, 209);
    margin: 0px;
}

#usr {
    border: 1px solid blue;
    margin-right: 5px;
}

#req {
    border: 1px solid blue;
    margin-left: 5px;
}

#usrlabel {
    background-color: rgb(202, 202, 209);
}

#reqlabel {
    background-color: rgb(202, 202, 209);
}
</style>