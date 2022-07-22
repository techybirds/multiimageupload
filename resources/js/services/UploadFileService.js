import http from "./http-common";
class UploadFilesService {
    upload(file, form_id, onUploadProgress) {
        let formData = new FormData();
        formData.append("file", file);
        formData.append("form_id", form_id);
        return http.post("/api/save-images", formData, {
            headers: {
                "Content-Type": "multipart/form-data"
            },
            onUploadProgress
        });
    }
    getFiles() {
        return http.get("/files");
    }
}
export default new UploadFilesService();
