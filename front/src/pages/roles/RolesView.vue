<template>
    <h2>Detalles del Rol</h2>
    <div v-if="role">
        <p><strong>ID:</strong> {{ role.id }}</p>
        <p><strong>Nombre:</strong> {{ role.nombre }}</p>
        <p><strong>Descripción:</strong> {{ role.descripcion }}</p>
    </div>
</template>
<script>
import axios from 'axios';
    export default {
        
        name: 'RolesView',
        data() {
            return {
                role:null
            };
        },
        mounted() {
            this.fetchRoleData();
        },
        methods: {  
            async fetchRoleData() {
                axios.get(`http://localhost:8000/api/roles/${this.$route.params.id}`)
                    .then(response => {
                        this.role = response.data;
                    })
                    .catch(error => {
                        console.error('Error al cargar los detalles del rol:', error);
                    });
            }
        }
    };
</script>