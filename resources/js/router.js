import VueRouter from 'vue-router';
import Home from './components/Home';
import Price from './components/Price';

let routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
    	path: '/addprice',
        name: 'addprice',
        component: Price
    }
];

export default new VueRouter({
    routes,
    mode : 'history'
});