import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// If you are using Laravel Echo for WebSockets, the configuration 
// usually goes down here as well.