<template>
    <h1>Usuarios</h1>
    <button @click="createUser" style="padding: 10px; margin-bottom: 20px; background-color: green; color:white; border:none; border-radius: 5px; cursor:pointer;">Crear Nuevo Usuario</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <button @click="editUser( user.id)">Editar</button>
                    <button @click="deleteUser(user.id)">Eliminar</button>              
                    <button @click="viewUser(user.id)">Ver Detalles</button>
                </td>
                </tr>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios';
export default {
    name: 'UserView',
    data() {
        return {
            users: []
        };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
        async fetchUsers() {
            axios.get('http://localhost:8000/api/users')
                .then(response => {
                    this.users = response.data;
                }).catch(error => {
                    console.error('Error al cargar los usuarios:', error);
                });
        },
        deleteUser(id){
            if(confirm("¿Estás seguro de que deseas eliminar este usuario?")){
                axios.delete(`http://localhost:8000/api/users/${id}`)
                .then(response => {
                    alert("Usuario eliminado con éxito");
                    this.fetchUsers(); // Refrescar la lista de usuarios después de eliminar
                })
                .catch(error => {
                    console.error("Error al eliminar el usuario:", error);
                });
            }
        },
        editUser(id){
            this.$router.push('/usuarios/editar/'+ id);
        },
        async fetchUsers() {
            axios.get('http://localhost:8000/api/users').then(response => {
                    this.users = response.data;
                }).catch(error => {
                    console.error('Error al cargar los usuarios:', error);
                });
                
        },
        viewUser(id){
            this.$router.push('/usuarios/'+ id);
        },
        createUser(){
            this.$router.push('/usuarios/crear');
        },

    }
};
</script>