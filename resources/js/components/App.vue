<template>
    <div class="container">
        <div class="row justify-content-center">
           <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name:"app",
        mounted() {
            console.log('App mounted.')
        }
    }
</script>