<template>
    <div class="container-fluid">

            <div class="form-group">
                <label for="title">Title </label>
                <input type="text"  class="form-control" id="title" v-model="title"  placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea placeholder="Please enter description" name="description"  class="form-control" id="description" cols="30" rows="10" v-model="description"></textarea>

            </div> 


        
            <label class="btn btn-default">
                <input type="file" accept="image/*" multiple @change="selectFile" />
            </label>
            <div class="form-group">
                <button class="btn btn-success"
                        :disabled="!selectedFiles"
                        @click="uploadFiles">
                    Submit
                </button>
            </div>
            <!--Upload part-->
            <div class="">
                <div v-if="progressInfos">
                    <div class="mb-2"
                         v-for="(progressInfo, index) in progressInfos"
                         :key="index"  >
                        <span>{{progressInfo.fileName}}</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info"
                                 role="progressbar"
                                 :aria-valuenow="progressInfo.percentage"
                                 aria-valuemin="0"
                                 aria-valuemax="100"
                                 :style="{ width: progressInfo.percentage + '%' }"
                            >
                                {{progressInfo.percentage}}%
                            </div>
                        </div>
                        <div v-if="message" class="alert alert-light mx-4" role="alert">
                            <span  v-for="(ms, i) in message.split('\n')" :key="i" v-if="index == i">
                                {{ ms }} 
                            </span>
                        </div>
                    </div>
                    
                </div>

                
            
            <!--<div class="card">-->
                <!--<div class="card-header">List of Files</div>-->
                <!--<ul class="list-group list-group-flush">-->
                    <!--<li class="list-group-item"-->
                        <!--v-for="(file, index) in fileInfos"-->
                        <!--:key="index"-->
                    <!--&gt;-->
                        <!--<p><a :href="file.url">{{ file.name }}</a></p>-->
                        <!--<img :src="file.url" :alt="file.name" height="80px">-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</div>-->
            </div>
            <div v-if="message" class="alert alert-success mx-4" role="alert">
                {{ msg}}
            </div>
    </div>
</template>

<script>
    import UploadService from "../services/UploadFileService";

    export default {
        name: "MainForm",

        data(){
            return {
                title:"",
                description:"",
                selectedFiles: undefined,
                progressInfos: [],
                message: "",
                fileInfos: [],
                form_id:"",
                msg:"",
            }
        },


        methods: {
            selectFile() {
                this.progressInfos = [];
                this.selectedFiles = event.target.files;
            },
            uploadFiles() {
                // first save title and Image

                window.axios
                    .post(
                        "/api/save-form-details",
                        {
                            title:this.title,
                            description:this.description
                        },
                        {}
                    )
                    .then(response => {
                        this.msg ='';
                        if(response.data.status !=1){
                            alert(response.data.message);
                            return false;
                        }
                        this.msg = response.data.message;
                        this.form_id = response.data.data.form_id;

                        // then upload the images with form_id
                        this.message = "";
                        for (let i = 0; i < this.selectedFiles.length; i++) {
                            this.upload(i, this.selectedFiles[i]);
                        }

                        this.selectedFiles = undefined;

                    })
                    .catch(error => {
                        console.log('error');
                    });
            },
            upload(idx, file) {
                this.progressInfos[idx] = { percentage: 0, fileName: file.name };
                UploadService.upload(file, this.form_id, (event) => {
                    this.progressInfos[idx].percentage = Math.round(100 * event.loaded / event.total);
                })
                    .then((response) => {
                        let prevMessage = this.message ? this.message + "\n" : "";
                        this.message = prevMessage + response.data.message;
                        // return UploadService.getFiles();
                        setTimeout(() => this.$router.push('/list-form-details') , 2000);
                        return true;
                    })
                    .then((files) => {
                        this.fileInfos = files.data;
                    })
                    .catch(() => {
                        this.progressInfos[idx].percentage = 0;
                        this.message = "Could not upload the file:" + file.name;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
