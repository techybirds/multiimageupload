<template>
    <div>
        <template v-if="form_details.length > 0">
        <a href="/" class="btn btn-primary m-2">Go back</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">View Images</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(fd,index) in form_details" :id="fd.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ fd.title }}</td>
                <td>{{ fd.description }}</td>
                <td>
                    <router-link :to="{name:'list_form_images', params:{form_id:fd.id}}" class="btn btn-success">View Images</router-link>
                </td>
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
        name: "ListFormDetails",
        data(){
          return {
              form_details:[]
          }
        },
        mounted(){
            window.axios.get('/api/get-forms',{}).then(response => {

                if(response.data.status !=1){
                    alert(response.data.message);
                    return false;
                }

                this.form_details = response.data.data.form_details
            });
        }
    }
</script>

<style scoped>

</style>
