<template>
    <footer>
        <div class="infor">
            <p>ĐỒNG HỒ NƯỚC THÔNG MINH SỬ DỤNG LORA <br>
                Địa chỉ: TPHCM, Việt Nam, Trái Đất, Vũ Trụ  <br>
                Email: gop_y@hcmut.edu.vn  <br>
                Website: www.smartwatermeterLoRa.com
            </p>
        </div>
        <div class="copyright">
            <p>@2022 BẢN QUYỀN THUỘC VỀ NHÓM ĐỀ CƯƠNG LUẬN VĂN SMART WATER METER USING LORA TECHNOLOGY</p>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'FooTer'
}
</script>

<style>

footer {
    background-image: url("../assets/background.webp");
    height: max-content;
    margin: 0px;
}

.infor {
    color: blue;
    font-weight: bold;
    text-align: center;
    padding: 25px 0px 10px 0px;
}

.copyright {
    text-align: center;
    width: 100vw;
    border-top: 2px solid white;
    margin: auto;
    float: right;
    font-weight: bold;
    color: black;
    padding-top: 10px;
    background-color: rgb(143,200,255);
}

</style>