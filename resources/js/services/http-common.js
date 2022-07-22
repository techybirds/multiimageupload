import axios from "axios";
export default axios.create({
    baseURL: "http://practical.eliterenovation.co.uk/",
    headers: {
        "Content-type": "application/json"
    }
});
