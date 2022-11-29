<template>
    <div class="container">
        <div class="row mb-3 mt-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">Nome completo</label>

            <div class="col-md-6">
                <input v-model="user.name" id="name" type="text" class="form-control" autofocus>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

            <div class="col-md-6">
                <input v-model="user.email" id="email" type="email" class="form-control" required autocomplete="email">
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

            <div class="col-md-6">
                <input v-model="user.password" id="password" type="password" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar Password</label>

            <div class="col-md-6">
                <input v-model="user.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <h5 for="address" class="col-md-4">Address</h5>

        <hr class='mt-0'>
        
        <div class="row mb-3">
            <label for="zipcode" class="col-md-4 col-form-label text-md-end">CEP</label>
            <div class="col-4">
                <input v-model="user.address.cep" type="text" class="form-control">

            </div>
            <div class="col-2">
                <button @click="getZipCode()" type="button" class="btn btn-primary w-100" click='getZipCode()'>Buscar</button>
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="street" class="col-md-4 col-form-label text-md-end">Rua</label>

            <div class="col-md-6">
                <input v-model="user.address.street" id="street" type="text" class="form-control" name="street">

            </div>
        </div>

        <div class="row mb-3">
            <label for="neighborhood" class="col-md-4 col-form-label text-md-end">Bairro</label>

            <div class="col-md-6">
                <input v-model="user.address.neighborhood" id="neighborhood" type="text" class="form-control" name="neighborhood">
            </div>
        </div>

        <div class="row mb-3">
            <label for="city" class="col-md-4 col-form-label text-md-end">Cidade</label>

            <div class="col-md-6">
                <input v-model="user.address.city" id="city" type="text" class="form-control" name="city">
            </div>
        </div>

        <div class="row mb-3">
            <label for="number" class="col-md-4 col-form-label text-md-end"></label>
            <div class="col-3">
                <input v-model="user.address.number" type="text" class="form-control" placeholder="Número">
            </div>
            <div class="col-3">
                <input v-model="user.address.state" type="text" class="form-control" placeholder="Estado">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <button type="button" class="btn btn-primary" @click="register()">
                    Registrar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'register',
    data(){
        return {
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
                address: {
                    street:"",
                    number:"s/n",
                    neighborhood:"",
                    state:"",
                    city:"",
                    cep:""
                }
            },
        }
    },
    methods:{
        async getZipCode() {
            if ( this.user.address.cep == "" ) {
                alert("Por favor, preencha o CEP");
                return;
            }
            await axios.get('/address/get/'+this.user.address.cep).then(response=>{
                if ( Object.keys(response.data).length == 0 ) {
                    alert('Por favor, reveja seus dados.');
                    return;
                }
                this.user.address.street = response.data.logradouro;
                this.user.address.neighborhood = response.data.bairro;
                this.user.address.state = response.data.uf;
                this.user.address.city = response.data.localidade;
            }).catch(({response})=>{
                if(response.status===422){
                    alert(response.data.message)
                }
            })
        },
        async register(){
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/register',this.user).then(response=>{
                window.location.href = '/home';
            }).catch(({response})=>{
                if(response.status===422){
                    alert(response.data.message) 
                }
            })
        }    
    }
}
</script>