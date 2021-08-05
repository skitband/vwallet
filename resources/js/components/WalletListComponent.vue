<template>
    <div class="mt-3">
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
                        <button type="button" class="btn btn-outline-secondary btn-sm">Edit</button> 
                        <button type="button" class="btn btn-outline-secondary btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'WalletListComponent',
    data(){
        return{
            wallets: [],
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
        }
    }
}
</script>

<style>

</style>