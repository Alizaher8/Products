<template>
    <div class="container pt-5 pb-20" id="section">

        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Our</span> Sections</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae
                        optio.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6" v-for="section in dataSections" :key="section.id">
                <div class="single-latest-news">


                    <a href="#">
                        <router-link :to="{ path: '/products', query: { section_id: section.id } }">

                            <div class="abt-bg">
                                <img :src="'/storage/Sections/' + JSON.parse(section.section_image)[0]" alt="Image" />
                            </div>
                        </router-link>
                    </a>

                    <div class="news-text-box">
                        <h3>{{ section.section_name }}</h3>

                        <p class="excerpt">{{ section.section_des }}</p>
                         </div>
                </div>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {

        return {
            dataSections: []
        }

    },
    mounted() {
        axios.get("/api/get-sections").then((response) => {
            this.dataSections = response.data;
            console.log(response.data);
        });
    }
}
</script>
