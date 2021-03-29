import Api from './Api'

export default {
    register(form) {
        return Api.post('/user/registration', form);
    },
    login(form) {
        return Api.post('/login', form);
    },
    fetchUser() {
        return Api.get('/user');
    }
}
