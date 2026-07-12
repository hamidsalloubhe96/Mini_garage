import React from 'react';
import ReactDOM from 'react-dom/client';
import Login from './components/Login';
import Register from './components/Register';
import ForgotPassword from './components/ForgotPassword';

const loginRoot = document.getElementById('login-root');
if (loginRoot) {
    ReactDOM.createRoot(loginRoot).render(<Login />);
}

const registerRoot = document.getElementById('register-root');
if (registerRoot) {
    ReactDOM.createRoot(registerRoot).render(<Register />);
}

const forgotRoot = document.getElementById('forgot-root');
if (forgotRoot) {
    ReactDOM.createRoot(forgotRoot).render(<ForgotPassword />);
}