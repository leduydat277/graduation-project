import { useEffect, useState } from 'react'
export const usePromise = <T = any>(promiseFn: any, params: any[] = []) => {
  const [state, setState] = useState<{ data: T | null; error: any }>({ data: null, error: null })
  const [loading, setLoading] = useState<boolean>(false)

  const refresh = async () => {
    if (!promiseFn) return
    setLoading(true)
    let data = null
    let error = null
    try {
      const res = await promiseFn(...params)
      data = res?.data
      error = res.error
    } catch (_error) {
      error = _error
    }
    setLoading(false)
    setState({ data, error })
  }
  useEffect(() => {
    refresh()
  }, [promiseFn, ...params])
  return { ...state, loading, refresh }
}

export const usePromiseFn = (promiseFn: any, params: any[] = []) => {
  const [state, setState] = useState<{ data: T | null; error: any }>({ data: null, error: null })
  const [loading, setLoading] = useState<boolean>(false)
  const refresh = async () => {
    if (!promiseFn) return
    setLoading(false)
    let data = null
    let error = null
    try {
      data = await promiseFn(...params)
    } catch (_error) {
      error = _error
    }
    setState({ data, error })
  }
  useEffect(() => {
    refresh()
  }, [promiseFn, ...params])
  return { ...state, loading, refresh }
}

export function promiseTimeout(ps, timeout) {
  return new Promise((resolve, reject) => {
    // Set up the timeout
    const timer = setTimeout(() => {
      reject(new Error(`Promise timed out after ${timeout} ms`))
    }, timeout)

    // Set up the real work
    console.log('promiseTimeout', ps, timeout, isPromise(ps))
    // if (isPromise(ps)) {
    Promise.resolve(ps)
      .then((value) => {
        clearTimeout(timer)
        resolve(value)
      })
      .catch((error) => {
        clearTimeout(timer)
        reject(error)
      })
    // } else {
    //   clearTimeout(timer)
    //   resolve(ps)
    // }
  })
}
