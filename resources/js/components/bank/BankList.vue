<template>
    <div class="col-lg-12">
        <div v-if="message" class="alert">{{ message }}</div>

        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h5><strong><i class="fa fa-list"></i> <strong>Bank List</strong></strong></h5>
                </div>
            <div class="float-right">
                    <router-link :to="{name: 'BankCreate'}" class="btn btn-success">Create new Bank</router-link>
            </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <table id="lists" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr class="text-center">
                        <th width="5%">Id</th>
                        <th width="25%">Name</th>
                        <th width="30%">Email</th>
                        <th width="15%">Location</th>
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr v-for="bank, index in banks">
                        <td>{{ index+1 }}</td>
                        <td>{{ bank.name }}</td>
                        <td>{{ bank.email }}</td>
                        <td>{{ bank.location }}</td>
                        <td>
                            <span v-if="bank.is_active == 1" class="label label-success">Active</span>
                            <span v-else class="label label-danger">In-active</span>
                        </td>
                        <td>
                            <router-link :to="{name: 'BankEdit', params: {id: bank.id}}" class="btn btn-sm btn-primary">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-sm btn-danger"
                               v-on:click="deleteEntry(bank.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                banks: [],
                message: null,
            }
        },
        created() {
            var app = this;
            axios.post('/bank-list')
                .then(function (resp) {
                    // console.log(resp.data);
                    app.banks = resp.data;
                })
        },
        methods: {
            deleteEntry: function (id, index) {
                var app = this;
                axios.delete('/bank-delete/' + id)
                    .then(function (response){
                        app.banks.splice(index, 1);
                        app.message = 'Bank Delete Successfully';
                        console.log('Bank successfully Delete');
                        setTimeout(() => app.message, 1000);
                    })
                    .catch(function (response) {
                        alert("Could not delete Bank");
                    });
            }
        }
    }
</script>

<style scoped>
    .alert {
        background: lightgreen;
        color: black;
        padding: 1rem;
        margin-bottom: 1rem;
        width: 100%;
        border: 1px solid darkgreen;
        border-radius: 5px;
    }
</style>
