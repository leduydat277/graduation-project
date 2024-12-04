import React from 'react';
import { Head } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import Logo from '@/components/Logo/Logo';
import LoadingButton from '@/components/Button/LoadingButton';
import TextInput from '@/components/Form/TextInput';
import FieldGroup from '@/components/Form/FieldGroup';
import { CheckboxInput } from '@/components/Form/CheckboxInput';

export default function LoginPage() {
  const { data, setData, errors, post, processing } = useForm({
    email: 'johndoe@example.com',
    password: 'secret',
    remember: true
  });

  function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    post(route('login.store'));
  }

  return (
    <div className="flex items-center justify-center min-h-screen p-6"
    style={{
      backgroundImage: 'url(https://img.freepik.com/premium-photo/rest-area-office-building-with-orange-walls-yellow-wall-background-3d-render_295714-6200.jpg)',  // Đường dẫn tĩnh từ server
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
            <h1 className="text-3xl font-bold text-center">Chào mừng bạn đến với Sleep Hotel</h1>
            <div className="w-24 mx-auto mt-6 border-b-2" />
            <div className="grid gap-6">
              <FieldGroup label="Tài khoản" name="email" error={errors.email}>
                <TextInput
                  name="email"
                  type="email"
                  error={errors.email}
                  value={data.email}
                  onChange={e => setData('email', e.target.value)}
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
                  onChange={e => setData('password', e.target.value)}
                />
              </FieldGroup>

              {/* <FieldGroup>
                <CheckboxInput
                  label="Remember Me"
                  name="remember"
                  id="remember"
                  checked={data.remember}
                  onChange={e => setData('remember', e.target.checked)}
                />
              </FieldGroup> */}
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
