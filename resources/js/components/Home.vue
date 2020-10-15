<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="header">
                    <div class="header_h1">
                        <h1>Каталог запчастей</h1>
                    </div>
                    <div class="header_batton">
                        <router-link :to="{name: 'addprice'}">Загрузить прайс</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <CatalogModel @CatalogShow="CatalogShow"></CatalogModel>
            </div>
        </div> 
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div v-if="catalog == 'show'" class="box_table">
                    <table border="1">
                        <tbody>
                            <tr>
                                <th>Артикул</th>
                                <th>Наименование</th>
                                <th>Цена новой детали</th>
                                <th>Цена б/у детали</th>
                            </tr>
                            <tr v-for="(detail, i) in details"
                                :data-id="detail.id"
                                :key="detail.id"
                                v-model="details[i]"
                                v-on:change="OnChangDetail($event,i)">
                                <td width="12%">
                                    <input @input="detail.code = $event.target.value"
                                            type="text"
                                            name="code"
                                            v-bind:value="detail.code"
                                            v-bind:data-id="detail.id">
                                </td>
                                <td>
                                    <input @input="detail.name = $event.target.value"
                                            type="text" name="name"
                                            v-bind:value="detail.name"
                                            v-bind:data-id="detail.id">
                                </td>
                                <td width="12%">
                                    <input @input="detail.price_new = $event.target.value"
                                            type="text"
                                            name="price_new"
                                            v-bind:value="detail.price_new"
                                            v-bind:data-id="detail.id">
                                </td>
                                <td width="12%">
                                    <input @input="detail.price_old = $event.target.value"
                                            type="text"
                                            name="price_old"
                                            v-bind:value="detail.price_old"
                                            v-bind:data-id="detail.id">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CatalogModel from './CatalogModel.vue'

    export default {
        components: {
            'CatalogModel': CatalogModel
          },
        name:"home",
        data() {
            return {
                brand: "",
                model: "",
                catalog: 'hide',
                details: [],
                detail: {
                    code: "",
                    name: "",
                    price_new: "",
                    price_old: ""
                }
            }
        },
        mounted() {
            console.log('Home mounted.');

            var app = this;

            console.log(this.brand);
        },
        methods:{
            CatalogShow(data){
                var app = this;
                this.catalog = 'show';
                this.brand = data.brand;
                this.model = data.model;
                 console.log(data);
                 getDetails(app);
            },
            OnChangDetail:function(e,i){
                //console.log(i);

               // console.log(this.details[i]);
                let id = e.target.dataset.id;
                let data = {
                    code: this.details[i].code,
                    name: this.details[i].name,
                    price_new: this.details[i].price_new,
                    price_old: this.details[i].price_old
                };

                saveDetail(id,data);
            }
        }
    }
    function saveDetail(id,data){
        //console.log(data);
        axios
            .put('/api/v1/details/'+id,data)
            .then(function (resp) {
                  // app.details = resp.data;                  
                    console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);

                });
    }
    function getDetails(app){
        console.log(app.model);

        var id = app.model;

        axios.get('/api/v1/details/' +id)
                .then(function (resp) {
                    console.log(resp.data)
                    app.details = resp.data;
                  
                    //console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load details");
                });
    }
</script>