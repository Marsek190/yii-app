<template>
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
</template>

<script>
    export default {
        props: ['errors', 'employee']
    }
</script>

<style scoped>
    .error-field {
        border-color: red;
    }
</style>