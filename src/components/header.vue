<template>
    <div id="header" class="container-fluid">
        <div class="left">
            <img src="../assets/hcmut.png" alt="logo">
            <div>
                <span>Đại Học Quốc Gia TP Hồ Chí Minh</span>
                <br>
                <span>Trường Đại Học Bách Khoa</span>
                <br>
                <span>Khoa Khoa học và Kỹ Thuật Máy Tính</span>
            </div>
        </div>

        <div class="right">
            <p>Đồng hồ nước thông minh <br> sử dụng công nghệ LoRa</p>
        </div>
        <div class="clear"></div>
    </div>
</template>

<script>
export default {
  name: 'HeaderComponent'
}
</script>

<style scoped>

    #header {
        background-image: url("../assets/background.webp");
        padding: 10px;
    }

    .left {
        float: left;
        padding-left: 80px;
        text-align: center;
        color: darkblue;
        font-weight: 800;
        margin-right: 70px;
    }

    .right {
        padding-top: 30px;
        padding-right: 80px;
        float: right;
        font-size: xx-large;
        font-weight: 800;
        text-align: end;
        color: darkblue;
        justify-items: center;
    }

    .clear {
        clear: both;
    }

    img {
        width: 90px;
        height: 85px;
    }

</style>
