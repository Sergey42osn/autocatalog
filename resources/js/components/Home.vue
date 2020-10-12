<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="box_table">
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
                                    <input @input="detail.code = $event.target.value" type="text" name="code" v-bind:value="detail.code" v-bind:data-id="detail.id" >
                                </td>
                                <td>
                                    <input type="text" name="name" v-bind:value="detail.name">
                                </td>
                                <td width="12%">
                                    <input type="text" name="price_new" v-bind:value="detail.price_new">
                                </td>
                                <td width="12%">
                                    <input type="text" name="price_old" v-bind:value="detail.price_old">
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
    export default {
        name:"home",
        data() {
            return {
                details: [],
                detail: {
                    code: "",
                    name: "",
                    price_new: "",
                    price_old: ""
                },
                code: "",
                    name: "",
                    price_new: "",
                    price_old: ""
            }
        },
        mounted() {
            console.log('Home mounted.')
            var app = this;
            axios.get('/api/v1/details')
                .then(function (resp) {

                    app.details = resp.data;
                  
                    console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load companies");
                });
        },
        methods:{
            OnChangDetail:function(e,i){
                console.log(i);

                console.log(this.details[i]);
                let id = e.target.dataset.id;
               // let ;
              let isSave = confirm("Вы внесли изменения сохронить?");
              if (isSave) {

                saveDetail();
              }
            }
        }
    }
    function saveDetail(){
        //console.log("ok");
        axios
            .put('/api/v1/details/${id}')
            .then(function (resp) {
                  // app.details = resp.data;                  
                    console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);

                });
    }
</script>