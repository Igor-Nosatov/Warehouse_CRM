import axios, { AxiosResponse } from 'axios';

function createApiClient() {
  return axios.create({
    baseURL: "http://0.0.0.0/api",
    headers: {
      'Content-Type': 'application/json'
    }
  });
}

const apiClient = createApiClient();

apiClient.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("tokenWarehouseCrm");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    console.error("Request Error:", error);
    return Promise.reject(error);
  }
);
//check token data
apiClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    console.error("Response Error:", error);
    return Promise.reject(error);
  }
);

export interface PaginationParams {
  page?: number;
  limit?: number;
}

export interface SortParams {
  sortBy?: string;
  order?: 'asc' | 'desc';
}

export interface FilterParams {
  [key: string]: string | number | boolean | undefined;
}

export interface QueryParams extends PaginationParams, SortParams, FilterParams {}

export default {
  async get<T>(endpoint: string, params?: QueryParams): Promise<AxiosResponse<T>> {
    return apiClient.get<T>(endpoint, { params });
  },
  async getById<T>(endpoint: string, id: string | number): Promise<AxiosResponse<T>> {
    return apiClient.get<T>(`${endpoint}/${id}`);
  },
  async post<TRequest, TResponse>(endpoint: string, data: TRequest, isMultipart: boolean = false): Promise<AxiosResponse<TResponse>> {
    const headers = isMultipart ? { 'Content-Type': 'multipart/form-data' } : { 'Content-Type': 'application/json' };
    return apiClient.post<TResponse>(endpoint, data, { headers });
  },
  async put<T>(endpoint: string, id: string | number, data: T, isMultipart: boolean = false): Promise<AxiosResponse<T>> {
    const headers = isMultipart ? { 'Content-Type': 'multipart/form-data' } : { 'Content-Type': 'application/json' };
    return apiClient.put<T>(`${endpoint}/${id}`, data, { headers });
  },
  async delete<T>(endpoint: string, id: string | number): Promise<AxiosResponse<T>> {
    return apiClient.delete<T>(`${endpoint}/${id}`);
  }
};
