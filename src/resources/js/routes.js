import ViewCourses from './Pages/Components/ViewCourses.vue';
import SettingScript from './Pages/Components/SettingScript.vue'
import SettingWidget from './Pages/Components/SettingWidget.vue'

export const routes = [
    {
        name: 'home',
        path: '/',
        component: ViewCourses
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
