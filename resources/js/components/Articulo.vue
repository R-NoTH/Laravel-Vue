<template>
  <div>
    <h1 class="text-center">Hola Mundo</h1>
    <hr />
    <!-- Button trigger modal -->
    <button
      @click="
        modificar = false;
        mostrarModal();
      "
      type="button"
      class="btn btn-primary"
    >
      Nuevo articulo
    </button>

    <p>{{ message }}</p>
    <input v-model="message" />

    <br />
    <hr />
    <table class="table table-dark table-borderless">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Stock</th>
          <th scope="col" colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="articulo in articulos" :key="articulo.id">
          <th>{{ articulo.id }}</th>
          <td>{{ articulo.name }}</td>
          <td>{{ articulo.description }}</td>
          <td>{{ articulo.stock }}</td>
          <td>
            <button
              @click="
                modificar = true;
                mostrarModal(articulo);
              "
              class="btn btn-outline-info btn-sm"
            >
              Edit
            </button>
          </td>
          <td>
            <button
              @click="eliminar(articulo.id)"
              class="btn btn-outline-danger btn-sm"
            >
              Destroy
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Modal  -->

    <!-- Modal -->
    <div
      class="modal"
      :class="{ mostrar: statusModal }"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ tituloModal }}
            </h5>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Name Article </label>
              <input
                v-model="articulo.name"
                type="text"
                id="name"
                class="form-control"
                placeholder="Enter a name"
              />
              <span class="text-danger" v-if="errores.name">{{
                errores.name
              }}</span>
              <small id="emailHelp" class="form-text text-muted"
                >This is a message for a change.</small
              >
            </div>
             <div class="form-group">
              <label for="option">option</label>
              <input
                v-model="articulo.option"
                type="radio"
                value="1"
                id="name"
                class="form-control"
              />
              <input
                v-model="articulo.option"
                type="radio"
                value="2"

                id="name"
                class="form-control"
              />
              <input
                v-model="articulo.option"
                type="radio"
                value="3"

                id="name"
                class="form-control"
              />
              <span class="text-danger" >{{
                articulo.option
              }}</span>

            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <input
                v-model="articulo.description"
                type="text"
                id="description"
                class="form-control"
                placeholder="Enter a description"
                @keyup="ContarCaracter()"
              />
              <span class="text-sm-start" v-if="contadorCaracteres > 0"> {{
                contadorCaracteres
              }} /50</span>
              <span class="text-danger" v-if="errores.description">{{
                errores.description
              }}</span>
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input
                v-model="articulo.stock"
                type="number"
                id="stock"
                class="form-control"
                placeholder="Enter an amount"
              />
              <span class="text-danger" v-if="errores.stock">{{
                errores.stock
              }}</span>
            </div>
          </div>
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button @click="guardar()" type="button" class="btn btn-primary">
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //lo mejor que se hace en Vue, increible!
      message: "Hello Vue!",
      contadorCaracteres:0,
      articulo: {
        name: "",
        description: "",
        stock: "",
        option:"hh",
      },
      id: 0,
      modificar: true,
      tituloModal: "",
      statusModal: 0,
      articulos: [], //contiene todos los articulos, que provienen de la consulta por axio que se hace al controlador
      errores: {},
    };
  },
  methods: {
    async listar() {
      const res = await axios.get("articulos");
      this.articulos = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete("articulos/" + id);
      this.listar();
    },
    async guardar() {
      try {
        if (this.modificar) {
          //entra si es igual a editar aticulo
          const res = await axios.put("articulos/" + this.id, this.articulo);

        } else {
          //entra si es igual a Nuevo Articulo(al darle al boton nuevo articulo cambia el estado de modificar=false)

          //enviamos la informacion que contiene el objeto articulo como this.articulo
          const res = await axios.post("articulos", this.articulo);
          console.log(res.data);
        }
        this.cerrarModal();
        this.listar();
      } catch (error) {
        if (error.response.data) {
          this.errores = error.response.data.errors;
          console.log(error.response.data);
        }
      }
    },
    mostrarModal(data = {}) {
      this.statusModal = 1;
      if (this.modificar) {
        this.modificarArticulo(data);
      } else {
        this.crearArticulo();
      }
    },
    cerrarModal() {
      this.statusModal = 0;
      this.errores = {};
    },
    modificarArticulo(data) {
      this.id = data.id;
      this.tituloModal = "Editar Articulo";
      this.articulo.name = data.name;
      this.articulo.description = data.description;
      this.articulo.stock = data.stock;
    },
    crearArticulo() {
      this.id = 0;
      this.tituloModal = "Crear Articulo";
      this.articulo.name = "";
      this.articulo.description = "";
      this.articulo.stock = 0;
    },
    ContarCaracter(){
      this.contadorCaracteres = this.articulo.description.length;
    },
  },
  created() {
    this.listar();
  },
};
</script>
<style scoped>
.mostrar {
  display: list-item;
  opacity: 0.9;
  background: rgb(212, 243, 255);
}
</style>
