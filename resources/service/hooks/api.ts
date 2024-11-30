import axios from 'axios'
  
export const SLEEP_HOTTEL_API_BASE = 'http://127.0.0.1:8000'

export async function apiRequest<T = any>(
  url: string,
  data
): Promise<{ data?: T; error?: any }> {
  try {
    const response = await axios.request({
      url,
      method: 'GET',
      ...data,
    })
    return { data: response.data }
  } catch (error: any) {
    console.log(
      'apiRequest: ',
      url,
      data,
      error.message ||
        error.response?.data?.message ||
        error.response?.data?.errorMsg ||
        'Error happend'
    )
    return {
      error:
        error.response?.data?.message ||
        error.response?.data?.errorMsg ||
        'Error happend',
    }
  }
}
export async function sleepRequest<T = any>(url: string, data): Promise<T> {
 
  try {
    const response = await axios.request({
      url: SLEEP_HOTTEL_API_BASE + '/' + url,
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json; charset=utf-8',
      },
      method: 'GET',
      ...data,
    })
    console.log('response.data: ', response.data,)
    return response.data
  } catch (error: any) {
    console.log(
      'sleepRequest: ',
      SLEEP_HOTTEL_API_BASE,
      url,
      data,
      error.message ||
        error.response?.data?.message ||
        error.response?.data?.errorMsg ||
        'Error happend'
    )

    throw new Error(
      error.response?.data?.message || error.response?.data?.errorMsg || 'Error happend'
    )
  }
}


