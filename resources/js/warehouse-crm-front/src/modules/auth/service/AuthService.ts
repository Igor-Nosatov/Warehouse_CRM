import apiClient from '../../../config/apiService';

interface LoginData {
  email: string;
  password: string;
}

interface LoginResponse {
  token: string;
}

export default class AuthService {
  static async login(data: LoginData): Promise<LoginResponse> {
    console.log(data);
    const response = await apiClient.post<LoginData, LoginResponse>('/login', data);
    console.log(response);
    localStorage.setItem('tokenWarehouseCrm', response.data.data.token);
    localStorage.setItem('userId', response.data.data.userId);
    return response.data;
  }
}
