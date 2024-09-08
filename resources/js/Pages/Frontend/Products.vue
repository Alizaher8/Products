<template>
    <div class="container">

        <div class="product-section mt-10 mb-150">
            <div class="container">
                <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Our</span> Products</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae
                        optio.</p>
                </div>
            </div>
        </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 text-center" v-for="product in dataProducts" :key="product.id">
                        <div class="single-product-item">
                            <a href="#">
                                <router-link :to="{
                                    path: '/oneProduct',
                                    query: { product_id: product.id },
                                }">
                                    <div class="abt-bg">
                                        <img :src="'/storage/Products/' +
                                            JSON.parse(
                                                product.product_image
                                            )[0]
                                            " alt="Image" />
                                    </div>
                                </router-link>
                            </a>
                            <h3>{{ product.product_name }}</h3>
                            <p class="product-price"><span></span> {{ product.product_price }}$</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            dataProducts: [],
        };
    },
    mounted() {
        const sectionId = this.$route.query.section_id;
        axios
            .get(`/api/get-products?section_id=${sectionId}`)
            .then((response) => {
                this.dataProducts = response.data;
                console.log(response.data);
            });
    },
};
</script>
