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
    <div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="user.password" placeholder="Dejar en blanco para no cambiar"/>
    </div>
    <ul>
        <li v-for="role in user.roles" :key="role.id">         
            {{ role.nombre }}
        </li>
    </ul>
    
        <button type="submit">Actualizar Usuario</button>
        <hr>
        <h2>Asignar roles</h2>
        <select v-model="role">
            <option v-for="role in roles" :key="role.id" :value="role.id">
                {{ role.nombre }}
              
            </option>
        </select>
        <button type="button" @click="agregarRol">Agregar Roles</button>
        </form>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserEdit",
    data() {
        return {
            user: null,
            roles: [],
            role: null
        };
    },
    mounted() {
        this.fetchUserData();
        this.fetchRoles();
        this.fetchRolesUser();
    },
    methods: {
        agregarRol() {
            if (this.role) {
                axios.post(`http://localhost:8000/api/users/${this.$route.params.id}/roles`, { role_id: this.role })
                    .then(response => {
                        alert("Rol asignado con éxito");
                        this.fetchUserData(); // Refrescar los datos del usuario para mostrar el nuevo rol
                    })
                    .catch(error => {
                        console.error("Error al asignar el rol:", error);
                    });
            } else {
                alert("Por favor, selecciona un rol para asignar.");
            }
        },
        fetchRolesUser() {
            axios.get(`http://localhost:8000/api/users/${this.$route.params.id}/roles`)
                .then(response => {
                    this.roles = response.data;
                    console.log(this.roles);
                })
                .catch(error => {
                    console.error('Error al cargar los roles del usuario:', error);
                });
        },
        fetchRoles() {
            axios.get('http://localhost:8000/api/roles')
                .then(response => {
                    this.roles = response.data;
                    console.log(this.roles);
                })
                .catch(error => {
                    console.error('Error al cargar los roles:', error);
                });
        },
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