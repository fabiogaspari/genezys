<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Usuários
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody v-for='user in data?.data' :key='user.id'>
                    <tr>
                        <th scope="row">{{user.id}}</th>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.adresses?.[0]?.street}}</td>
                        <td>{{user.adresses?.[0]?.neighborhood}}</td>
                        <td>{{user.adresses?.[0]?.city}}</td>
                        <td>{{user.adresses?.[0]?.cep}}</td>
                        <td>{{user.adresses?.[0]?.state}}</td>
                    </tr>
                </tbody>
            </table>
            <nav class="d-flex justify-content-center">
                <ul class="pagination ">
                    <li class="page-item"><a style="cursor:pointer" class="page-link" @click="computePage(-1)">Previous</a></li>
                    <li class="page-item"><a style="cursor:pointer" class="page-link" @click="computePage(1)">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
export default {
    name:'dashboard',
    data(){
        return {
            data: ref({}),
            page:1,
            lastPage: 0,
        }
    },
    methods:{
        async getResults(page=1) {
            this.page = page;
            this.lastPage
            await axios.get(`/user/list?page=${page}`).then(response=>{
                this.data = response?.data;
                this.lastPage = response?.data?.last_page; 
            })
        },
        computePage(type) {
            if ( type == -1 ) {
                if ( this.page == 1 ) {
                    return;
                }
                this.page -= 1;
            } else {
                if ( this.lastPage == this.page ) {
                    return;
                }
                this.page += 1;
            }
            this.getResults(this.page);
        }
    },
    created() {
        this.getResults();
    }
}
</script>