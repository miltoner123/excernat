<template>
    <h2>CREAR USUARIO</h2>
    <form @submit.prevent="createUser">
        <div>
            <label for="name">Nombre de usuario:</label>
            <input type="text" id="name" v-model="user.name" />
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="user.email" />
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" v-model="user.password" />
        </div>
        <button type="submit">Crear Usuario</button>
    </form>
</template>
<script>
import axios from 'axios';

export default {
    name: 'UserCreate',
    data() {
        return {
            user: {
            name: '',
            email: '',
            password: ''
            }
        };
    },
    methods: {               
        async createUser() {
            axios.post('http://localhost:8000/api/users', this.user)
            .then(response => {
                console.log('Usuario creado:', response.data);
                this.$router.push('/usuarios'); // Redirigir a la lista de usuarios después de crear    
            })
            .catch(error => {
                console.error('Error al crear el usuario:', error);
            });

        }
    }
};
</script>