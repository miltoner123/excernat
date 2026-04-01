<template>
    <h2>Lista de Permisos</h2>
    <button style="margin-top: 10px; background-color: green;color:white;padding: 10px; border:none; cursor: pointer;" 
    @click="createPermisos">Crear permiso</button>
   <table> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fuente</th>
                <th>Accion</th>
                <th>Detalle</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="permiso in permisos" :key="permiso.id">
                <td>{{ permiso.id }}</td>
                <td>{{ permiso.name }}</td>
                <td>{{ permiso.resource }}</td>
                <td>{{ permiso.action }}</td>
                <td>{{ permiso.detail }}</td>
                <td>
                    <!-- Aquí puedes agregar botones para editar o eliminar el permiso -->
                    <button @click="ver(permiso.id)">Ver</button>
                    <button @click="eliminar(permiso.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'Permisos',
        data() {
            return {
                permisos: []
            };
        },
        mounted() {
            this.permisosGet();
        },
        methods: {
            createPermisos() {
                this.$router.push('/permisos/crear');
            },
            permisosGet() {
                axios.get('http://localhost:8000/api/permisos')
                    .then(response => {
                        this.permisos = response.data;
                    }).catch(error => {
                        console.error('Error al cargar los permisos:', error);
                    });
            },
            eliminar(id) {
                if (confirm('¿Estás seguro de que deseas eliminar este permiso?')) {
                    axios.delete(`http://localhost:8000/api/permisos/${id}`)
                        .then(response => {
                            console.log('Permisos eliminado:', response.data);
                            this.permisosGet(); // Recargar la lista de permisos después de eliminar
                        }).catch(error => {
                            console.error('Error al eliminar el permiso:', error);
                        });
                }
        },
            ver(id) {
                this.$router.push(`/permisos/${id}`);      
            },
        }
    };
</script>