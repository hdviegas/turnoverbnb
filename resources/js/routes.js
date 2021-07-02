import ListProducts from './components/ListProducts.vue';
import CreateProduct from './components/CreateProduct.vue';
import EditProduct from './components/EditProduct.vue';
import ProductHistory from './components/ProductHistory.vue';
import ProductBulk from './components/ProductBulk.vue';


export const routes = [{
        name: 'home',
        path: '/',
        component: ListProducts
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct
    },
    {
        name: 'bulk',
        path: '/bulk',
        component: ProductBulk
    },
    {
        name: 'history',
        path: '/history/:id',
        component: ProductHistory
    }
];