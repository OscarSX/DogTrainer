<template>
    <div class="row">
        <spinner v-show="loading"></spinner>
        <div class="col-sm" v-for="dog in dogs">
            <div class="card text-center" style="width: 18rem; margin-top:70px;">
                <img style="height: 150px; width:150px; margin:20px;" class="card-img-top rounded-circle mx-auto display-block" v-bind:src="dog.picture" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ dog.name }}</h5>
                    <p class="card-text">Aqui va la descripcion</p>
                    <!--<a href="/trainers/{{$trainer->id}}" class="btn btn-primary">Ver más...</a>-->
                    <a href="/trainers/" class="btn btn-primary">Ver más...</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import EventBus from '../../event-bus';

    export default {
        data(){
            return{
                dogs: [],
                loading: true
            }
        },
        created(){
            EventBus.$on('dog-added', data =>{
                this.dogs.push(data)
            })
        },
        mounted() {
                axios
                    .get('http://127.0.0.1:8000/dogs')
                    .then((res) => {
                        this.dogs = res.data
                        this.loading = false
                    });
            }
    }
</script>

<style>

</style>
