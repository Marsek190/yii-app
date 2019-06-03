<template>
  <div class="users-page">
    <navbar></navbar>
    <h2>Добавить сотрудника</h2>
    <form @submit.prevent="createUser" class="mb-3">
      <div class="form-group">
        <small v-if="errors.initials" id="initialErrors" class="text-danger">
          {{ errors.initials }}
        </small>
        <input type="text" class="form-control" :class="{ 'error-field': errors.initials }" placeholder="Инициалы" v-model="employee.initials">
        <small v-if="errors.birthday" id="birthdayErrors" class="text-danger">
          {{ errors.birthday }}
        </small>
        <input type="date" class="form-control" :class="{ 'error-field': errors.birthday }" placeholder="Дата рождения" v-model="employee.birthday">
        <small v-if="errors.city" id="cityErrors" class="text-danger">
          {{ errors.city }}
        </small>
        <input type="text" class="form-control" :class="{ 'error-field': errors.city }" placeholder="Город" v-model="employee.city">
      </div>
      <button type="submit" class="btn btn-light btn-block">Сохранить</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Сброс</button>
    <div class="card card-body mb-2 mt-3" v-for="(employee, pos) in employees" :key="employee.id">
      <h3>{{ employee.initials }}</h3>
      <p>{{ employee.birthday.split(' ')[0] }}</p>
      <p>{{ employee.city }}</p>
      <hr>
      <button @click="open(employee.id)" class="btn btn-warning mb-2">Редактировать</button>
      <button @click="deleteUser(pos, employee.id)" class="btn btn-danger">Удалить</button>
      <modal-edit v-if="edit && edit_id === employee.id"
        :empl="employee" :errs="errors" @close="edit = false"></modal-edit>
    </div>
  </div>
</template>

<script>
import Navbar from "../Navbar.vue";
import ModalEdit from "../ModalEdit.vue";

export default {
  components: {
    'navbar': Navbar,
    'modal-edit': ModalEdit
  },
  data() {
    return {
      employees: [],
      errors: [],
      employee: {
        birthday: "",
        initials: "",
        city: ""
      },
      edit: false,
      edit_id: null
    };
  },
  methods: {
    open(id) {
      this.edit = true;
      this.edit_id = id;
    },
    clearForm() {
      this.employee = {};
    },
    getAllUsers() {
      axios.get("/user/users")
        .then(({ data }) => {
          const { pages, employees } = data;
          this.employees = employees;
          console.log(this.employees);
        })
        .catch(console.warn);
    },
    deleteUser(pos, id) {
      axios.post('/user/delete', {id})
      .then(() => {
        this.employees.splice(pos, 1);
        console.log('delete user with id = '+ id);
      }).catch(console.log);
    },
    createUser() {
      axios.post("/user/create", this.employee)
      .then(({data}) => {
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.employees.push(data);
        }
        console.log(data);
      })
      .catch(console.log);
    }
  },

  created() {
    console.log("run");
    this.getAllUsers();
  }
};
</script>


<style scoped>
.users-page {
  width: 800px;
  margin: auto;
}
</style>
