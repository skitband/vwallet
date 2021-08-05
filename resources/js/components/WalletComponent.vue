<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Account Dashboard</div>

            <div class="card-body">
                <a href="/wallet/create" class="btn btn-outline-primary">Create Wallet</a>
                
                <wallet-list-component />
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'wallet-component',
        data(){
            return{
                
            }
        },
        mounted() {
            
        },
        methods: {
            
        }
        

    }
</script>
