<script>
export default {
    data() {
        return {
            product: null,
        };
    },
    mounted() {
        this.fetchProduct()
    },
    methods: {
        async fetchProduct() {
            try {
                const response = await axios.get(`/api/products/${this.$route.params.id}`);
                this.product = response.data;
            } catch (error) {
            }
        },
    },
}
</script>

<template>
    <div class="container mt-5">
        <div v-if="product">
            <h1>{{ product.sku }}</h1>
            <p>{{ product.description }}</p>
            <router-link to="/" class="btn btn-secondary">Back to List</router-link>
        </div>
    </div>
</template>
