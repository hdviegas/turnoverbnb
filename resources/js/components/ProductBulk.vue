<template>
    <div>
        <h3 class="text-center">Create Product</h3>       
        <div class="container">             
            <form @submit.prevent=""  v-for="(product, index) in products" :key="product.id">
            <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" v-model="product.id" readonly>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" v-model="product.name">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" v-model.number="product.price">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" v-model="product.qty">
                        </div>                
                    </div>      
                    <div class="col-2"> 
                        <label class="w-100 invisible">Delete</label>
                        <button class="btn btn-danger" @click="removeRow(index)">Delete</button>
                    </div>

            </div>
            </form>            
        <button @click="saveProducts" class="btn btn-primary">Save</button>
        <button @click="addRow" class="btn btn-primary">Add Row</button>
        </div>

    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                products: []
            }
        },
        created() {
            let selected = this.$route.params.selected_products
            if (typeof selected === 'undefined'){
                this.addRow();
            }else{
                this.axios                
                    .get(`${this.$apiUrl}/products/`, {params: {products : this.$route.params.selected_products}})
                    .then(response => {
                        this.products = response.data;
                    });
            }                       
        },
        methods: {
            saveProducts() {
                console.log(this.products);
                this.axios
                    .post(this.$apiUrl + '/products',{products : this.products})
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            },
            addRow(){
                this.products.push({
                    "created_at": null,
                    "deleted_at": null,    
                    "id": null,
                    "name": null,
                    "price": null,
                    "qty": null,
                    "updated_at": null});
            },
            removeRow(i){
                this.products.splice(i, 1);
            }
        }
    }
</script>