import React from 'react';
import { Head } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import Logo from '@/components/Logo/Logo';
import LoadingButton from '@/components/Button/LoadingButton';
import TextInput from '@/components/Form/TextInput';
import FieldGroup from '@/components/Form/FieldGroup';
import { usePromiseFn } from '../../../service/hooks/promise';
import { logined } from '../../../service/hooks/user';
import {userStore} from '../../../service/stores/user-store';
import { set } from 'lodash';

export default function LoginPage() {
  
  const { data, setData, errors, post, processing } = useForm({
    email: 'example@example.co',
    password: '1',
    remember: true,
  });
  const [setUserId, setFirstName, setLastName, setAdress, setEmail, setPhone] = userStore((state) => [
    state.setUserId,
    state.setFirstName,
    state.setLastName,
    state.setAdress,
    state.setEmail,
    state.setPhone
    
  ])
    console.log('data login', processing);
 
  
 const { data: user, error, loading } = usePromiseFn(logined, [data.email]);
        console.log('login-data', user.user.name);
        if(user.type === true){
         setUserId(user.user.id);
         setFirstName(user.user.first_name);
         setLastName(user.user.last_name);
         setAdress(user.user.address);
         setEmail(user.user.email);
         setPhone(user.user.phone);

        }

  function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    post(route('login.store'), {
      onSuccess: (response) => {
console.log('login response', response);
        
        
      },
      onError: (errors) => {
        console.error('Login failed:', errors);
      },
    });
  }

  return (
    <div
      className="flex items-center justify-center min-h-screen p-6"
      style={{
        backgroundImage:
          'url(https://img.freepik.com/premium-photo/rest-area-office-building-with-orange-walls-yellow-wall-background-3d-render_295714-6200.jpg)',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
      }}
    >
      <Head title="Login" />

      <div className="w-full max-w-md">
        <Logo
          className="block w-full max-w-xs mx-auto text-white fill-current"
          height={50}
        />
        <form
          onSubmit={handleSubmit}
          className="mt-8 overflow-hidden bg-white rounded-lg shadow-xl"
        >
          <div className="px-10 py-12">
            <h1 className="text-3xl font-bold text-center">
              Chào mừng bạn đến với Sleep Hotel
            </h1>
            <div className="w-24 mx-auto mt-6 border-b-2" />
            <div className="grid gap-6">
              <FieldGroup label="Tài khoản" name="email" error={errors.email}>
                <TextInput
                  name="email"
                  type="email"
                  error={errors.email}
                  value={data.email}
                  onChange={(e) => setData('email', e.target.value)}
                />
              </FieldGroup>

              <FieldGroup
                label="Mật khẩu"
                name="password"
                error={errors.password}
              >
                <TextInput
                  type="password"
                  error={errors.password}
                  value={data.password}
                  onChange={(e) => setData('password', e.target.value)}
                />
              </FieldGroup>
            </div>
          </div>
          <div className="flex items-center justify-between px-10 py-4 bg-gray-100 border-t border-gray-200">
            <a className="hover:underline" tabIndex={-1} href="#reset-password">
              Quên mật khẩu?
            </a>
            <LoadingButton
              type="submit"
              loading={processing}
              className="btn-indigo"
            >
              Đăng nhập
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
}
