<template>
    <h2>Detalles del Permiso</h2>
    <div v-if="permiso">
        <p><strong>ID:</strong> {{ permiso.id }}</p>
        <p><strong>Nombre:</strong> {{ permiso.name }}</p>
        <p><strong>Fuente:</strong> {{ permiso.resource }}</p>
        <p><strong>Acción:</strong> {{ permiso.action }}</p>
        <p><strong>Detalle:</strong> {{ permiso.detail }}</p>
    </div>
</template>
<script>
import axios from 'axios';
    export default {
        
        name: 'PermisoView',
        data() {
            return {
                permiso:null
            };
        },
        mounted() {
            this.fetchPermisoData();
        },
        methods: {  
            async fetchPermisoData() {
                axios.get(`http://localhost:8000/api/permisos/${this.$route.params.id}`)
                    .then(response => {
                        this.permiso = response.data;
                    })
                    .catch(error => {
                        console.error('Error al cargar los detalles del permiso:', error);
                    });
            }
        }
    };
</script>