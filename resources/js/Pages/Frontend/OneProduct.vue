<template>
<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row" v-for="product in dataProduct" :key="product.id" >
            <div class="col-md-5">
                <div class="abt-bg">
                                        <img :src="'/storage/Products/' +
                                            JSON.parse(
                                                product.product_image
                                            )[0]
                                            " alt="Image" />
                                    </div>
            </div>
            <div class="col-md-7" >
                <div class="single-product-content">
                    <h3>{{ product.product_name }}</h3>
                    <p class="single-product-pricing"><span></span> ${{ product.product_price }}</p>
                    <p>{{ product.product_des }}</p>
                    <div class="single-product-form">
                        <form action="index.html">
                            <input type="number" placeholder="0">
                        </form>
                        <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        <p><strong>Categories: </strong>Fruits, Organic</p>
                    </div>
                    <!-- <h4>Share:</h4>
                    <ul class="product-share">
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single product -->

</template>
<script>

import axios from "axios";

export default {
    data() {

        return {
            dataProduct: []
        }

    },
    mounted() {
    const productId = this.$route.query.product_id;
    axios.get(`/api/get-oneProduct?product_id=${productId}`).then((response) => {
        this.dataProduct = response.data;
        console.log(response.data
);
    });
},
}
    </script>
