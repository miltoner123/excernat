<template>
    <h1>Datos del usuario</h1>
    <p>Aqui se muestran los datos del usuario seleccionado
        {{ $route.params.id }}
    </p>
<!-- <pre>
    {{ user }}
</pre> -->
<form v-if="user" @submit.prevent="actualizarUsuario">
    <div>
        <label for="name">Nombre:</label>
        <input type="text" id="name" v-model="user.name" />
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="user.email" />
    </div>
    <div></div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="user.password" placeholder="Dejar en blanco para no cambiar"/>
    <button type="submit">Actualizar Usuario</button>
</form>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserEdit",
    data() {
        return {
            user: null
        };
    },
    mounted() {
        this.fetchUserData();
    },
    methods: {
        async fetchUserData() {
            axios.get(`http://localhost:8000/api/users/${this.$route.params.id}`)
                .then(response => {
                    this.user = response.data;
                    //console.log(this.user);
                })
                .catch(error => {
                    console.error('Error al cargar los datos del usuario:', error);
                });
    },
    actualizarUsuario() {
        axios.put(`http://localhost:8000/api/users/${this.$route.params.id}`, this.user)
            .then(response => {
                alert("Usuario actualizado con éxito");   
                this.$router.push('/usuarios'); // Redirigir a la lista de usuarios después de actualizar    
            })
            .catch(error => {
                console.error("Error al actualizar el usuario:", error);
            });
        }
    }
};
</script>