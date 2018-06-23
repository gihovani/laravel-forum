<template>
    <div id="preloader" v-show="counter > 0">
        <div class="image">
            <img src="/img/preloader.gif" alt="">
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                counter: 0
            }
        },
        mounted() {
            window.axios.interceptors.request.use((config) => {
                this.counter++;
                return config;
            }, (error) => {
                return Promise.reject(error);
            });

            window.axios.interceptors.response.use((config) => {
                this.counter--;
                return config;
            }, (error) => {
                this.counter--;
                return Promise.reject(error);
            });
        }
    }
</script>

<style scoped>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.5);
    }
    #preloader .image {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 128px;
        height: 128px;
        transform: translate(-50%, -50%);
        border: 3px solid #eee;
        background: #fff;
        border-radius: 100%;
        overflow: hidden;
    }
</style>
