<template>
    <HeaderComponent></HeaderComponent>
    <div class="container">
        <div class="infor">   
            <p>Xin chào, Khách hàng {{get_usrname()}}</p>
            <button @click="logout" class="form-control btn-primary">Đăng xuất</button>
        </div>
        <div class="clear"></div>
        <div class="row">
            <div :key="reload" class="col">
                <area-chart :colors="['#063970', '#76b3fb']" :data=this.infor  ></area-chart>
            </div>
            <div id="bill" class="col">
                <div class="card">
                    <div class="card-header">
                        <span> <strong>HÓA ĐƠN TẠM THỜI</strong></span>
                    </div>
                    <div class="card-body">
                        <div id="time" class="col md-4">
                            <span>Tính đến &emsp; {{printTime()}} &ensp; {{ formatDate(printDate()) }} </span>
                        </div>
                        <br>
                        <div id="infor" class="col md-2">
                            <h5 class="card-title">Chủ hộ: {{ get_usrname() }}</h5>
                            <h5>Số danh bộ: {{ get_usrid() }}</h5>
                        </div>
                        <br>
                        <table class="table">
                            <tbody>
                                <tr>
                                <td class="fst">Chỉ số đầu:</td>
                                <td> {{ this.chisocu }}</td>
                                </tr>
                                <tr>
                                <td class="fst">Chỉ số cuối:</td>
                                <td> {{ this.chisomoi}} </td>
                                </tr>
                                <tr>
                                <td class="fst">Tổng số tiêu thụ (m3) :</td>
                                <td> {{ this.chisomoi - this.chisocu }}</td>
                                </tr>
                                <tr>
                                <td class="fst">Tổng tiền trước thuế:</td>
                                <td> {{ (this.chisomoi - this.chisocu)*4500 }}</td>
                                </tr>
                                <tr>
                                <td class="fst">Thành tiền (VAT 5%):</td>
                                <td> {{ (this.chisomoi - this.chisocu)*4500* 1.05 }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="payment">
                            <button id="btn" class="form-control btn-primary">Thanh toán</button>
                        </div>                
                    </div>
                    <div class="card-footer text-muted">
                        @copyright
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div id="card" class="card">
            <div class="card-header">
                    <span> <strong>GỬI YÊU CẦU</strong></span>
            </div>
            <label id="label" for="formControlInput" class="form-label">Mã yêu cầu</label>
            <div id="form" class="form-group">
                <input id="usr" class="form-control" hidden>
                <input class="form-control" id="reqID" disabled>
                <br>
                <div class="form-floating">
                    <textarea v-model="this.req_content" class="form-control" placeholder="Leave a comment here" id="req_content" style="height: 100px"></textarea>
                    <label for="floatingTextarea">Nội dung yêu cầu</label>
                </div>
                <br>
                <button @click="this.send_req()" type="button" class="btn btn-primary">Gửi</button>
            </div>
        </div>
        <br>
        <div class="req_tb">
            <button @click="this.rep = !(this.rep)" class="form-control btn btn-primary">Xem các lời yêu cầu</button>
            <table v-if="req" class="table">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div id="card-ask" class="card">
            <div class="card-header">
                    <span> <strong>HỎI ĐÁP THẮC MẮC</strong></span>
            </div>
            <label id="label-ask" for="formControlInput" class="form-label">Mã hỏi đáp</label>
            <div id="form-ask" class="form-group">
                <input id="usr2" class="form-control" hidden>
                <input class="form-control" id="askID" disabled>
                <br>
                <div class="form-floating">
                    <textarea v-model="this.ask_content" class="form-control" placeholder="Leave a comment here" id="ask_content" style="height: 100px"></textarea>
                    <label for="floatingTextarea">Nội dung hỏi đáp</label>
                </div>
                <br>
                <button type="button" @click="send_ask()" class="btn btn-primary">Gửi</button>
            </div> 
        </div>   
    </div>
    <br>
    <FooTer></FooTer>
</template>

<script>
import axios from 'axios'
import { format } from "date-fns"
import HeaderComponent from './header.vue'
import FooTer from '../components/footer.vue'

export default {
    name: 'UserPage',
    data () {
        return {
            req: false,
            date: '',
            time: '',
            res: '',
            totalfee: 0,
            chisomoi: 0,
            chisocu: 0,
            res: '',
            date: '',
            reload: 0,
            infor: [],
            req_id: '',
            ask_id: '',
            req_content: '',
            ask_content: '',
            usr: ''
        }
    },
    computed: {
        hienthi () {
            return (this.totalfee.toFixed(1).replace(/\d(?=(\d{3})+\.)/g, '$&,'))
        }
    },
    methods: {
        forceRerender() {
            this.reload += 1;
            /*setTimeout(function() {
                window.location.reload();
            }, 5000);*/
        },
        logout() 
            {
                localStorage.clear();
                this.$router.push('/login')
        },
        get_usrname(){
            return localStorage.getItem('user-infor');
        },
        get_usrid(){
            return localStorage.getItem('user-id');
        },
        printTime: function () {
            return new Date().toLocaleTimeString();
        },
        printDate: function () {
            return new Date().toLocaleDateString();
        },
        formatDate(strDate) {
        return format(new Date(strDate), "dd/MM/yyyy")
        },
        async getdata () {
            const result = await axios.get('https://io.adafruit.com/api/v2/ManhTran/feeds/smart-water-meter/data?limit=30')
            this.res = result.data;
            let id = localStorage.getItem('user-id').substring(6,7);
            this.res.forEach(element => {
                var tmp = JSON.parse(element.value);
                let ndata = [];
                ndata[0] = tmp.DATE;
                ndata[1] = parseInt(tmp.LIT);
                this.chisomoi = ndata[1];
                if (tmp.ID == id)  this.infor.push(ndata);
            });
            this.forceRerender();
            this.update_data();
        },
        update_data: function(){
            let n_data = '';
            let size = this.infor.length - 1;
            let m3 = (this.infor[size]);
            this.chisocu = 0;//m3[1];
            let tmp = this.res[0].value;
            this.totalfee = (this.chisomoi - this.chisocu)*4500* 1.05;
            if(this.infor.length > 30) this.infor = [];
        },
        fetch_data: function(){
            axios.post('http://192.168.0.101:80/php/index.php',{
                action: 'fetchdata',
            }).then(function(response){
                console.log(response.data);
            }).catch(function (error){
                console.log(error);
            });
        },
        set_usr: function() {
            var tmp = localStorage.getItem('user-id');
            var id = Math.random().toString(36).substring(2, 5) + Math.random().toString(36).substring(2, 5);
            var ask_id = Math.random().toString(36).substring(6, 9) + Math.random().toString(36).substring(6, 9);
            this.usr = tmp;
            document.getElementById("usr").value = tmp;
            document.getElementById("usr2").value = tmp;
            document.getElementById("reqID").value = id;
            this.req_id = id;
            this.ask_id = ask_id;
            document.getElementById("askID").value = ask_id;
        },
        send_req: function(){
            var check = document.getElementById("req_content").value;
            if(check == '') alert ("Vui lòng nhập nội dung yêu cầu");
            else {
                this.rst_form();
                axios.post('http://192.168.0.101:80/php/index.php',{
                    action: 'new_req',
                    usr: this.usr,
                    req_id: this.req_id,
                    req_content: this.req_content,
                }).then(function(response){
                    alert(response.data);
                }).catch(function (error){
                    console.log(error);
                });
            }
        },
        send_ask: function(){
            var check = document.getElementById("ask_content").value;
            if(check == '') alert ("Vui lòng nhập nội dung câu hỏi");
            else {
                this.rst_form();
                axios.post('http://192.168.0.101:80/php/index.php',{
                    action: 'new_req',
                    usr: this.usr,
                    req_id: this.ask_id,
                    req_content: this.ask_content,
                }).then(function(response){
                    alert(response.data);
                }).catch(function (error){
                    console.log(error);
                });
            }
        },
        rst_form: function() {
            document.getElementById("ask_content").value = '';
            document.getElementById("req_content").value = '';
            this.set_usr();
        }
    },

    components: {
        FooTer,
        HeaderComponent,
    },
    mounted () {
        this.getdata();
        this.set_usr();
    },
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

div .row {
    margin-top: 10px;
    margin-bottom: 10px;
}

.card-header {
    text-align: center;
}

#time {
    text-align: center;
    margin-top: 5px;
    margin-bottom: 10px;
}

.card {
    width: inherit;
}

#form {
    text-align: center;
    margin: 10px;
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
}

.card {
    border: 1px solid blue;
    border-radius: 10px;
}

#btn {
    width: fit-content;
}

button {
    width: fit-content;
}

.row {
    text-align: center;
}

.fst {
    text-align: left;
}

</style>