<template>
    <div>
        <div class="container">
            <div v-if="message" class="alert">{{ message }}</div>
            <div class="card">
                <div class="card-header">Create new Bank</div>
                <div class="card-body">
                    <form @submit.prevent="saveForm()">
                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4  required-star">Name</label>
                                    <div :class="['col-md-8', allerros.name ? 'has-error' : '']">
                                        <input type="text" v-model="bank.name" class="form-control input-sm">
                                        <span v-if="allerros.name" :class="['text-danger']">{{ allerros.name[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4  required-star">Code</label>
                                    <div :class="['col-md-8', allerros.bank_code ? 'has-error' : '']">
                                        <input type="number" v-model="bank.bank_code" class="form-control input-sm">
                                        <span v-if="allerros.bank_code" :class="['text-danger']">{{ allerros.bank_code[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4  required-star">Email</label>
                                    <div :class="['col-md-8', allerros.email ? 'has-error' : '']">
                                        <input type="email" v-model="bank.email" class="form-control input-sm">
                                        <span v-if="allerros.email" :class="['text-danger']">{{ allerros.email[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4  required-star">Phone</label>
                                    <div :class="['col-md-8', allerros.phone ? 'has-error' : '']">
                                        <input type="number" v-model="bank.phone" class="form-control input-sm">
                                        <span v-if="allerros.phone" :class="['text-danger']">{{ allerros.phone[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4 ">Website</label>
                                    <div :class="['col-md-8', allerros.website ? 'has-error' : '']">
                                        <input type="url" v-model="bank.website" class="form-control input-sm">
                                        <span v-if="allerros.website" :class="['text-danger']">{{ allerros.website[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4  required-star">Location</label>
                                    <div :class="['col-md-8', allerros.location ? 'has-error' : '']">
                                        <input type="text" v-model="bank.location" class="form-control input-sm">
                                        <span v-if="allerros.location" :class="['text-danger']">{{ allerros.location[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <label class="control-label col-md-4  required-star ">Address</label>
                                    <div :class="['col-md-8', allerros.address ? 'has-error' : '']">
                                        <textarea class="form-control input-sm" v-model="bank.address" rows="2" cols="2"></textarea>
                                        <span v-if="allerros.address" :class="['text-danger']">{{ allerros.address[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 row">
                                    <label for="is_active" class="col-md-4 required-star">Active Status: </label>
                                    <div class="col-md-8">
                                        <label><input v-model="bank.is_active"  name="is_active" type="radio" :checked="bank.is_active == 1" checked value="1" id="is_active"> Active</label>
                                        <label><input v-model="bank.is_active"  name="is_active" type="radio" :checked="bank.is_active == 1" checked value="0" id="is_active"> Inactive</label>
                                        <span v-if="allerros.is_active" :class="['text-danger']">{{ allerros.is_active[0] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <router-link to="/" class="btn btn-warning float-left"><< Back</router-link>
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fa fa-chevron-circle-right"></i> Update Bank
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            console.log(id);
            app.bank_id = id;
            axios.get('/edit-bank/' + id)
                .then(function (resp) {
                    app.bank = resp.data;
                })
                .catch(function () {
                    alert("Could not edit Bank")
                });
        },
        data: function () {
            return {
                message: null,
                bank_id: null,
                allerros: [],
                bank: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                    phone: '',
                    location: '',
                    bank_code: '',
                    is_active: '',
                },
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newCompany = app.bank;
                axios.patch('/update-bank/' + app.bank_id, newCompany)
                    .then(function (resp) {
                        app.message = 'Bank Update Successfully';
                        console.log('Bank Update Successfully');
                        setTimeout(() => app.$router.push({path: '/'}), 1000);
                    })
                    .catch(function (resp) {
                        alert("Could not update Bank");
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
