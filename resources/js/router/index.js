import { createRouter, createWebHistory  } from "vue-router";
import Sections from '@/Pages/Frontend/Sections.vue';
import Products from '@/Pages/Frontend/Products.vue';
import Offers from '@/Pages/Frontend/Offers.vue';
import OneProduct from '@/Pages/Frontend/OneProduct.vue';

const routes = [

{
    path:'/sections',
    component:Sections
},
{
    path:'/products',
    component:Products
},
{
    path:'/offers',
    component:Offers
},
{
    path:'/oneProduct',
    component:OneProduct
}
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
