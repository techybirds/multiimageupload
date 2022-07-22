<template>
    <div>
        <template v-if="images.length > 0">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(fi,index) in images" :id="fi.id">
                <td>{{ index + 1 }}</td>
                <td><img :src="'/form_images/' + fi.uploaded_image" alt="" style="width:41%;"></td>
            </tr>
            </tbody>
        </table>
        </template>

        <template v-else>
            <table class="table">
                <thead>
                <tr>
                    <td>
                        <h4>NO DATA AVAILABLE</h4>
                    </td>
                </tr>
                </thead>
            </table>
        </template>
    </div>
</template>

<script>
    export default {
        name: "ListFormImages",

        data(){
            return {
                form_id: this.$route.params.form_id,
                images:[]
            }
        },

        mounted(){
            window.axios.get('/api/get-images/'+this.form_id,{})
                .then(response => {

                    if(response.data.status !=1){
                        alert(response.data.message);
                        return false;
                    }


                    this.images = response.data.data.form_images;
                });
        }
    }
</script>

<style scoped>

</style>
