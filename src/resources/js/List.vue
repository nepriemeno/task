<script>
export default {
    data() {
        return {
            searchQuery: '',
            products: [],
        };
    },
    mounted() {
        this.fetchProducts()
    },
    methods: {
        async fetchProducts(searchQuery) {
            const config = searchQuery ? {params: {description: searchQuery}} : {};

            try {
                const response = await axios.get('/api/products', config);
                this.products = response.data;
            } catch (error) {
            }
        },
        async searchProducts() {
            if (this.searchQuery.length > 2) {
                await this.fetchProducts(this.searchQuery);
            }
        },
    },
};
</script>

<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <input
                        type="text"
                        v-model="searchQuery"
                        placeholder="Search products by description"
                        @input="searchProducts"
                        class="form-control search-input"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4" v-for="product in products" :key="product.id">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ product.sku }}</h5>
                            <p class="card-text">{{ product.description }}</p>
                            <router-link :to="`/${product.id}`" class="btn btn-primary">View</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
