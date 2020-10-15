<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box_form home_box_form">
                    <div class="box_form_title">
                        <h2>Выберите авто для получения каталога</h2>
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
                            </div>
                            <div class="form_content_box_select">
                               <select v-model="selected_m"
                                        v-on:change="OnChangModel($event)">
                                  <option v-for="model,j in models"
                                            v-bind:value="model.id">
                                    {{ model.name }}
                                  </option>
                                </select>
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
        name: "CatalogModel",
        data() {
            return {
                selected: 1,
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
                   // console.log(resp);
                    alert("Could not load companies");
                });
           // console.log('Home mounted.');
            //console.log(this.selected);
            getModelId(this.selected,app);
            // OnChangBrand(this.selected,app);
        },
        methods:{
            OnChangBrand(e){
               // console.log(e);
              // console.log(this.selected); 
               var id = this.selected;
               var app = this;
            console.log(app.selected_m);

             getModelId(this.selected,app);
              // this.$emit('CatalogShow',data);
                //console.log('Get models.');
            },
            OnChangModel(e){
                //console.log(e);
                //console.log(app.selected_m);
                var data = {
                    brand: this.selected,
                    model: this.selected_m
                };
                console.log(data);
               this.$emit('CatalogShow',data);
            },
             CatalogShow(){
                var data = {
                    brand: this.selected,
                    model: this.selected_m
                };
               console.log(data);
               this.$emit('CatalogShow',data); 
            }
         }
    }
        function getModelId(id,app){
            //var app = this;
            axios
            .get('/api/v1/models/' + id)
                .then(function (resp) {

                    app.models = resp.data;
                   app.selected_m = resp.data[0].id;
                   // app.modelselect = true;
                   // console.log(app.selected);
                     //console.log(app.selected_m);
                     app.CatalogShow();

                })
                .catch(function (resp) {
                   // console.log(resp);
                    alert("Could not load models");
                });
               // this.selected = this.brands[1].name;
            console.log('Get models.');
        }
</script>