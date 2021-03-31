
import Welcome from './resources/js/components/welcome';
import Actions from './resources/js/components/actions';
import Login from './resources/js/components/Head/login';
import Register from './resources/js/components/Head/register';
import AddSubject from './resources/js/components/Subject/create';
import ListSubject from './resources/js/components/Subject/list';
import AddStudent from './resources/js/components/Student/add';
import ListStudent from './resources/js/components/Student/list';
import createmarksheet from './resources/js/components/Marksheet/createmarksheet';
import LayoutHeader from './resources/js/components/layout-header';
export default {
    'layout-header': LayoutHeader,
    'Actions': Actions,
    'Welcome': Welcome,
    'Login': Login,
    'Register': Register,
    'AddSubject': AddSubject,
    'ListSubject': ListSubject,
    'AddStudent': AddStudent,
    'ListStudent': ListStudent,
    'createmarksheet': createmarksheet,
}
