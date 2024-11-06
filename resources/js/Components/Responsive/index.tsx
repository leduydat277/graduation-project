import React from 'react';
import { Box, Container } from '@mui/material';


export const getResponsiveProps = (config) => {
  const { xs, md, sm, lg, xl, xxl, padding, ...rest } = config;
  const props = {
    sx: {
      width: '100%',
      maxWidth: '100%',
      ...(padding ? { px: 2 } : {}),
      ...(xxl ? { '@media (min-width: 1920px)': { maxWidth: `${Math.floor(xxl * 10000) / 100}%` } } : {}),
      ...(xl ? { '@media (min-width: 1280px)': { maxWidth: `${Math.floor(xl * 10000) / 100}%` } } : {}),
      ...(lg ? { '@media (min-width: 960px)': { maxWidth: `${Math.floor(lg * 10000) / 100}%` } } : {}),
      ...(md ? { '@media (min-width: 600px)': { maxWidth: `${Math.floor(md * 10000) / 100}%` } } : {}),
      ...(sm ? { '@media (min-width: 400px)': { maxWidth: `${Math.floor(sm * 10000) / 100}%` } } : {}),
      ...(xs ? { '@media (min-width: 0px)': { maxWidth: `${Math.floor(xs * 10000) / 100}%` } } : {}),
    },
  };

  return { ...props, ...rest };
};

// Component Responsive
export const ResComponent = (props) => {
  const { component: Component = Box, ...rest } = props;
  return <Component {...getResponsiveProps(rest)} />;
};


export const getContainerProps = (props = {}) => {
  return {
    sx: {
      mx: 'auto',
      px: 2,
      width: '100%',
      display: 'flex',
      flexWrap: 'wrap',
      '@media (min-width: 0px)': { maxWidth: 640 },
      '@media (min-width: 600px)': { maxWidth: 768 },
      '@media (min-width: 960px)': { maxWidth: 1020 },
      '@media (min-width: 1280px)': { maxWidth: 1280 },
      '@media (min-width: 1920px)': { maxWidth: 1600 },
    },
    ...props,
  };
};


export const ResContainer = (props) => {
  const { component: Component = Container, ...rest } = props;
  return <Component {...getContainerProps(rest)} />;
};


export const containerProps = getContainerProps;
export const resProps = getResponsiveProps;
export const resProps2 = (p = {}) =>
  getResponsiveProps({ ...p, '@media (min-width: 0px)': null, '@media (min-width: 600px)': null, '@media (min-width: 960px)': null, maxWidth: 1280 });
