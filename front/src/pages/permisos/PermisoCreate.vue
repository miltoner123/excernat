<template>
<form @submit.prevent="permisoCreate">
 <h2> Crear Permiso</h2>
 <div>
        <label for="name">Nombre del Permiso</label>
        <input type="text" id="nombre" v-model="name" required>
  </div>
  <div>
          <label for="resource">Fuente del Permiso</label>
          <input type="text" id="resource" v-model="resource" required>
  </div>
  <div>
          <label for="action">Acción del Permiso</label>
          <input type="text" id="action" v-model="action" required>
  </div>
  <div>
          <label for="detail">Detalle del Permiso</label>
          <input type="text" id="detail" v-model="detail" required>
  </div>


 <button type="submit">Crear Permiso</button>
</form>

</template>
<script>    
import axios from 'axios';
export default {
  name: 'PermisoCreate',
  data() {
    return {
      name: '',
      resource: '',
      action: '',
      detail: ''
    };
  },
  methods: {
   permisoCreate(){
    const newPermiso={
        name: this.name,
        resource: this.resource,
        action: this.action,
        detail: this.detail
    };
    axios.post('http://localhost:8000/api/permisos', newPermiso)
    .then(response=>{
        console.log('Permiso creado:', response.data);
        this.$router.push('/permisos');
    })  .catch(error=>{
        console.error('Error al crear el permiso:', error);

   } );
    }
  }
};


</script>