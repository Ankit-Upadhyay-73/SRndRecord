import Api from './Api'

export default {
    register(form) {
        return Api.post('/api/user/registration', form);
    },
    login(form) {
        return Api.post('/login', form);
    },
    fetchUser() {
        return Api.get('/api/user');
    }
}
