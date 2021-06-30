<template>
    <div>
        <h2 class="text-center">Product History</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="history in product.history" :key="history.id">
                <td>{{ history.created_at }}</td>
                <td>{{ history.qty }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                product: {}
            }
        },
        created() {
            this.axios
                .get(`${this.$apiUrl}/product/${this.$route.params.id}/history`)
                .then(response => {
                    this.product = response.data;
                });
        }
    }
</script>