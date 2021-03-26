import Api from './Api';
export default {

    getCookies() {
        return Api.get('http://127.0.0.1:8000/api/csrf-cookie');
    }
}
