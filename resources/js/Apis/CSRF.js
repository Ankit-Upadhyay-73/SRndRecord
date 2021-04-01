import Api from './Api';
export default {

    getCookies() {
        return Api.get('/api/csrf-cookie');
    }
}
