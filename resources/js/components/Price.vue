<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box_form">
                    <div class="box_form_title">
                        <h2>Выберите авто</h2>
                    </div>
                    <div class="box_form_content">
                         <form action="">
                            <div class="form_content_box_select">
                               <select v-model="selected"
                                        v-on:change="OnChangBrand($event)">
                                  <option v-for="brand,i in brands"
                                            v-bind:value="brand.id">
                                    {{ brand.name }}
                                  </option>
                                </select>
                                <a href="#" :data-auto="selected" @click="addAuto">Добавить авто</a>
                            </div>
                            <div class="form_content_box_select">
                               <select v-model="selected_m">
                                  <option v-for="model,j in models"
                                            v-bind:value="model.id">
                                    {{ model.name }}
                                  </option>
                                </select>
                                <a href="#" @click="addModel"
                                            :data-model="selected_m">Добавить модель</a> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"addprice",
        data() {
            return {
                selected: "1",
                selected_m: 0,
                modelselect: false,
                brands: [],
                models: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/brands')
                .then(function (resp) {
                     //console.log(resp);
                    app.brands = resp.data;
                  
                    //console.log(resp.data);
                    //getModelId(app.brands[0].id,app);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load companies");
                });
            console.log('Home mounted.');
            //console.log(this.selected);
            getModelId(this.selected,app);
            // OnChangBrand(this.selected,app);
        },
        methods:{
            OnChangBrand(e){
                console.log(e);
               console.log(this.selected); 
               let id = this.selected;
               var app = this;
               axios
                    .get('/api/v1/models/' + id)
                    .then(function (resp) {
                    console.log(resp.data[0].id);
                        app.models = resp.data;
                       app.selected_m = resp.data[0].id;
                       // app.modelselect = true;

                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not load models");
                    });
                   // this.selected = this.brands[1].name;
                console.log('Get models.');
            },
            addAuto(){

            },
            addModel(){

            }
         }
    }
        function getModelId(id,app){
            //var app = this;
            axios
            .get('/api/v1/models/' + id)
                .then(function (resp) {
                    console.log(resp.data[0].id);
                    app.models = resp.data;
                   app.selected_m = resp.data[0].id;
                   // app.modelselect = true;

                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load models");
                });
               // this.selected = this.brands[1].name;
            console.log('Get models.');
        }
</script>