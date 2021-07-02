<template>
    <div>
        <h2 class="text-center">Products List </h2>
         
        <table class="table">
            <thead>
            <tr>
                <th>
                    <router-link :to="{name: 'bulk', params: { selected_products: selectedProducts }}" class="btn btn-success">Bulk Edit</router-link>
                </th>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td><input type="checkbox" id="" :value="product.id" v-model="selectedProducts"></td>
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.qty }}</td>
                <td>{{ product.price }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'history', params: { id: product.id }}" class="btn btn-primary">History</router-link>
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                products: [],
                selectedProducts: []
            }
        },
        created() {
            this.axios
                .get(`${this.$apiUrl}/products/`)
                .then(response => {
                    this.products = response.data;
                });
        },
        methods: {
            deleteProduct(id) { 
                this.axios
                    .delete(`${this.$apiUrl}/product/${id}`)
                    .then(response => {
                        let i = this.products.map(data => data.id).indexOf(id);
                        this.products.splice(i, 1)
                    });
            }
        }
    }
</script>