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
                            <tr v-for="detail,index in details">

                                <td><input type="text" v-bind:value="detail.code"></td>
                                <td>{{ detail.name }}</td>
                                <td>{{ detail.price_new }}</td>
                                <td>{{ detail.website }}</td>
                                <td>{{ detail.price_old }}</td>
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
        data: function () {
            return {
                details: []
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
        }
    }
</script>