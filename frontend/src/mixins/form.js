export default {
    data() {
        return {
            errors: [],
            employee: {
                birthday: "",
                initials: "",
                city: ""
            }
        };
    },
    methods: {
        clearForm() {
            this.employee = {};
        }
    },
    created() {
        console.log('привет из примеси!');
    }
}
