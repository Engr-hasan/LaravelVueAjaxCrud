<template>
    <div class="col-lg-12">
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
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Active Status</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="bank, index in banks">
                        <td>{{ bank.name }}</td>
                        <td>{{ bank.email }}</td>
                        <td>{{ bank.location }}</td>
                        <td>
                            <span v-if="bank.is_active == 1" class="label label-success">Active</span>
                            <span v-else class="label label-danger">In-active</span>
                        </td>
                        <td>
                            <router-link :to="{name: 'BankEdit', params: {id: bank.id}}" class="btn btn-xs btn-primary">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
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
                banks: []
            }
        },
        created() {
            var app = this;
            axios.post('/settings/bank-list-v2')
                .then(function (resp) {
                    // console.log(resp.data);
                    app.banks = resp.data;
                })
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.get('/settings/bank-list-v2/delete/' + id)
                        .then(function (resp) {
                            app.banks.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        }
    }
</script>
