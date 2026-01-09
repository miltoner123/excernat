<template>
<h1> Login</h1>  
    <form @submit.prevent="login">
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" v-model="email" id="email" required />
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" v-model="password" id="password" required />
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
</template>
<script>
import axios from 'axios';
  
    export default {
        data() {
            return {
                email: '',
                password: ''
            };
        },

        methods: {
            async login() {
                axios.post('http://localhost:8000/api/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    console.log('Inicio de sesión exitoso:', response.data);
                    localStorage.setItem('token', response.data.token);
                })
                .catch(error => {
                    //console.error('Error al iniciar sesión:', error);
                    alert('Error al iniciar sesión: ' + (error.response?.data?.mesage || error.message));
                });
        }
    }
};
</script>

