<template>
    <div>
        今日星座 {{ date }}

       <div class="row row-cols-2">
            <div class="col px-md-5" v-for="(item, index) in data" :key="index">
                    <h2>{{ item.name }}</h2>
                    <div v-for="(des, dk) in item.desc" :key="dk">
                        {{des}}
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
    created() {
        axios.get('/api/get-today-constellation-data')
        .then((res)=>{
            this.data = res.data.result
            this.date = res.data.date
        })
        
    },

    data() {
        return {
            data:[],
            date:'',
        }
    },
}
</script>