<template>
<form @submit.prevent="rolCreate">
 <h2> Crear Rol</h2>
 <div>
        <label for="name">Nombre del Rol</label>
        <input type="text" id="nombre" v-model="nombre" required>
 </div>
 <div>
        <label for="description">Descripción del Rol</label>
        <input type="text" id="descripcion" v-model="descripcion" required>
 </div>
 <button type="submit">Crear Rol</button>
</form>

</template>
<script>    
import axios from 'axios';
export default {
  name: 'RolesCreate',
  data() {
    return {
      nombre: '',
      descripcion: ''
    };
  },
  methods: {
   rolCreate(){
    const newRol={
        nombre: this.nombre,
        descripcion: this.descripcion
    };
    axios.post('http://localhost:8000/api/roles', newRol)
    .then(response=>{
        console.log('Rol creado:', response.data);
        this.$router.push('/roles');
    })  .catch(error=>{
        console.error('Error al crear el rol:', error);

   } );
    }
  }
};


</script>