import VueRouter from 'vue-router';
import bankList from './components/bank/BankList.vue';
import BankCreate from './components/bank/BankCreate.vue';
import BankEdit from './components/bank/BankEdit.vue';

let routes = [
    {

        path: '/',
        component: bankList,
    },
    {path: '/admin/bank/create', component: BankCreate, name: 'BankCreate'},
    {path: '/admin/bank/edit/:id', component: BankEdit, name: 'BankEdit'},

];

export default new VueRouter({
    routes
});
