<template>
    <div class="col-md-8">
        <div class="alert alert-danger" v-if="errors.length > 0">
            <ul>
                <li v-for="error in errors" :key="error.id">{{ error }}</li>
            </ul>
        </div>
        <div class="alert alert-success" v-if="success">
            <p>Wallet Successfully Created!</p>
        </div>
        <form>
            <div class="card">
                <div class="card-header">Create Wallet</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Wallet Name *</label>
                        <input v-model="formData.wallet_name" type="text" class="form-control" placeholder="Enter Wallet Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Wallet Description (optional)</label>
                        <textarea v-model="formData.wallet_description" class="form-control" rows="3">Enter Wallet Description</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="/home">Back</a>
                    <button type="submit" class="btn btn-primary float-right" @click.prevent="createWallet()" v-if="!isBusy">Submit</button>
                    <div class="spinner-border text-primary float-right" role="status" v-if="isBusy">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'create-wallet-component',
        data(){
            return{
                formData: {
                    wallet_name: '',
                    wallet_description: '',
                },
                errors: [],
                isBusy: false,
                success: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            createWallet() {
                this.isBusy = true
                axios.post('/wallet', this.formData)
                .then((response) => {
                    console.log(response)
                    this.errors = ''
                    this.isBusy = false
                    this.success = true
                    setTimeout(function() {
                        window.location.href = '/home'
                    }, 1000);
                })
                .catch((errors) => {
                    // console.dir(errors)
                    this.errors = []
                    if(errors.response.status === 422) {
                        this.showErrors(errors.response.data.errors)
                    }
                    this.isBusy = false
                })
            },
            showErrors(errors) {
                for(const [key, value] of Object.entries(errors)){
                    for(let item in value) {
                        this.errors.push(value[item])
                    }
                }
            }
        }
        

    }
</script>
