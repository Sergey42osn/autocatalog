import VueRouter from 'vue-router';
import Home from './components/Home';

let routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    }
];

export default new VueRouter({
    routes,
    mode : 'history'
});