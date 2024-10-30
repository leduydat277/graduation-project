import { useState } from 'react';
import { Link } from '@inertiajs/react';
import Logo from '@/Components/Logo/Logo';
import MainMenu from '@/Components/Menu/MainMenu';
import { Menu } from 'lucide-react';
import {containerProps} from '@/Components/Responsive';
export const TopHeader =  (props) => {
  const { fullWidth, ...rest } = props
  const containerProp = fullWidth ? { with: '100%', flex: 1 } : containerProps()
  const [menuOpened, setMenuOpened] = useState(false);
  return (
    <div className="flex items-center justify-between px-6 py-4 bg-indigo-900 md:flex-shrink-0 md:w-56 md:justify-center">
      <Link className="mt-1" href="/">
        <Logo className="text-white fill-current" width="120" height="28" />
      </Link>
     
    </div>
  );
};
