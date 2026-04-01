<template>
    <h2>Lista de Roles</h2>
    <button style="margin-top: 10px; background-color: green;color:white;padding: 10px; border:none; cursor: pointer;" 
    @click="createRoles">Crear rol</button>
   <table> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="rol in roles" :key="rol.id">
                <td>{{ rol.id }}</td>
                <td>{{ rol.nombre }}</td>
                <td>{{ rol.descripcion }}</td>
                <td>
                    <!-- Aquí puedes agregar botones para editar o eliminar el rol -->
                    <button @click="ver(rol.id)">Ver</button>
                    <button @click="eliminar(rol.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
    import axios from 'axios';
    export default {
        name: 'Roles',
        data() {
            return {
                roles: []
            };
        },
        mounted() {
            this.rolesGet();
        },
        methods: {
            createRoles() {
                this.$router.push('/roles/crear');
            },
            rolesGet() {
                axios.get('http://localhost:8000/api/roles')
                    .then(response => {
                        this.roles = response.data;
                    }).catch(error => {
                        console.error('Error al cargar los roles:', error);
                    });
            },
            eliminar(id) {
                if (confirm('¿Estás seguro de que deseas eliminar este rol?')) {
                    axios.delete(`http://localhost:8000/api/roles/${id}`)
                        .then(response => {
                            console.log('Rol eliminado:', response.data);
                            this.rolesGet(); // Recargar la lista de roles después de eliminar
                        }).catch(error => {
                            console.error('Error al eliminar el rol:', error);
                        });
                }
        },
            ver(id) {
                this.$router.push(`/roles/${id}`);      
            },
        }
    };
</script>