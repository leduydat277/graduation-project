import axios from 'axios'

const SLEEP_HOTTEL_API_BASE = process.env.SLEEP_HOTEL_API_BASE

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
export async function healthieRequest<T = any>(url: string, data): Promise<T> {
  try {
    const response = await axios.request({
      url: SLEEP_HOTTEL_API_BASE + '/' + url,
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json; charset=utf-8',
        Authorization: getAuthorizationHeader(),
      },
      method: 'GET',
      ...data,
    })
    console.log('response.data: ', url, data, response.data)
    return response.data
  } catch (error: any) {
    console.log(
      'healthieRequest: ',
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


