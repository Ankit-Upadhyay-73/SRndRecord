
import Welcome from './resources/js/components/welcome';
import Login from './resources/js/components/Head/login';
import Register from './resources/js/components/Head/register';
import AddSubject from './resources/js/components/Subject/create';
import ListSubject from './resources/js/components/Subject/list';
import AddStudent from './resources/js/components/Student/add';
import ListStudent from './resources/js/components/Student/list';
import createmarksheet from './resources/js/components/Marksheet/createmarksheet';
import logout from './resources/js/components/logout';
import home from './resources/js/components/home';
import profile from './resources/js/components/Head/profile'
export default
    {

        mode: 'history',
        routes: [
            {
                path: '/',
                component: Welcome
            },

            {
                path: '/head/login',
                component: Login
            },

            {
                path: '/head/register',
                component: Register
            },

            {
                path: '/student/create',
                component: AddStudent
            },

            {
                path: '/students',
                component: ListStudent
            },

            {
                path: '/subject/create',
                component: AddSubject
            },

            {
                path: '/subjects',
                component: ListSubject
            },

            {
                path: '/marksheet/create',
                component: createmarksheet
            },

            {
                path: '/home',
                component: home
            },
            {
                path: '/logout',
                component: logout
            },
            {
                path: '/profile',
                component: profile
            }
        ]
    }
