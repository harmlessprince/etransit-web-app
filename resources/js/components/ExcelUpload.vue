<template>
    <div class="file-upload">
        <form  method="POST">
            <div class="form-group" >
                <div class="image-button">
                    <img :src="'/assets/images/file/file.png'"   alt="image"  onclick="chooseFile();"  />
                </div>
                <input name="file" type="file" class="form-control" v-on:change="onImageChange" ref="excel_file" id="fileInput" hidden >
                <br/>
                <div class="progress-bar-container">
                    <progress max="100" :value.prop="uploadPercentage"></progress>
                    <br>
                </div>
            </div>
            <div  style="display:flex; justify-content: center;" v-if="image">
                <button class="btn btn-sm btn-success btn-submit"  @click="uploadImage"  >Click To Upload File</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        name: "ExcelUpload",  // using EXACTLY this name is essential
        data(){
            return {
                error: {},
                image:'',
                uploadPercentage: 0
            }
        },
        methods: {
            onImageChange(e) {
                e.preventDefault()
                this.image = e.target.files[0];

            },
            uploadImage(e){
            e.preventDefault()
            let formData = new FormData();
            formData.append('excel_file', this.image);
            axios.post('/e-ticket/import/vehicle', formData, {
                        headers: { 'content-type': 'multipart/form-data' },
                            onUploadProgress: function( progressEvent ) {
                                this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
                            }.bind(this)
                    }).then(response => {
                            if(response.status === 200) {
                                console.log('worked')
                            }
                        }).catch(error => {
                            // code here when an upload is not valid
                            this.uploading = false
                            this.error = error.response.data
                            console.log('check error: ', this.error)
                        });

            }
        }
    }

</script>

<style scoped>
.file-upload{
    height:400px;
    width: 100%;
    border: 1px dotted #DC6513;;
    border-radius: 20px;
}


.image-button{
    display:flex;
    justify-content: center;
    margin-top: 100px;

}
.progress-bar-container{
    display:flex;
    justify-content: center;
}

</style>
