<template>
    <h1>Datos del usuario</h1>
    <p>Aqui se muestran los datos del usuario seleccionado
        {{ $route.params.id }}
    </p>

<div v-if="user">
    <ul>
        <li><strong>ID:</strong> {{ user.id }}</li>
        <li><strong>Nombre:</strong> {{ user.name }}</li>
        <li><strong>Email:</strong> {{ user.email }}</li>
        <!-- Agrega más campos según la estructura de tu usuario -->
    </ul>
</div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'UserShow',
    data() {
        return {
            user: null,
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
        }
    }
};
</script>