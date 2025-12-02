import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_APP_URL + '/api', // VITE_APP_URL は https に設定済み
  timeout: 10000, // 必要に応じてタイムアウト設定
});

export default api;
