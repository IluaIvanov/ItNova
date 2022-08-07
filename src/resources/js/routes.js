import AllProduct from './Pages/Components/AllPost.vue';
import SettingScript from './Pages/Components/SettingScript.vue'
import SettingWidget from './Pages/Components/SettingWidget.vue'

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllProduct
    },
    {
        name: 'script',
        path: '/settings/script',
        component: SettingScript
    },
    {
        name: 'widget',
        path: '/settings/widget',
        component: SettingWidget
    },
];
