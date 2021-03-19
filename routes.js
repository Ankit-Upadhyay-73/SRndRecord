
import Welcome from './resources/js/components/welcome';
import Login from './resources/js/components/Head/login';
import Register from './resources/js/components/Head/register';
import AddSubject from './resources/js/components/Subject/create';
import ListSubject from './resources/js/components/Subject/list';
import AddStudent from './resources/js/components/Student/add';
import ListStudent from './resources/js/components/Student/list';
import CreateMarksheet from './resources/js/components/Marksheet/create';
import Actions from './resources/js/components/actions';
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
                component: CreateMarksheet
            },

            {
                path: '/actions',
                component: Actions
            },



        ]
    }
