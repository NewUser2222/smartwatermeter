<template>
    <div class="container-fluid">
        <div class="head">
            <router-link to="/">Trang chủ</router-link>
        </div>
        <div class="clear"></div>
        <br>
        <form class="login">
            <div class="form-group">
                <label class="form" for="formGroupExampleInput">Mã danh bộ</label>
                <input type="text" v-model="username" class="form-control" id="usr" placeholder="Mã danh bộ...">
            </div>
            <div class="form-group">
                <label class="form" for="formGroupExampleInput2">Mật khẩu</label>
                <input type="password" v-model="pass" class="form-control" id="pass" placeholder="Mật khẩu...">
            </div>
            <p>Quên mật khẩu?</p>
            <div class="form-check">
                <input class="form-check-input" @click="auth_user()" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Tôi không phải người máy.
                </label>
            </div>
            <button @click="login()" class="form-control btn-primary">Đăng nhập</button>
        </form>
        <div class="foot"></div>
    </div>
    <FooTer></FooTer>
</template>

<script>

import axios from 'axios'
import FooTer from '../components/footer.vue'

export default {
    name: 'LoginPage',
    data() {
        return {
            errors: [],
            username:'',
            pass:'',
            name: '',
            usrcheck: '',
            passcheck: '',
            role: ''
        }
    },
    methods: {
        auth_user: function() {
            if(document.getElementById('usr').value == '') {
                if(document.getElementById('pass').value == '') window.alert('Vui lòng nhập mã danh bộ và mật khẩu');
                else window.alert('Vui lòng nhập mã danh bộ');
                document.getElementById("defaultCheck1").checked = false;
            } 
            else if(document.getElementById('pass').value == '') {
                document.getElementById("defaultCheck1").checked = false;
                window.alert('Vui lòng nhập mật khẩu');
            }
            this.get_user();
            this.get_role();
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php',{
                action: 'auth_user',
                data: this.username,
                pass: this.pass
            }).then(function(response){
                self.passcheck = response?.data;
            })
        },
        get_user: function() {
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php', {
                action: 'get_user',
                data: this.username,
                pass: this.pass
            }).then(function(response){
                self.name = response?.data;
                console.log(self.name);
            })
        },
        get_role: function() {
            var self = this;
            axios.post('http://192.168.0.101:80/php/index.php', {
                action: 'get_role',
                data: this.username,
                pass: this.pass
            }).then(function(response){
                self.role = response?.data;
                console.log(self.role); 
            })
        },
        login () {
            if (this.passcheck == 'GOOD')
            {
                localStorage.setItem("user-infor", this.name);
                localStorage.setItem("user-id", this.username);
                if (this.role == '1') this.$router.push('/user');
                else if (this.role == '0') this.$router.push('/admin');
            }
            else if(document.getElementById('usr').value == '') {
                if(document.getElementById('pass').value == '') {
                    window.alert('Vui lòng nhập mã danh bộ và mật khẩu');
                    return false;
                }
                else {
                    window.alert('Vui lòng nhập mã danh bộ');
                    return false;
                }
            } 
            else if(document.getElementById('pass').value == '') {
                window.alert('Vui lòng nhập mật khẩu');
                return false;
            }
            else {
                window.alert('Thông tin đăng nhập không chính xác...');
                return false;
            }
        },
    },
    components: {
        FooTer
    },
}
</script>

<style scoped>

.form {
    font-size: 20px;
    font-weight: bold;
    color: blue;
}

.login {
    border: 2px solid blue;
    border-radius: 20px;
    padding: 20px;
    width: 400px;
    margin: auto;
}

p {
    margin-top: 5px;
    text-align: end;
}

.head {
    width: fit-content;
    display: inline-block;
    float: right;
    margin: 10px;
}
.foot {
    height: 45vh;
}

.container-fluid {
    height: 100%;
    background-image: url("../assets/background.webp");
    padding: 0px;
}

.clear {
    clear: both;
}

</style>