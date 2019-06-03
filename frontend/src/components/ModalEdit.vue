<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-comment-container" @click.stop>
                <div class="modal-header">
                    <h4>Изменение данных</h4>
                    <div class="modal-close" @click="$emit('close')">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                </div>
                <form @submit.prevent="editUser" class="mb-3 mt-3">
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
                    <button type="submit" class="btn btn-success btn-block">Сохранить</button>
                </form>
                <button @click="clearForm()" class="btn btn-danger btn-block">Сброс</button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['errs', 'empl'],
    data() {
      return {
          errors: this.errs,
          employee: this.empl
      }
    },
    mounted() {
        this.$set(this.employee, 'birthday', this.employee.birthday.split(' ')[0].replace(/\./g, '-'));
    },
    methods: {
        clearForm() {
            this.employee = {};
        },
        editUser() {
            axios.post('/user/edit', this.employee)
            .then(({data}) => {
                if (data.errors) {
                    this.errors = data.errors;
                } else {
                    this.$emit('close');
                    console.log('its ok!');
                }
            })
            .catch(console.log);
        }
    }
}
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        transition: opacity .3s ease;
    }
    .modal-comment-container {
        width: 800px;
        margin: 40px auto 0;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-close {
        margin-top: 0;
        float: left;
        cursor: pointer;
    }
    .modal-close i {
        font-size: 24px;
        color: #0f6674;
    }
    .modal-header h4 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .text-right {
        text-align: right;
    }
    .form-label {
        display: block;
        margin-bottom: 1em;
    }
    .form-label > .form-control {
        margin-top: 0.5em;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: 0.5em 1em;
        line-height: 1.5;
        border: 1px solid #ddd;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-comment-container,
    .modal-leave-active .modal-comment-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>