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
                            <select v-model="selected"
                                    v-on:change="OnChangBrand($event)">
                              <option v-for="brand,i in brands"
                                        v-bind:value="brand.id">
                                {{ brand.name }}
                              </option>
                            </select>
                            <select v-if="modelselect" v-model="selected_m">
                              <option v-for="model,j in models" v-bind:value="model.id">
                                {{ model.name }}
                              </option>
                            </select>
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
                     console.log(resp);
                    app.brands = resp.data;
                  
                    console.log(resp.data);
                    OnChangBrand(this.selected,app);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load companies");
                });
               // this.selected = this.brands[1].name;
            console.log('Home mounted.');
            //console.log(this.selected);
            // OnChangBrand(this.selected,app);
        },
        methods:{
            OnChangBrand:function(e){
               //console.log(this.selected); 
               OnChangBrand(this.selected,app);
            }
         }
    }
        function OnChangBrand(id,app){
            console.log(id);
            getModelId(id,app);
        }
        function getModelId(id,app){
            //var app = this;
            axios
            .get('/api/v1/models/' + id)
                .then(function (resp) {
                    console.log(resp);
                    //app.models = resp.data;
                   app.selected_m = 1;
                    app.modelselect = true;
                  
                    console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load models");
                });
               // this.selected = this.brands[1].name;
            console.log('Get models.');
        }
</script>