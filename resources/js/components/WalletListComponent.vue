<template>
    <div class="mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success">
            Wallet Successfully Deleted!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <table class="table table-bordered table-condensed" v-if="wallets.length > 0">
            <thead>
                <tr>
                    <th scope="col">Wallet Name</th>
                    <th scope="col">Wallet Balance</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="wallet in wallets" :key="wallet.id">
                    <td>{{wallet.wallet_name}}</td>
                    <td class="text-right">{{wallet.wallet_balance}}</td>
                    <td class="text-center">
                        <a :href="`/wallet/transaction/${wallet.id}`"  class="btn btn-outline-secondary btn-sm">View</a>
                        <a :href="`/wallet/${wallet.id}`" class="btn btn-outline-secondary btn-sm">Edit</a> 
                        <button type="button" class="btn btn-outline-secondary btn-sm" @click="deleteWallet(wallet.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="modal fade" id="newTransaction" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>


export default {
    name: 'WalletListComponent',
    data(){
        return{
            wallets: [],
            success: false,
        }
    },
    mounted() {
        this.getWallet()
    },
    methods: {
        getWallet() {
            let x = this;
            axios.get('/wallet')
            .then(function (response) {
                // handle success
                x.wallets = response.data
                console.log(x.wallets);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        deleteWallet(id) {
            let x = this;
            axios.delete(`/wallet/${id}`)
            .then(function (response) {
                // handle success
                console.log(response.data.result);
                x.getWallet();
                x.success = true;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
    }
}
</script>

<style>

</style>