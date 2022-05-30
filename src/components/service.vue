<template>
    <HeaderComponent></HeaderComponent>
    <div class="container-fluid">
        CheckPage
        <FooTer></FooTer>
    </div>
</template>

<script>

import HeaderComponent from './header.vue'
import NavBar from './navbar.vue'
import FooTer from "./footer.vue"

export default {
    name: 'Service',
    components: {
        HeaderComponent,
        NavBar,
        FooTer,
    }
}
</script>

<style scoped>

#left {
    float: left;
}

.clear {
    clear: both;
}

</style>