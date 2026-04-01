<template>
  <nav>
    <RouterLink to="/">Principal</RouterLink>
    <RouterLink to="/productos">ALMACENES</RouterLink>   
    <RouterLink to="/usuarios">USUARIOS</RouterLink>
    <RouterLink to="/roles">ROLES</RouterLink>
    <RouterLink to="/permisos">PERMISOS</RouterLink>

    <RouterLink to="/login" v-if="!IsLoggedIn">LOGIN</RouterLink>
    <span style="color: white; margin-right: 1rem; cursor: pointer;" @click="Salir()" v-if="IsLoggedIn">Logout</span> 
  
  </nav>
  <main>
    <RouterView />
  </main>
</template>
<script>
import axios from 'axios';

  
export default {
  name: 'App',
  data() {
    return {
      IsLoggedIn: false
    };
  },
  mounted() {
    console.log('App mounted');
    const token = localStorage.getItem('token');
    if (token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      axios.get('http://localhost:8000/api/auth/profile')
        .then(response => {
          console.log('Usuario autenticado:', response.data);
          this.IsLoggedIn = true;
        })
        .catch(error => {
          console.error('Token inválido o expirado:', error);
          localStorage.removeItem('token');
          axios.defaults.headers.common['Authorization'] = '';
          this.IsLoggedIn = false;
        });
      this.IsLoggedIn = true;
  }
  },
  methods: {
    Salir() {
      // localStorage.removeItem('token');
      // axios.defaults.headers.common['Authorization'] = '';
      // this.IsLoggedIn = false;
      // alert('Has cerrado sesión correctamente.');
      // this.$router.push('/login');
      axios.post('http://localhost:8000/api/auth/logout')
        .then(response => {
          console.log('Cierre de sesión exitoso:', response.data);
          localStorage.removeItem('token');
          axios.defaults.headers.common['Authorization'] = '';
          this.IsLoggedIn = false;
          alert('Has cerrado sesión correctamente.');
          this.$router.push('/login');
        })
        .catch(error => {
          console.error('Error al cerrar sesión:', error);
          alert('Error al cerrar sesión: ' + (error.response?.data?.message || error.message));
        });
    }
    
  }
};
</script>

<style> 
nav {
  background-color: #333;
  padding: 1rem;
}
nav a {
  color: white;
  margin-right: 1rem;
  text-decoration: none;
}
nav a.router-link-exact-active {
  font-weight: bold;
  text-decoration: underline;
}

</style>